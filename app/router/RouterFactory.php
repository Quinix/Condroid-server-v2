<?php

namespace App\Router;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Object;

class RouterFactory extends Object
{

	/**
	 * @return \Nette\Application\Routers\RouteList
	 */
	public function create()
	{
		$router = new RouteList();
		$router[] = new Route('index.php', 'Front:Homepage:default', Route::ONE_WAY);
		$router[] = new Route('api/2/<presenter>[/<cid>]', [
			'module' => 'Api',
			'presenter' => 'Default',
			'action' => 'default',
			'cid' => null]);

		$router[] = new Route('api/3/<presenter>[/<id>]', [
			'module' => 'Api3',
			'presenter' => 'Default',
			'action' => 'default',
			'cid' => null]);
		$router[] = new Route('admin/<presenter>/<action>[/<id>]', [
			'module' => 'Admin',
			'presenter' => 'Dashboard',
			'action' => 'default',
			'id' => null]);

		$router[] = new Route('<action>/[<id>]', [
			'module' => 'Front',
			'presenter' => 'Homepage',
			'action' => 'default']);

		return $router;
	}

}
