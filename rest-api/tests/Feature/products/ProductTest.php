<?php

use App\Models\Product;
use Database\Seeders\ProductSeeder;

describe('Product', function () {

    test('should create product return status http 201', function () {
        $response = $this->post('/api/products', [
            'name' => 'Mause',
            'price' => 24,
            'availability' => true
        ]);

        $response->assertStatus(201);
    });


    test('should create product return data json', closure: function () {
        $response = $this->post('/api/products', [
            'name' => 'Mause',
            'price' => 24,
            'availability' => true
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                "name",
                "price",
                "availability",
            ]
        ]);
    });

    test('should get products return status http 200', function () {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    });

    test('should get products return json array products', function () {
        $this->seed(ProductSeeder::class);
        $response = $this->get('/api/products');
        $response->assertJsonStructure([
            'data' => [
               [
                'id',
                "name",
                "price",
                "availability",
               ]
            ]
        ]);
        $response->assertStatus(200);
    });

    test('should show product return status http 200 and return json product', function () {
        $this->seed(ProductSeeder::class);
        $response = $this->get('/api/products/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                "name",
                "price",
                "availability",
            ]
        ]);
    });

     test('should destroy product return status http 200 and return json product', function () {
        $this->seed(ProductSeeder::class);
        $response = $this->delete('/api/products/1');
        $response->assertStatus(204);
    });

    test('should update product return data json', closure: function () {
        $this->seed(ProductSeeder::class);

        $product = Product::first();

        $response = $this->put('/api/products/' . $product->id, [
            'name' => 'Mause',
            'price' => 24,
            'availability' => true
        ]);

        $response->assertJson([
            'data' => [
                'id' => $product->id,
                "name" =>'Mause',
                "price" => 24,
                "availability" => true,
            ]
        ]);

        $response->assertStatus(200);

    });

});
