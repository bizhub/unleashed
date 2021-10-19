<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Facades\Unleashed;
use Bizhub\Unleashed\Products;
use Bizhub\Unleashed\Tests\TestCase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class ProductsTest extends TestCase
{
    /** @test */
    public function it_gets_products()
    {
        Http::fake([
            '*' => Http::response($this->getSample('products.all')),
        ]);

        $response = Products::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/Products', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(4, $response);
    }

    /** @test */
    public function it_finds_a_product()
    {
        Http::fake([
            '*' => Http::response($this->getSample('products.find')),
        ]);

        Products::find('guid');

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/Products/guid', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }
}