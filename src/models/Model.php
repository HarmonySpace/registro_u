<?php
require_once __DIR__ . "/../../config/conn.php";
abstract class Model {
	protected $db;
	public function __construct() {
		$this->db = Connection::getConnection();
	}
	public function findAll() {
		$query = "SELECT * FROM " . $this->getTable();
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function findAllOrder($data) {
		$query = "SELECT * FROM " . $this->getTable();
		$query .= " ORDER BY " . $data['column'] . " " . $data['order'];
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function find($data) {
		$query = "SELECT * FROM " . $this->getTable();
		$conditions = array();
		$values = array();
		foreach ($data as $key => $value) {
			$conditions[] = $key . " = :" . $key;
			$values[':'. $key] = $value;
		}
		$query .= " WHERE " . implode(' AND ', $conditions);
		$stmt = $this->db->prepare($query);
		$stmt->execute($values);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
  public function create($data) {
    $query = "INSERT INTO " . $this->getTable() . " (" . implode(', ', array_keys($data)) . ") VALUES (:" . implode(', :', array_keys($data)) . ")";
    $stmt = $this->db->prepare($query);
    foreach ($data as $key => $value) {
      if (is_int($value)) {
        $stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
      } elseif (is_bool($value)) {
        $stmt->bindValue(':' . $key, $value, PDO::PARAM_BOOL);
      } elseif (is_null($value)) {
        $stmt->bindValue(':' . $key, $value, PDO::PARAM_NULL);
      } elseif (is_array($value)) {
        $value = '{' . implode(', ', $value) . '}';
        $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
      } else {
        $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
      }
    }
    $stmt->execute();
  }

	public function update($data) {
		$query = "UPDATE " . $this->getTable() . " SET ";
		foreach ($data as $key => $value) {
			if ($key != 'id') {
				$query .= $key . " = :" . $key . ", ";
			}
		}
		$query = rtrim($query, ', ') . " WHERE " . $this->getPrimaryKey() . " = :id";
		$stmt = $this->db->prepare($query);
		foreach ($data as $key => $value) {
			$stmt->bindParam(':' . $key, $value);
		}
		$stmt->bindParam(':id', $data['id']);
		$stmt->execute();
	}

	abstract protected function getTable();
	abstract protected function getPrimaryKey();
}
