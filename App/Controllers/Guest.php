<?php

namespace App\Controllers;

use App\Core\Controller;

class Guest extends Controller
{

	public function index()
	{
		$this->view('home/index', [
			'title' => 'Guest',
			'content' => 'Hello, Guest!'
		]);
	}

}