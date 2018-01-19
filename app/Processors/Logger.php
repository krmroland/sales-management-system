<?php

namespace App\Processors;

use App\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

Class Logger
{
	public function log(Model $model, $description)
	{
		$this->deleteOldLogs();

		Log::Create(
			[
				"date"=>date("Y-m-d"),
				"logger_id"=>$model->getKey(),
				"logger_type"=>get_class($model),
				"description"=>$description,
				"user_id"=>auth()->id()

			]
		);

		return $model;
	}

	public function deleteOldLogs()
	{
		Cache::remember("logs.delete",60,function (){
			$count=Log::count();
			if($count>10000){
				Log::oldest("created_at")->limit($count-10000)->delete();
			}
		   
		});

		
	}
}