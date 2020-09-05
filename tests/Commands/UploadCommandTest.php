<?php

namespace Tests\Commands;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\AbstractTestCase;

class UploadCommandTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function test()
    {
        Artisan::call('arkwright:product-upload');

        $this->assertEquals(6, Product::count());
    }
}
