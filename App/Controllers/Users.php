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

	public function update($id)
	{
		$this->authorize($id);
		$validated = $this->validate([ 'name' => 'required|max:255', 'role' => 'required' ]);
		!$validated && $this->back([ 'errors' => $this->validation_errors ]);
		User::update([ 'name' => $this->param('name'), 'role' => $this->param('role')], $id);
		$this->back(['success' => 'User updated!']);
	}

	public function delete( $id )
	{
		$this->role(['admin'])->authorize();
		User::delete($id);
		$this->back(['success' => 'User deleted!']);
	}
}

