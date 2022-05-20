<?php

namespace App\Controllers;

use App\Models\User;

class Dashboard extends \App\Core\Controller
{

	public function index()
	{
		$this->authorize();

		$this->view('dashboard/index', [
			'meta' => [ 'title' => 'Dashboard' ],
			'data' => [
				'count' => User::userCount(),
				'users' => User::all()
			]
		]);
	}
}