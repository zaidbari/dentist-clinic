<?php

namespace App\Traits;

trait Authorization
{
	use Logs, Request;

	/**
	 * @param array|null $role
	 */

	private ?array $set_role = null;

	protected function role( array $set ) : static
	{
		$this->set_role = $set;
		return $this;
	}

	protected function authorize( int $check_user = null )
	{
		if ( isset($_SESSION['user']) ) {

			$user = $_SESSION['user'];

			if ( $user['role'] != 'admin' ) {

				if ( $check_user ) {
					if ( $user['id'] != $check_user ) {
						$this->log('warning', 'Unauthorized access attempt by user: ' . $user['id'] . ' to page: ' . $this->getRequestPath());
						$this->redirect('/dashboard');
					}
				}

				if ( $this->set_role && !in_array($user['role'], $this->set_role) ) {
					$this->log('warning', 'Unauthorized access attempt by role: ' . $user['role'] . ' to page: ' . $this->getRequestPath());
					$this->redirect('/dashboard');
				}
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