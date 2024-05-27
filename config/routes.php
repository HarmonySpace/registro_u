<?php
$request = $_SERVER['REQUEST_URI'];
$viewDir = __DIR__ . '/../src/views/pages';

$editModul = '#^/modul/edit/([0-9]+)$#';

$routes = [
	'/' => '/home.html',
	'/moduls' => '/modul/moduls.html',
	'/modul/create' => '/modul/create.html',
	'/menus' => '/menu/menus.html',
	'/menu/create' => '/menu/create.html',
];

if (isset($routes[$request])) {
	require $viewDir . $routes[$request];
	exit;
}  elseif (preg_match($editModul, $request, $matches)) {
	$userId = $matches[1];
	require $viewDir . '/modul/edit.html';
	exit;
} else {
	require $viewDir . '/404.html';
	exit;
}
