<?php

namespace App\Models;

class Department extends \App\Core\Model
{

	public static function all( ) : bool|array
	{
		$sql = 'SELECT * from departments';
		$stmt = self::db()->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}
}