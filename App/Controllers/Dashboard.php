<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class Dashboard extends Controller
{

	public function index()
	{
		$this->authorize();
		$users = User::search();
		$count = User::userCount();
		$meta = [ 'title' => 'Dashboard' ];
		$this->view('dashboard/index', compact('users', 'count', 'meta'));

	}
}