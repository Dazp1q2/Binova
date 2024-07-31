<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $params = ['email' => $email];
        $result = $this->select($sql, $params);
        return $result ? $result[0] : null;
    }

    public function createUser($nombre, $email, $password, $rol)
    {
        $sql = "INSERT INTO users (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
        $params = [
            'nombre' => $nombre,
            'email' => $email,
            'password' => $password,
            'rol' => $rol
        ];
        return $this->insert($sql, $params);
    }
}
?>
