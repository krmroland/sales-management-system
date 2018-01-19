<?php

namespace Tests\Feature;

use App\Log;
use App\Adjustment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ItemAdjustmentsTest extends TestCase
{
	use RefreshDatabase;

	public function setUp()
	{
		parent::setUp();

		$this->authenticate();
	}
	/**
	 * @test
	 */
	public function it_logs_the_transaction_when_item_is_deleted()
	{
		$item=$this->createItem();

		$item->adjust()->delete();

		$this->assertCount(1,Adjustment::all());

		$this->assertCount(1,Log::all());

		
	}
	/**
	 * @test
	 */
	public function the_adjutstme_before_is_equal_to_the_deleted_item()
	{
		$item=$this->createItem();

		$item->adjust()->delete();

		$this->assertEquals($item->getAttributes(), Adjustment::first()->before);

	}

	/**
	 * @test
	 */
	public function it_updates_the_original_item_during_adjustmen()
	{
	
		$item=$this->createItem();

		$itemData=$this->makeItem();

		$item->adjust()->edit($itemData->getAttributes());

		$this->assertArraySubset($itemData->getAttributes(),$item->fresh()->getAttributes());
	}

	public function it_records_the_adjustment_after_updating()
	{
		$item=$this->createItem();

		$itemData=$this->makeItem();

		$this->item->adjust()->edit($itemData);

		$this->seeInDatabase("adjustments",[
				"item_id"=>$item->getKey()
			]);

	}
	/**
	 * @test
	 */
	public function it_doesnot_log_if_there_are_no_changes()
	{
		$item=$this->createItem(["quantity"=>45]);

		$item->adjust()->edit($item->only(["name","quantity","sellingPrice"]));

		$adjustments=Adjustment::all();

		$this->assertCount(0,$adjustments);
		
	}

	protected function createItem($attributes=[])
	{
		return factory(\App\Item::class)->create($attributes);
	}

	protected function makeItem($quantity=null)
	{
		

		$item=factory(\App\Item::class)->make($attributes);

		
		$item->quantity()->create();
	}

	protected function authenticate()
	{
		$user=factory(\App\User::class)->create();

		return auth()->login($user);
	}
}
