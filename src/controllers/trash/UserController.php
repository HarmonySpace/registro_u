<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class UserController extends Controller {
	protected $userModel;
	public function __construct() {
		$this->userModel = new UserModel();
	}

	public function handleRequest() {
		$this->processRequest();
	}
	public function index() {
		echo "/// -> CONTROLLER(USER)";
	}
	public function getUsers() {
		$users = $this->userModel->getUsers();
		$response = [
			'data' => $users
		];
		echo json_encode($response);
		//print_r($users);
	}
	public function getUser() {
		$userId = $_GET['id'];
		$user = $this->userModel->getUser($userId);
		$response = [
			'data' => $user
		];
		echo json_encode($response);
	}
	public function postUser() {
		$data = [
			'user_name' => $_POST['name'],
			'user_key' => $_POST['key'],
			'user_fac' => $_POST['codFac'],
			'user_active' => $_POST['active'],
			'user_menu' => $_POST['menu'],
			'user_init' => $_POST['dateCreate'],
			'user_creator'=> $_POST['uCreator']
		];
		$this->userModel->postUser($data);
		$response = [
			'data' => $data
		];
		echo json_encode($response);
	}
	public function putUser() {
		$data = [
			'user_code' => $_POST['id'],
			'user_name' => $_POST['name'],
			'user_key' => $_POST['key'],
			'user_fac' => $_POST['codFac'],
			'user_active' => $_POST['active'],
			'user_menu' => $_POST['menu'],
			'user_init' => $_POST['dateCreate'],
			'user_creator'=> $_POST['uCreator']
		];
		$this->userModel->putUser($data);
		$response = [
			'data' => $data
		];
		echo json_encode($response);
	}
}

$controlador = new UserController();
$controlador->handleRequest();

