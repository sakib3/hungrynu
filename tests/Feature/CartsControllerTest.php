<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;

class CartsControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   
    use DatabaseTransactions;
    public function testShouldGetCarts()
    {
        $cart = [
            [
                'name' => 'Product 1',
                'product_id' => 1,
            ],
            [
                'name' => 'Product 2',
                'product_id' => 2,
            ],
            [
                'name' => 'Product 3',
                'product_id' => 3,
            ]
        ];

        $this->json('POST','/cart', compact('cart'));
       
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product 1',$cart[0]['name']);
        $this->assertEquals('1',$cart[0]['product_id']);
        $this->assertEquals('Product 2',$cart[1]['name']);
        $this->assertEquals('2',$cart[1]['product_id']);
        $this->assertEquals('Product 3',$cart[2]['name']);
        $this->assertEquals('3',$cart[2]['product_id']);
    
    }

    public function testShouldOverrideCarts()
    {
        $cart = [
            [
                'name' => 'Product 1',
                'product_id' => 1,
            ],
            [
                'name' => 'Product 2',
                'product_id' => 2,
            ],
            [
                'name' => 'Product 3',
                'product_id' => 3,
            ]
        ];

        $this->json('POST','/cart', compact('cart'));
       
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product 1',$cart[0]['name']);
        $this->assertEquals('1',$cart[0]['product_id']);
        $this->assertEquals('Product 2',$cart[1]['name']);
        $this->assertEquals('2',$cart[1]['product_id']);
        $this->assertEquals('Product 3',$cart[2]['name']);
        $this->assertEquals('3',$cart[2]['product_id']);

        $cart = [
            [
                'name' => 'Product 4',
                'product_id' => 4,
            ]
        ];

        $this->json('POST','/cart', compact('cart'));
       
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product 4',$cart[0]['name']);
        $this->assertEquals('4',$cart[0]['product_id']);
        $this->assertEquals(1,count($cart));
    
    }

    public function testShouldClearCarts()
    {
        $cart = [
            [
                'name' => 'Product 4',
                'product_id' => 4,
            ]
        ];

        $this->json('POST','/cart', compact('cart'));
       
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product 4',$cart[0]['name']);
        $this->assertEquals('4',$cart[0]['product_id']);
        $this->assertEquals(1,count($cart));

        $cart = $this->call('DELETE','/cart')->original['cart'];
        $this->assertEquals(null,$cart);
    }

    public function testShouldUpdateCarts()
    {
        $cart = [
            [
                'name' => 'Product 1',
                'product_id' => 1,
            ]
        ];

        $this->json('POST','/cart', compact('cart'));
       
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product 1',$cart[0]['name']);
        $this->assertEquals('1',$cart[0]['product_id']);
        $this->assertEquals(1,count($cart));

        $cart = [
                'name' => 'Product 2',
                'product_id' => 1
        ];

        $this->call('PUT','/cart/1', compact('cart'));
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product 2',$cart[0]['name']);
        $this->assertEquals('1',$cart[0]['product_id']);
        $this->assertEquals(1,count($cart));
    }

    public function testShouldUpdateBulkCarts()
    {
        $cart = [
            [
                'name' => 'Product x',
                'product_id' => 1,
            ],
            [
                'name' => 'Product y',
                'product_id' => 2,
            ]
        ];

        $this->json('POST','/cart', compact('cart'));
       
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product x',$cart[0]['name']);
        $this->assertEquals('1',$cart[0]['product_id']);
        $this->assertEquals('Product y',$cart[1]['name']);
        $this->assertEquals('2',$cart[1]['product_id']);
        $this->assertEquals(2,count($cart));

        $cart = [
            [
                'name' => 'Product 1',
                'product_id' => 1,
            ],
            [
                'name' => 'Product 2',
                'product_id' => 2,
            ]
        ];

        $this->call('PUT','/cart', compact('cart'));
        $cart = $this->call('GET','/cart')->original['cart'];
        $this->assertEquals('Product 1',$cart[0]['name']);
        $this->assertEquals('1',$cart[0]['product_id']);
        $this->assertEquals('Product 2',$cart[1]['name']);
        $this->assertEquals('2',$cart[1]['product_id']);
        $this->assertEquals(2,count($cart));
    }

}
