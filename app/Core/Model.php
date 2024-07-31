<?php

namespace App\Core;

use PDO;

class Model
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function select($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data)
    {
        $keys = array_keys($data);
        $fields = implode(',', $keys);
        $placeholders = ':' . implode(', :', $keys);
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($table, $data, $where)
    {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');

        $conditions = '';
        foreach ($where as $key => $value) {
            $conditions .= "$key = :$key AND ";
        }
        $conditions = rtrim($conditions, ' AND ');

        $sql = "UPDATE $table SET $fields WHERE $conditions";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(array_merge($data, $where));
    }

    public function delete($table, $where)
    {
        $conditions = '';
        foreach ($where as $key => $value) {
            $conditions .= "$key = :$key AND ";
        }
        $conditions = rtrim($conditions, ' AND ');

        $sql = "DELETE FROM $table WHERE $conditions";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($where);
    }
}
?>
