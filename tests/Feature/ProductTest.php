<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase; // Do not run test in live database
    /**
     * A basic feature test example.
     */
    public function test_productpage_contains_empty_table(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);
        $response->assertSee('No product found');
    }

    public function test_productpage_contains_non_empty_table(): void
    {
        $user = User::factory()->create();
        $product = Products::create([
            'name' => 'iPhone',
            'price' => 800
        ]);

        $response = $this->actingAs($user)->get('/products');
        $response->assertStatus(200);
        $response->assertDontSee('No product found');
        $response->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product);
        });
    }

    public function test_paginated_products_doesnt_contain_11th_record()
    {
        $user = User::factory()->create();
        $products = Products::factory(11)->create();
        $lastProduct = $products->last();

        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($collection) use ($lastProduct) {
            return !$collection->contains($lastProduct);
        });
    }
}
