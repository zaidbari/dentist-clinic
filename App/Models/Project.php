<?php

namespace App\Models;

use App\Core\Model;

class Project extends Model
{
	public static function all() : array
	{
		try {
			return self::db()->table('projects')->select()->orderBy('created_at', 'desc')->get();
		} catch (\Exception $e) {
			self::log('error', $e->getMessage());
			return [];
		}
	}

	public static function where($value, $field = 'id') : array
	{
		try {
			return self::db()->table('projects')->select()->where($field, $value)->get();
		} catch (\Exception $e) {
			self::log('error', $e->getMessage());
			return [];
		}
	}

	public static function id( $id )
	{
		try {
			$project = self::db()->table('projects')->select()->where('id', $id)->get();
			if( count($project) > 0 ) {
				return $project[0];
			} else
			return false;
		} catch (\Exception $e) {
			self::log('error', $e->getMessage());
			return false;
		}

	}

	/**
	 * @throws \ClanCats\Hydrahon\Exception
	 */
	public static function create( $data) : int
	{
			return self::db()->table('projects')->insert($data)->execute();
	}

	public static function update( $data, $value, $field = 'id' ) : int
	{
		try {
			return self::db()->table('projects')->update($data)->where($field, $value)->execute();
		} catch (\Exception $e) {
			self::log('error', $e->getMessage(), $data);
			return false;
		}
	}

	public static function delete(  $value, $field = 'id' ) : int
	{
		try {
			return self::db()->table('projects')->delete()->where($field, $value)->execute();
		} catch (\Exception $e) {
			self::log('error', $e->getMessage());
			return false;
		}
	}
}