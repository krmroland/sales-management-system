<?php

namespace App;


use Illuminate\Support\Facades\DB;

Class Dashboard implements \JsonSerializable
{
	public function __construct()
	{

	}

	public function jsonSerialize()
	{
		return
		[
			"logs"=>$this->logs(),
			"counts"=>$this->counts(),
		];
	}

	protected function logs()
	{
		return Log::latest("created_at")->with("logger")->limit(150)->get();
	}

	protected function countable()
	{
		return["items","vehicles","employees","rooms"];
	}

	protected function counts()
	{
	$counts=[];

		foreach ($this->countable()	 as $table) {
			$counts[$table]=$this->countTable($table);
		}
		return $counts;
		
		// foreach ($this->countable()	 as $index=>$table) {
		// 	if ($index==0) {
		// 		$db=$this->countQuery($table);
		// 	}else {
		// 		$db->union($this->countQuery($table));
		// 	}
			
		// 	return $db->get();
		// }
		
	}

	public function countTable($table)
	{
		return DB::table($table)->count();
	}
	
}