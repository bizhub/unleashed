<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Facades\Unleashed;
use Bizhub\Unleashed\BillOfMaterials;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class BillOfMaterialsTest extends TestCase
{
    /** @test */
    public function it_gets_bill_of_materials()
    {
        Http::fake([
            '*' => Http::response($this->getSample('bill-of-materials.all')),
        ]);

        $response = BillOfMaterials::get();

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/BillOfMaterials', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });

        $this->assertCount(1, $response);
    }

    /** @test */
    public function it_finds_a_bill_of_material()
    {
        Http::fake([
            '*' => Http::response([]),
        ]);

        BillOfMaterials::find('guid');

        Http::assertSent(function(Request $request){
            $this->assertEquals(Unleashed::getBaseUrl() . '/BillOfMaterials/guid', $request->url());
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }
}