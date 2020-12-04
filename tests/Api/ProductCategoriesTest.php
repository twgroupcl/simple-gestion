<?php

namespace Tests\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCategoriesTest extends TestCase
{

   //use RefreshDatabase;

    /** 
     * @test
     */
    public function user_can_create_product_category()
    {

        $token = Http::post('http://simple-gestion.test/api/v1/login', [
            'email' => '',
            'password' => '',
        ]);

        $bodyResponse = (string) $token->getBody();
        dd($token->getBody()->token);
        
        $faker = Factory::create();
        $userToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9zaW1wbGUtZ2VzdGlvbi50ZXN0XC9hcGlcL3YxXC9sb2dpbiIsImlhdCI6MTYwMzk3ODAxOSwiZXhwIjoxNjA0Mjc4MDE5LCJuYmYiOjE2MDM5NzgwMTksImp0aSI6ImhvTlZwNUNvWnhGMkNTbkYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.8bBOP7HkdLxMrgVl6IMWhHSd2pmmmZCHwUWn4m1CFGw';
        
        $response = $this->json('POST', '/api/v1/categories?token=' . $userToken, [
            'name' => $name = $faker->company,
            'slug' => $slug = Str::slug($name),
            'description' => $description = $faker->realText(100),
            'code' => 'test0,'
        ]);
        
        $response
        ->assertStatus(200)
        ->assertJsonStructure(['status', 'data']);

        $this->assertDatabaseHas('product_categories', [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);
    }
}
