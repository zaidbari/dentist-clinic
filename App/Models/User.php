<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
	public static function all() : array
	{
		$sql = 'SELECT * FROM users';
		$stmt = self::db()->query($sql);
		return $stmt->fetchAll();
	}

	public static function where( $value, $field = 'id' )
	{
		$sql = 'SELECT * FROM users WHERE ' . $field . ' = :value';
		$stmt = self::db()->prepare($sql);
		$stmt->bindValue(':value', $value);
		$stmt->execute();
		return $stmt->fetch();
	}

	public static function create( $data ) : int
	{
		$sql = 'INSERT INTO users (name, email, role, password) VALUES (:name, :email, :role, :password)';
		$stmt = self::db()->prepare($sql);
		$stmt->bindValue(':name', $data['name']);
		$stmt->bindValue(':email', $data['email']);
		$stmt->bindValue(':password', $data['password']);
		$stmt->bindValue(':role', $data['role']);
		$stmt->execute();
		return self::db()->lastInsertId();
	}

	public static function update( $data, $value, $field = 'id' ) : int
	{
		$sql = 'UPDATE users SET name = :name, email = :email, role = :role WHERE ' . $field . ' = :value';
		$stmt = self::db()->prepare($sql);
		$stmt->bindValue(':name', $data['name']);
		$stmt->bindValue(':email', $data['email']);
		$stmt->bindValue(':role', $data['role']);
		$stmt->bindValue(':value', $value);
		$stmt->execute();
		return $stmt->rowCount();
	}

	public static function delete( $value, $field = 'id' ) : int
	{
		$sql = 'DELETE FROM users WHERE ' . $field . ' = :value';
		$stmt = self::db()->prepare($sql);
		$stmt->bindValue(':value', $value);
		$stmt->execute();
		return $stmt->rowCount();
	}

	public static function userCount( $role = 'admin' )
	{
		$sql = "select role, count(*) as count from users WHERE role<>'admin' group by role";

		$stmt = self::db()->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rows = [];
		foreach ( $results as $result )  $rows[ $result['role'] ] = $result['count'];
		return $rows;
	}
}