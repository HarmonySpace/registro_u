<?php
require_once __DIR__ . '/Model.php';

class ModulModel extends Model {
	protected function getTable()
	{
			return 'modulos';
	}
	protected function getPrimaryKey()
	{
			return 'id_modulo';
	}
}