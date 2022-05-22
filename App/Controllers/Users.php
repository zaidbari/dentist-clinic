<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class Users extends Controller
{
	public function show($id)
	{
		$this->authorize($id);
		$user = User::where($id);
		$this->view('users/show', compact('user'));
	}

	public function edit($id)
	{
		$this->authorize($id);
		$user = User::where($id);
		$this->view('users/edit', compact('user'));
	}

	public function update($id)
	{
		$this->authorize($id);
		User::update([
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'active' => $_POST['active']
		], $id);
		$this->redirect('users/manage/show/' . $id);
	}

	public function delete( $id )
	{
		$this->role(['admin'])->authorize();
		User::delete($id);
		$this->back();
	}
}