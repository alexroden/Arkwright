<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    /**
     * @param \App\Http\Requests\FilterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(FilterRequest $request)
    {
        $products = Product::all()->groupBy('plu')->map(function (Collection $items) {
            $plu = $items->first()->plu;
            $name = $items->first()->name;
            $sizes = $items->map(function (Product $product) {
                return [
                    'SKU'  => $product->sku,
                    'size' => $product->size
                ];
            });

            return [
                'PLU'   => $plu,
                'name'  => $name,
                'sizes' => $sizes,
            ];
        });

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $products
        ]);

    }
}
