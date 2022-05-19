<?php

namespace App\Core;

use App\Traits\Logs;
use PDO;

abstract class Model
{
	use Logs;


	protected static function db() : PDO
	{
		$connection = new PDO(
			'mysql:host=' .
			$_ENV['DB_HOST'] . ';dbname=' .
			$_ENV['DB_NAME'] . ';charset=utf8',
			$_ENV['DB_USERNAME'],
			$_ENV['DB_PASSWORD']
		);

		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		return $connection;
	}
}