<?php

namespace App\Controllers;

use App\Models\Appointment;

class Appointments extends \App\Core\Controller
{

	public function index()
	{
		$this->role(['admin'])->authorize();
		$appointments = Appointment::all();
		$meta = [ 'title' => 'Appointments' ];
		$this->view('appointments/index', compact('appointments', 'meta'));

	}
}