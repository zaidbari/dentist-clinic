<?php

namespace App\Traits;

trait Authorization
{
	use Logs, Request;

	/**
	 * @param string $role
	 */
	protected function authorize( string $role = 'user' )
	{
		if ( isset($_SESSION['user']) ) {
			$user = $_SESSION['user'];
			if ( !$user['role'] == $role ) {
				$this->log('info', 'Unauthorized attempt to access ' . $this->getRequestPath());
				$this->redirect('/login');
			}
		} else {
			$this->log('info', 'Unauthorized attempt to access ' . $this->getRequestPath());
			$this->redirect('/login');
		}
	}

	protected function user()
	{
		return $_SESSION['user'];
	}

}