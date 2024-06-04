<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class UserController extends Controller
{
	public function __construct()
	{
		$this->model = new UserModel();
	}
	public function handleRequest()
	{
		$this->processRequest();
	}
	public function users()
	{
		$elements = $this->model->findAll();
		$response = [
			'data' => $elements
		];
		echo json_encode($response);
	}
  public function user() {
    $data = array(
      'id_usuario' => $_GET['id']
    );
    $element = $this->model->find($data);
    $response = [
      'data' => $element
    ];
    echo json_encode($response);
  }
	public function create()
	{
		$data = array(
			'inss' => $_POST['inss'],
		);
		$exist = $this->model->find($data);
		if ($exist) {
			$response = [
				'data' => 'false',
				'message' => 'El usuario con INSS <span class="bold">' . $_POST['inss'] . '</span> ya existe, intente con otro INSS'
			];
		} else {
		  $data = array(
		    'nombre' => $_POST['name'],
		    'apellidos' => $_POST['lastnames'],
		    'cod_fac' => $_POST['faculty'],
		    'cargo' => $_POST['range'],
		    'activo' => $_POST['active'],
		    'eliminado' => $_POST['deleted'],
		    'inss' => $_POST['inss'],
		    'id_menu' => $_POST['menu']
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
		  'inss' => $_POST['inss'],
		);
    $exist = $this->model->findOther($data, $id);
    if ($exist) {
      $response = [
        'data' => 'false',
				'message' => 'El usuario con INSS <span class="bold">' . $_POST['type'] . '</span> ya existe, intente con otro INSS'
      ];
    } else {
      $data = array(
				'id' => $_POST['id'],
        'nombre' => $_POST['name'],
		    'apellidos' => $_POST['lastnames'],
		    'cod_fac' => $_POST['faculty'],
		    'cargo' => $_POST['range'],
		    'activo' => $_POST['active'],
		    'eliminado' => $_POST['deleted'],
		    'inss' => $_POST['inss'],
		    'id_menu' => $_POST['menu']
      );
      $this->model->update($data);
      $response = [
        'data' => 'true'
      ];
    }
    echo json_encode($response);
  }
}

$controller = new UserController();
$controller->handleRequest();
