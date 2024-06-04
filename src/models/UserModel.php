<?php
require_once __DIR__ . '/Model.php';

class UserModel extends Model {
	protected function getTable()
	{
			return 'registro_usuarios';
	}
	protected function getPrimaryKey()
	{
			return 'id_usuario';
	}
}
