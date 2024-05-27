<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ModulModel.php';

class ModulController extends Controller
{
	public function __construct()
	{
		$this->model = new ModulModel();
	}
	public function handleRequest()
	{
		$this->processRequest();
	}
	public function moduls()
	{
		$moduls = $this->model->findAll();
		$response = [
			'data' => $moduls
		];
		echo json_encode($response);
	}
	public function modulsOrder()
	{
		$data = array(
			'column' => $_GET['column'],
			'order' => $_GET['order']
		);
		$moduls = $this->model->findAllOrder($data);
		$response = [
			'data' => $moduls
		];
		echo json_encode($response);
	}
	public function modul()
	{
		$data = array(
			'id_modulo' => $_GET['id']
		);
		$modul = $this->model->find($data);
		$response = [
			'data' => $modul
		];
		echo json_encode($response);
	}

	public function create()
	{
		$data = array(
			'nombre' => $_POST['name'],
			'direccion' => $_POST['direction']
		);
		$exist = $this->model->find($data);
		if ($exist) {
			$response = [
				'data' => 'false',
				'message' => 'El modulo <span class="bold">' . $_POST['name'] . '</span> ya existe, intente con otro nombre'
			];
		} else {
			$this->model->create($data);
			$response = [
				'data' => 'true'
			];
		}
		echo json_encode($response);
	}

	public function update()
	{
		$data = array(
			'nombre' => $_POST['name'],
			'direccion' => $_POST['direction']
		);
		$exist = $this->model->find($data);
		if ($exist) {
			$response = [
				'data' => 'false',
				'message' => 'El modulo <span class="bold">' . $_POST['name'] . '</span> ya existe, intente con otro nombre'
			];
		} else {
			$data = array(
				'id' => $_POST['id'],
				'nombre' => $_POST['name']
			);
			$this->model->update($data);
			$response = [
				'data' => 'true'
			];
		}
		echo json_encode($response);
	}
}

$controller = new ModulController();
$controller->handleRequest();
