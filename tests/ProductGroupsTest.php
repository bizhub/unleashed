<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Facades\Unleashed;
use Bizhub\Unleashed\ProductGroups;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class ProductGroupsTest extends TestCase
{
    /** @test */
    public function it_get_product_groups()
    {
        Http::fake([
            '*' => Http::response($this->getSample('product-groups.all')),
        ]);

        $response = ProductGroups::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/ProductGroups', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(6, $response);
    }
}