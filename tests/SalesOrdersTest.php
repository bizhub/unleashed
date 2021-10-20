<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Facades\Unleashed;
use Bizhub\Unleashed\SalesOrders;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class SalesOrdersTest extends TestCase
{
    /** @test */
    public function it_gets_all_sales_orders()
    {
        Http::fake([
            '*' => Http::response($this->getSample('sales-orders.all')),
        ]);

        $response = SalesOrders::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/SalesOrders', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(2, $response);
    }

    /** @test */
    public function it_finds_a_sales_order()
    {
        Http::fake([
            '*' => Http::response([]),
        ]);

        SalesOrders::find('guid');

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/SalesOrders/guid', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }
}