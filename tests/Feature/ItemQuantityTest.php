<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemQuantityTest extends TestCase
{
   use DatabaseTransactions;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_calcaluates_the_compound_qunatity_with_no_bundles()
    {
    	//forexample 12 bottles of  soda in a crate of 24  should give 
    	//only give me 12 bottles
    	$item=$this->createItemOfQuantity(12);

        $this->assertEquals($item->bundle->name(), "12 bottles");
    }
    /**
     * @test
     */
    public function it_gives_zero_units_whith_zero_quantity()
    {
    	$item=$this->createItemOfQuantity(0);

    	$this->assertEquals($item->bundle->name(),"0 bottles");
    }

    /**
     * @test
     */
    public function it_gives_only_the_pieces_when_no_bundle_is_given()
    {
    	$item=$this->createItemOfQuantity(48);
    	$item->bundleName=null;

    	$this->assertEquals($item->bundle->name(),"48 bottles");
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_calcaluates_the_compound_qunatity_with_bundles()
    {
    	//forexample 50 bottles of  soda in a crate of 24  should give 
    	//
    	//i should have 2 crates and 2 sodas
    	$item=$this->createItemOfQuantity(50);

        $this->assertEquals($item->bundle->name(), "2 crates and 2 bottles");
    }
    /**
     * @test
     */
    public function it_correctly_pluralizes_the_compound_qunatity()
    {
    	// 49 bottles should give me 2 crates and 1 soda
    	$item=$this->createItemOfQuantity(49);

    	$this->assertEquals($item->bundle->name(),"2 crates and 1 bottle");

    	
    }
    /**
     * @test
     */
    public function it_gives_only_the_budles_if_there_are_no_extra_units()
    {
    	//48 bottles should only give me 2 crates and 24 bottles shold give 1 crate
    	$item=$this->createItemOfQuantity(48);

    	$this->assertEquals($item->bundle->name(),"2 crates");
    	
    	$item=$this->createItemOfQuantity(24);

    	$this->assertEquals($item->bundle->name(),"1 crate");
    }

    protected function createItemOfQuantity($quantity,$bundleName="crate")
    {

     $attributes=[
          "unitName"=>"bottle",
          "bundleName"=>$bundleName,
          "unitsPerBundle"=>24
      ];

      $item= factory(\App\Item::class)->create(array_filter($attributes));

      $item->quantity()->create(compact("quantity"));

      return $item;

  }
}
