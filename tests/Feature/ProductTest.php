<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    //use DatabaseMigrations;
    use DatabaseTransactions;
    public function testExample()
    {
        $product = factory(Product::class)->make();
        $this->assertTrue(true);
    }
}
