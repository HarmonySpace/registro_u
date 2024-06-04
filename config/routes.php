<?php
$request = $_SERVER['REQUEST_URI'];
$viewDir = __DIR__ . '/../src/views/pages';

$editModul = '#^/modul/edit/([0-9]+)$#';
$editMenu = '#^/menu/edit/([0-9]+)$#';
$editUser = '#^/user/edit/([0-9]+)$#';

$routes = [
	'/' => '/home.html',
	'/moduls' => '/modul/moduls.html',
	'/modul/create' => '/modul/create.html',
	'/menus' => '/menu/menus.html',
	'/menu/create' => '/menu/create.html',
	'/users' => '/user/users.html',
	'/user/create' => '/user/create.html',
];

if (isset($routes[$request])) {
	require $viewDir . $routes[$request];
	exit;
} elseif (preg_match($editModul, $request, $matches)) {
	require $viewDir . '/modul/edit.html';
	exit;
} elseif (preg_match($editMenu, $request, $matches)) {
	require $viewDir . '/menu/edit.html';
	exit;
} elseif (preg_match($editUser, $request, $matches)) {
	require $viewDir . '/user/edit.html';
	exit;
} else {
	require $viewDir . '/404.html';
	exit;
}
