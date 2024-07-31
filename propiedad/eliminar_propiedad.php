<?php
session_start();

// Incluir archivo de configuración de la base de datos
require_once "../class/conex.php";

$database = new Database();
$pdo = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtener el ID de la propiedad a eliminar
    $id = $_GET['id'];
    // Eliminar la propiedad de la base de datos
    $stmt = $pdo->prepare("DELETE FROM properties WHERE id = :id");
    $stmt->execute(['id' => $id]);
    // Redirigir a propiedades.php con un mensaje de éxito
    header("Location: propiedades.php?message=delete_success");
    exit();
}
?>
