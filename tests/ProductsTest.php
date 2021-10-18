<?php

namespace Bizhub\Unleashed\Tests;

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
            '*' => Http::response($this->getSample('products.all'))
        ]);

        $response = Products::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals('https://api.unleashedsoftware.com/Products', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(4, $response);
    }
}