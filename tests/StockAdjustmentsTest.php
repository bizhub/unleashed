<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Facades\Unleashed;
use Bizhub\Unleashed\StockAdjustments;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class StockAdjustmentsTest extends TestCase
{
    /** @test */
    public function it_gets_all_stock_adjustments()
    {
        Http::fake([
            '*' => Http::response($this->getSample('stock-adjustments.all')),
        ]);

        $response = StockAdjustments::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/StockAdjustments', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(2, $response);
    }

    /** @test */
    public function it_finds_a_stock_adjustment()
    {
        Http::fake([
            '*' => Http::response([]),
        ]);

        StockAdjustments::find('guid');

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/StockAdjustments/guid', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }

    /** @test */
    public function it_creates_a_stock_adjustment()
    {
        Http::fake([
            '*' => Http::response([]),
        ]);

        StockAdjustments::create('guid', []);

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/StockAdjustments/guid', $request->url());
            $this->assertEquals('POST', $request->method());

            return true;
        });
    }
}