<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{

	public static function search() : bool|array
	{
		$sql = 'SELECT 
       				u.email,up.city, r.role, up.phone, up.salary, u.created_at, 
       				d.name as department, u.name as name, d.id as department_id, u.id as id
				FROM users as u 
				    JOIN user_roles as r ON u.id = r.user_id
				    JOIN user_profiles as up ON up.user_id = u.id
					LEFT OUTER JOIN employee_departments ed ON u.id = ed.employee_id
				    LEFT OUTER JOIN departments d ON d.id = ed.department_id
				WHERE LOWER(CONCAT(u.name,u.email,up.city,r.role)) LIKE :search';
		$stmt = self::db()->prepare($sql);
		$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
		$stmt->bindValue(':search', '%' . $search . '%');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public static function profile( $id )
	{
		$sql = 'SELECT * FROM users JOIN user_profiles up on users.id = up.user_id WHERE users.id = :id';
		$stmt = self::db()->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch();
	}

	public static function where( $value, $field = 'id' )
	{
		$sql = 'SELECT * FROM users JOIN user_roles ON users.id = user_roles.user_id WHERE ' . $field . ' = :value';
		$stmt = self::db()->prepare($sql);
		$stmt->bindValue(':value', $value);
		$stmt->execute();
		return $stmt->fetch();
	}

	public static function create( $data ) : int
	{
		$role = $data['role'];

		$sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
		$db = self::db();
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':name', $data['name']);
		$stmt->bindValue(':email', $data['email']);
		$stmt->bindValue(':password', $data['password']);
		$stmt->execute();
		$lastId = $db->lastInsertId();

		$sql = 'INSERT INTO user_roles (user_id, role) VALUES (:id, :role)';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':id', $lastId);
		$stmt->bindValue(':role', $role);
		$stmt->execute();

		$sql = 'INSERT INTO user_profiles (user_id, phone, address, city) VALUES (:id, :phone, :address, :city)';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':id', $lastId);
		$stmt->bindValue(':phone', $data['phone']);
		$stmt->bindValue(':address', $data['address']);
		$stmt->bindValue(':city', $data['city']);
		$stmt->execute();

		if ( $role != 'patient' ) {
			if ( $role == 'doctor' ) {
				$sql = 'UPDATE user_profiles SET license = :license, salary = 2500, affiliation = :affiliation WHERE user_id = :id';
				$stmt = $db->prepare($sql);
				$stmt->bindValue(':license', $data['license']);
			} else {
				$sql = 'UPDATE user_profiles SET affiliation = :affiliation, salary = 1000 WHERE user_id = :id';
				$stmt = $db->prepare($sql);
			}

			$stmt->bindValue(':id', $lastId);
			$stmt->bindValue(':affiliation', $data['affiliation']);
			$stmt->execute();

			if ( $role == 'employee' ) {
				$sql = 'INSERT into employee_departments (employee_id, department_id) VALUES (:id, :department)';
				$stmt = $db->prepare($sql);
				$stmt->bindValue(':id', $lastId);
				$stmt->bindValue(':department', $data['department']);
				$stmt->execute();
			}
		}

		return $lastId;
	}

	public static function update( $data, $value, $field = 'id' ) : int
	{
		$sql = 'UPDATE users SET name = :name WHERE ' . $field . ' = :value';
		$stmt = self::db()->prepare($sql);
		$stmt->bindValue(':name', $data['name']);
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

	public static function userCount() : array
	{
		$sql = "select role, count(*) as count from user_roles WHERE role<>'admin' group by role";
		$stmt = self::db()->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rows = [];
		foreach ( $results as $result ) $rows[ $result['role'] ] = $result['count'];
		return $rows;
	}
}