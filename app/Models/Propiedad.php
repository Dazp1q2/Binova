<?php

namespace App\Models;

use App\Core\Model;

class Propiedad extends Model
{
    public function getAll()
    {
        return $this->select("SELECT * FROM properties");
    }

    public function getById($id)
    {
        return $this->select("SELECT * FROM properties WHERE id = :id", ['id' => $id]);
    }

    public function create($data)
    {
        return $this->insert('properties', $data);
    }

    public function updateProperty($id, $data)
    {
        return $this->update('properties', $data, ['id' => $id]);
    }

    public function deleteProperty($id)
    {
        return $this->delete('properties', ['id' => $id]);
    }
}
?>
