<?php

namespace Tests\Feature;

use App\Models\Products;
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
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('No product found');
    }

    public function test_productpage_contains_non_empty_table(): void
    {
        $product = Products::create([
            'name' => 'iPhone', 
            'price' => 800
        ]);

        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertDontSee('No product found');
        $response->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product);
        });
    }
}
