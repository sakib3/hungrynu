<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;

class ProductsControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testShouldGetAllProducts()
    {
        $products = factory(Product::class)->create(
            [
                "name" => 'Milk Shake',
                'parent' => 2,
                'price' => 35,
                'description' => 'Drinks',
                'created_at' => '2017-04-09 23:04:00',
                'updated_at' => '2017-04-09 23:04:00'
            ]
        );
        $this->app->instance('Product', $products);
        $model = json_decode($this->call('GET','/products')->original['products']);
        $this->assertEquals('Milk Shake',$model[0]->name);
        $this->assertEquals(2,$model[0]->parent);
        $this->assertEquals(35,$model[0]->price);
        $this->assertEquals('Drinks',$model[0]->description);
        $this->assertEquals('2017-04-09 23:04:00',$model[0]->created_at);
        $this->assertEquals('2017-04-09 23:04:00',$model[0]->updated_at);
    
    }

    public function testShouldStoreProduct(){
        $product = [
                "name" => 'Chicken Nuggets',
                'parent' => 1,
                'price' => 25,
                'description' => 'Fast Food',
                '_token' => csrf_token()
        ];
        $response = $this->json('POST','/products', $product);
        $response->assertStatus(200);
    }

    public function testShouldUpdateProduct(){
        $products = factory(Product::class)->create([
                "name" => 'Berger',
                'parent' => 1,
                'price' => 50,
                'description' => 'Fast Food',
                'created_at' => '2017-04-09 23:04:00',
                'updated_at' => '2017-04-09 23:04:00'
        ]);
        $this->app->instance('Product', $products);
        $existing = json_decode($this->call('GET','/products')->original['products']);
        $existingProductId = $existing[0]->id;

        $product = [
                "name" => 'Pizza',
                'parent' => 1,
                'price' => 60,
                'description' => 'Fast Food',
                '_token' => csrf_token()
        ];
        $response = $this->json('PUT','/products/'.$existingProductId, $product);
        $response->assertStatus(200);

        $model = json_decode($this->call('GET','/products')->original['products']);
        $this->assertEquals('Pizza',$model[0]->name);
        $this->assertEquals(1,$model[0]->parent);
        $this->assertEquals(60,$model[0]->price);
        $this->assertEquals('Fast Food',$model[0]->description);
    }    
}
