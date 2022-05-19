<?php

namespace App\Traits;

trait Request
{


	/**
	 * @param array $data
	 * @param int   $status
	 */
	protected function response( array $data = [], int $status = 200 )
	{
		http_response_code($status);
		header('Content-Type: application/json');
		echo json_encode($data);
		exit();
	}


	protected function back($message = null)
	{
		if ($message) $_SESSION['FLASH'] = $message;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	protected function redirect( string $url, $message = null )
	{
		if ($message) $_SESSION['FLASH'] = $message;
		header('Location: ' . $url);
		exit();
	}

	/**
	 * @return array
	 */
	protected function requestBody() : array
	{
		return $_POST;
	}

	/**
	 * @param string $key
	 *
	 * @return mixed
	 */
	protected function param( string $key ) : mixed
	{
		return $_POST[ $key ] ?? null;
	}

	protected function method($type) : bool
	{
		return $_SERVER['REQUEST_METHOD'] == $type;
	}

	protected function getRequestPath()
	{
		return $_SERVER['REQUEST_URI'];
	}
}