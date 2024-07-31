<?php
include "../class/conex.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $database = new Database();
    $conn = $database->getConnection();

    $stmt = $conn->prepare("INSERT INTO users (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':rol', $rol);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error al registrar usuario";
    }
}
?>
