<?php

namespace App\Traits;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;


use Twig\TwigFilter;
use Twig\TwigFunction;


trait View
{

	protected function view( string $view, array $args = [] )
	{
		$loader = new FilesystemLoader([ 'resources/views/pages', 'resources/views/partials' ]);
		$twig = new Environment($loader, [ 'cache' => '/cache', 'auto_reload' => true ]);

		$twig->addFunction(new TwigFunction('FLASH', function () {
			return isset($_SESSION['FLASH']);
		}));

		$twig->addFunction(new TwigFunction('FLASH_MSG', function () {
			$flash = $_SESSION['FLASH'] ??'';
			unset($_SESSION['FLASH']);
			return $flash;
		}));


		try {
			echo $twig->render($view . '.twig', $args);
		} catch (LoaderError | RuntimeError | SyntaxError $e) {
			echo '<pre>' . $e . '</pre>';
		}
		exit();
	}
}