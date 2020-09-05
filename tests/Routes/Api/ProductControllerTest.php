<?php

namespace Tests\Routes\Api;

use App\Product;
use App\User;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\Routes\AbstractRouteTestCase;

class ProductControllerTest extends AbstractRouteTestCase
{
    use MatchesSnapshots;

    public function testShoeUk()
    {
        $user = factory(User::class)->create();
        factory(Product::class)->create([
            'sku'       => '123',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => '1',
            'size_sort' => 'SHOE_UK',
        ]);
        factory(Product::class)->create([
            'sku'       => '456',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => '5',
            'size_sort' => 'SHOE_UK',
        ]);
        factory(Product::class)->create([
            'sku'       => '789',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => '8 (Child)',
            'size_sort' => 'SHOE_UK',
        ]);

        $response = $this->get('/api/products', ['User-Token' => $user->token]);

        $response->assertOk();
        $this->assertMatchesJsonSnapshot($response->getContent());
    }

    public function testClothingShort()
    {
        $user = factory(User::class)->create();
        factory(Product::class)->create([
            'sku'       => '123',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => 'XXL',
            'size_sort' => 'CLOTHING_SHORT',
        ]);
        factory(Product::class)->create([
            'sku'       => '456',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => 'M',
            'size_sort' => 'CLOTHING_SHORT',
        ]);
        factory(Product::class)->create([
            'sku'       => '789',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => 'L',
            'size_sort' => 'CLOTHING_SHORT',
        ]);

        $response = $this->get('/api/products', ['User-Token' => $user->token]);

        $response->assertOk();
        $this->assertMatchesJsonSnapshot($response->getContent());
    }

    public function testShoeEu()
    {
        $user = factory(User::class)->create();
        factory(Product::class)->create([
            'sku'       => '123',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => '40',
            'size_sort' => 'SHOE_EU',
        ]);
        factory(Product::class)->create([
            'sku'       => '456',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => '38',
            'size_sort' => 'SHOE_EU',
        ]);
        factory(Product::class)->create([
            'sku'       => '789',
            'plu'       => 'AAA',
            'name'      => 'Testing',
            'size'      => '45',
            'size_sort' => 'SHOE_EU',
        ]);

        $response = $this->get('/api/products', ['User-Token' => $user->token]);

        $response->assertOk();
        $this->assertMatchesJsonSnapshot($response->getContent());
    }
}
