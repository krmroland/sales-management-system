<?php

use App\Company;

use App\Processors\Logger;

function company()
{
	return app(Company::class);
}


function saveLog($model, $description)
{
	return app(Logger::class)->log($model,$description);
}