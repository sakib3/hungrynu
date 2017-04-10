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
                "name" => 'Berger',
                'parent' => 1,
                'price' => 50,
                'description' => 'Fast Food',
                'created_at' => '2017-04-09 23:04:00',
                'updated_at' => '2017-04-09 23:04:00'
            ]
        );
        $this->app->instance('Product', $products);
        $model = json_decode($this->call('GET','/products')->original['products']);
        $this->assertEquals('Berger',$model[0]->name);
        $this->assertEquals(1,$model[0]->parent);
        $this->assertEquals(50,$model[0]->price);
        $this->assertEquals('Fast Food',$model[0]->description);
        $this->assertEquals('2017-04-09 23:04:00',$model[0]->created_at);
        $this->assertEquals('2017-04-09 23:04:00',$model[0]->updated_at);
    
    }
}
