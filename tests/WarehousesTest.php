<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Facades\Unleashed;
use Bizhub\Unleashed\Warehouses;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class WarehousesTest extends TestCase
{
    /** @test */
    public function it_gets_warehouses()
    {
        Http::fake([
            '*' => Http::response($this->getSample('warehouses.all')),
        ]);

        $response = Warehouses::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/Warehouses', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(2, $response);
    }
}