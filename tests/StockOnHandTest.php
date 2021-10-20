<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Facades\Unleashed;
use Bizhub\Unleashed\StockOnHand;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class StockOnHandTest extends TestCase
{
    /** @test */
    public function it_gets_all_stock_on_hand()
    {
        Http::fake([
            '*' => Http::response($this->getSample('stock-on-hand.all')),
        ]);

        $response = StockOnHand::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/StockOnHand', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(2, $response);
    }

    /** @test */
    public function it_finds_stock_on_hand_for_a_product()
    {
        Http::fake([
            '*' => Http::response([]),
        ]);

        StockOnHand::find('product_id');

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/StockOnHand/product_id', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }
}