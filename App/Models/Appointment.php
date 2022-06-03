<?php

namespace App\Models;

class Appointment extends \App\Core\Model
{
	public static function all( ) : bool|array
	{
		$sql = 'SELECT a.appointment_id, a.date, a.time_start, a.doctor_id, a.patient_id, 
       			d.name AS doctor_name, p.name AS patient_name, n.name AS nurse_name
				FROM appointments AS a
				LEFT JOIN users AS d ON a.doctor_id = d.id
				LEFT JOIN users AS p ON a.patient_id = p.id
				LEFT JOIN users AS n ON a.nurse_id = n.id
				ORDER BY a.date DESC';
		$stmt = self::db()->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

}