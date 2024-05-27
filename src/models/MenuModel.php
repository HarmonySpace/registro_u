<?php
require_once __DIR__ . '/Model.php';

class MenuModel extends Model {
	protected function getTable()
	{
			return 'menus';
	}
	protected function getPrimaryKey()
	{
			return 'id_menu';
	}
}