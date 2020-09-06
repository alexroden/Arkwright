<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProductController extends Controller
{
    /**
     * @param \App\Http\Requests\FilterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(FilterRequest $request)
    {
        $query = $request->validated();

        $products = DB::table('products');

        foreach ($query as $key => $value) {
            $products->where($key, '=', $value);
        }

        $products = $products->get()->groupBy('plu')->map(function (Collection $items) {
            /** @var \App\Product $item */
            $item = $items->first();
            $plu = $item->plu;
            $name = $item->name;
            $sizeSort = $item->size_sort;

            $sizes = $items->map(function (stdClass $product) {
                return [
                    'SKU'  => $product->sku,
                    'size' => is_numeric($product->size) ? (float) $product->size : $product->size,
                ];
            })->sortBy(function (array $product) use ($sizeSort) {
                switch ($sizeSort) {
                    case 'SHOE_UK':
                        if (strpos($product['size'], '(Child)') !== false) {
                            return (float) trim(str_replace('(Child)', '', $product['size']));
                        }

                        return ((float) $product['size']) + 100;
                    case 'CLOTHING_SHORT':
                        return array_flip(Product::CLOTHING_SIZES)[$product['size']];
                    default:
                        return $product['size'];
                }
            })->values();

            return [
                'PLU'   => $plu,
                'name'  => $name,
                'sizes' => $sizes,
            ];
        })->values();

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $products
        ]);

    }
}
