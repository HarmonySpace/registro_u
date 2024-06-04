<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/MenuModel.php';

class MenuController extends Controller
{
	public function __construct()
	{
		$this->model = new MenuModel();
	}
	public function handleRequest()
	{
		$this->processRequest();
	}
	public function menus()
	{
		$menus = $this->model->findAll();
		$response = [
			'data' => $menus
		];
		echo json_encode($response);
	}
  public function menu() {
    $data = array(
      'id_menu' => $_GET['id']
    );
    $menu = $this->model->find($data);
    $response = [
      'data' => $menu
    ];
    echo json_encode($response);
  }
	public function create()
	{
		$data = array(
			'tipo_menu' => $_POST['type'],
		);
		$exist = $this->model->find($data);
		if ($exist) {
			$response = [
				'data' => 'false',
				'message' => 'El menu <span class="bold">' . $_POST['name'] . '</span> de tipo <span class="bold">' . $_POST['type'] . '</span> ya existe, intente con otro nombre'
			];
		} else {
		  $data = array(
		    'nombre' => $_POST['name'],
		    'tipo_menu' => $_POST['type'],
		    'activo' => $_POST['active'],
		    'eliminado' => $_POST['deleted'],
		    'modulos' => json_decode($_POST['moduls'], true)
		  );
			$this->model->create($data);
			$response = [
				'data' => 'true'
			];
		}
		echo json_encode($response);
  }
  public function update () {
    $id = $_POST['id'];
    $data = array(
		  'tipo_menu' => $_POST['type'],
		);
    $exist = $this->model->findOther($data, $id);
    if ($exist) {
      $response = [
        'data' => 'false',
				'message' => 'El menú tipo <span class="bold">' . $_POST['type'] . '</span> ya existe, intente con otro tipo'
      ];
    } else {
      $data = array(
        'id' => $_POST['id'],
        'nombre' => $_POST['name'],
		    'tipo_menu' => $_POST['type'],
		    'activo' => $_POST['active'],
		    'eliminado' => $_POST['deleted'],
		    'modulos' => json_decode($_POST['moduls'], true)
      );
      $this->model->update($data);
      $response = [
        'data' => 'true'
      ];
    }
    echo json_encode($response);
  }
}

$controller = new MenuController();
$controller->handleRequest();
