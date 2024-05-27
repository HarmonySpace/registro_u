<?php
abstract class Controller
{
	protected $model;
	abstract public function handleRequest();
	public function index()
	{
		echo "/// CONTROLLER -> " . get_called_class() . " <- ///";
	}
	protected function processRequest()
	{
		if (isset($_GET['request'])) {
			$request = $_GET['request'];
			if (method_exists($this, $request)) {
				$this->{$request}();
			} else {
				$this->index();
			}
		} elseif (isset($_POST['request'])) {
			$request = $_POST['request'];
			if (method_exists($this, $request)) {
				$this->{$request}();
			} else {
				$this->index();
			}
		} else {
			echo 'Petición no disponible en Controller';
		}
	}
}
