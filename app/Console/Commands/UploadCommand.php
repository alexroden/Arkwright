<?php

namespace App\Console\Commands;

use App\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class UploadCommand extends Command
{
    /**
     * @var string
     */
    const FILE = 'products.csv';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arkwright:product-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload products from FTP.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $connection = ftp_connect(Config::get('credentials.server'));

        $login = ftp_login(
            $connection,
            Config::get('credentials.username'),
            Config::get('credentials.password')
        );

        if (!$connection || !$login) {
            $this->error('Connection Error!');

            return;
        }

        if (!Storage::exists(self::FILE)) {
            Storage::put(self::FILE, '');
        }

        ftp_get(
          $connection,
          storage_path('app').'/'.self::FILE,
          self::FILE,
          FTP_ASCII
        );

        $rows = [];
        $resource = fopen(
            storage_path('app').'/'.self::FILE,
            'r'
        );
        while (!feof($resource)) {
            $rows[] = fgetcsv($resource, 0, ',');
        }
        fclose($resource);

        $now = Carbon::now();

        $rows = array_filter(array_map(function($row) use ($now) {
            $attr = [];
            if ($row) {
                foreach (Product::FILE_MAPPING as $key => $value) {
                    $attr[$value] = trim($row[$key]);
                }
                $attr = array_merge($attr, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            return $attr;
        }, $rows), function ($row) {
            return !empty($row);
        });

        if (!empty($rows)) {
            if (Schema::hasTable("products_backup_{$now->copy()->subDays(2)->format('Y_m_d')}")) {
                DB::table("products_backup_{$now->copy()->subDays(2)->format('Y_m_d')}")->delete();
            }

            DB::statement("CREATE TABLE products_backup_{$now->copy()->subDay()->format('Y_m_d')} LIKE products");
            DB::statement("INSERT products_backup_{$now->copy()->subDay()->format('Y_m_d')} SELECT * FROM products");

            Product::truncate();
            DB::table('products')
                ->insert($rows);
        }

        $this->info('Product upload completed! 🎉');
    }
}
