<?php

namespace App\Models;

class Setting extends \App\Core\Model
{
	public static function get(  )
	{
		try {
			$project = self::db()->table('settings')->select()->where('id', 1)->get();
			if( count($project) > 0 ) {
				return $project[0];
			} else
				return false;
		} catch (\Exception $e) {
			self::log('error', $e->getMessage());
			return false;
		}
	}

	public static function update( $data ) : int
	{
		try {
			return self::db()->table('settings')->update($data)->where('id', 1)->execute();
		} catch (\Exception $e) {
			self::log('error', $e->getMessage(), $data);
			return false;
		}
	}


}