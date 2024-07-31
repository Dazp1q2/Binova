<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'arrendador') {
    header("Location: ../registro/login.php");
    exit();
}

require_once "../class/conex.php";
$database = new Database();
$pdo = $database->getConnection();

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("UPDATE rental_requests SET estado = 'rechazada' WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    header("Location: solicitudes_arrendador.php");
    exit();
}
?>
