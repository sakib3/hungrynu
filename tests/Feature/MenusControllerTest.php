<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Menu;

class MenusControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testShouldGetAllMenus()
    {
        $menus = factory(Menu::class)->create(
            [
                "name" => 'Starter',
                'product_id' => 1,
                'created_at' => '2017-04-16 00:07:00',
                'updated_at' => '2017-04-16 00:07:00'
            ]
        );
        $this->app->instance('Menu', $menus);
        $model = json_decode($this->call('GET','/menus')->original['menus']);
        $this->assertEquals('Starter',$model[0]->name);
        $this->assertEquals(1,$model[0]->product_id);
        $this->assertEquals('2017-04-16 00:07:00',$model[0]->created_at);
        $this->assertEquals('2017-04-16 00:07:00',$model[0]->updated_at);
    
    }

    public function testShouldStoreMenu(){
        $menus = 
        [
                    "name" => 'Starter',
                    'product_id' => 1,
                    'created_at' => '2017-04-16 00:07:00',
                    'updated_at' => '2017-04-16 00:07:00',
                    '_token' => csrf_token()
        ];
        $response = $this->call('POST','/menus', $menus);
        $response->assertStatus(200);
    }

        public function testShouldUpdateMenu(){
        $menu = factory(Menu::class)->create([
                'name' => 'Starter',
                'product_id' => 1,
                'created_at' => '2017-04-18 00:07:00',
                'updated_at' => '2017-04-18 00:07:00'
        ]);
        $this->app->instance('Menu', $menu);
        //dd($this->call('GET','/menus')->original['menus']);
        $existing = json_decode($this->call('GET','/menus')->original['menus']);
        $existingMenuId = $existing[0]->id;

        $menu = [
                'name' => 'Desert',
                'product_id' => 1,
                '_token' => csrf_token()
        ];
        $response = $this->json('PUT','/menus/'.$existingMenuId, $menu);
        $response->assertStatus(200);

        $model = json_decode($this->call('GET','/menus')->original['menus']);
        $this->assertEquals('Desert',$model[0]->name);
        $this->assertEquals(1,$model[0]->product_id);
        $this->assertEquals('2017-04-18 00:07:00',$model[0]->created_at);
        $this->assertEquals('2017-04-18 00:07:00' <= $model[0]->updated_at,true);
       
    } 
}
