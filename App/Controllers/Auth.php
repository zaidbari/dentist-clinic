<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class Auth extends Controller
{

	public function loginView()
	{
		!empty($_SESSION['user']) && $this->redirect('/dashboard');
		$this->view('auth/login');
	}

	public function signupView()
	{
		!empty($_SESSION['user']) && $this->redirect('/dashboard');
		$this->view('auth/signup');
	}

	public function login()
	{
		$isValid = $this->validate([ 'email' => 'required|email', 'password' => 'required|min:6' ]);

		!$isValid && $this->back($this->validation_errors);
		try {
			$user = User::where($this->param('email'), 'email');
			if ( !$user )
				throw new \Exception(json_encode([ 'email' => 'Email address doesn\'t exist' ]), 404);
			if ( !password_verify($this->param('password'), $user['password']) )
				throw new \Exception(json_encode([ 'password' => 'Incorrect password' ]), 401);

			$_SESSION['user'] = $user;
			$this->redirect('/dashboard');
		} catch (\Exception $e) {
			$this->back([ 'errors' => (array)json_decode($e->getMessage()) ]);
		}
	}

	public function create()
	{
		$validated = $this->validate([
			'name' => 'required|max:255',
			'email' => 'required|email',
			'password' => 'required|min:8',
			'role' => 'required',
			'confirm_password' => 'required|same:password',
		]);

		!$validated && $this->back([ 'errors' => $this->validation_errors ]);
		try {
			$user = User::where($this->param('email'), 'email');
			if ( $user )
				throw new \Exception(json_encode([ 'email' => 'Email already exist' ]), 404);

			$newUser = User::create([
				'name' => $this->param('name'),
				'email' => $this->param('email'),
				'role' => $this->param('role'),
				'password' => password_hash($this->param('password'), PASSWORD_DEFAULT),
			]);

			$_SESSION['user'] = [
				'id' => $newUser,
				'name' => $this->param('name'),
				'email' => $this->param('email'),
				'role' => $this->param('role'),
			];
			$this->redirect('/dashboard');

		} catch (\Exception $e) {
			$this->back([ 'errors' => (array)json_decode($e->getMessage()) ]);
		}
	}

	public function update( $id )
	{
		$this->validate([ 'name' => 'required|max:255' ]);
		try {
			$user = User::where($id);
			!$user && throw new \Exception('Error updating user.', 404);

			$user = User::update($id, [ 'name' => $this->param('name') ]);
			!$user && throw new \Exception('Server error', 500);

			$this->response([
				'status' => 'success',
				'user' => [ 'name' => $this->param('name'), 'id' => $user ],
				'message' => 'User updated successfully'
			], 201);

		} catch (\Exception $e) {
			$this->response([
				'status' => 'error',
				'message' => $e->getMessage()
			], $e->getCode());
		}
	}

	public function delete( $id )
	{
		try {
			$user = User::delete($id);
			!$user && throw new \Exception('Server error', 500);

			$this->response([
				'status' => 'success',
				'message' => 'Account deleted'
			], 201);

		} catch (\Exception $e) {
			$this->response([
				'status' => 'error',
				'message' => json_decode($e->getMessage())
			], $e->getCode());
		}
	}

	public function logout()
	{
		session_destroy();
		$this->redirect('/');
	}
}