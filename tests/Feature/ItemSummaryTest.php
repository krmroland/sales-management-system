<?php

namespace Tests\Feature;

use App\Item;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemSummaryTest extends TestCase
{
	use RefreshDatabase;

	public function setUp()
	{
		parent::setUp();

		$this->items=$this->createItems(rand(1,10),["quantity"=>rand(1,323)]);

		$this->summary=Item::summary()->summarized();

		
	}

    /**
     * @test
     */
    public function it_weighs_the_total_buying_price_of_all_items_with_their_quantity()
    {

    	$beforeSellingPrice=$this->items->map(function($item){
    		return $item->quantity*$item->buyingPrice;
    	})->sum();

    	$this->assertEquals($this->summary->beforeSale,$beforeSellingPrice);

    }

    /**
     * @test
     */
    public function it_weighs_the_total_selling_price_of_all_items_with_their_quantity()
    {
    	
    	$afterSellingPrice=$this->items->map(function($item){
    		return $item->quantity*$item->sellingPrice;
    	})->sum();

    	$this->assertEquals($this->summary->afterSale,$afterSellingPrice);

    }
    /**
     * @test
     */
    public function it_gives_the_correct_count_of_items_in_the_store()
    {

    	$this->assertEquals($this->summary->total_count,Item::count());
    }

    protected function createItems($count=1,$attributes=[])
    {
    	return factory(Item::class,$count)->create($attributes);
    }
}
