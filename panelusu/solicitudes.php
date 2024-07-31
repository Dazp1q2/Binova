<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'arrendatario') {
    header("Location: ../registro/login.php");
    exit();
}
include "../assets/header.php";
require_once "../class/conex.php";

$database = new Database();
$pdo = $database->getConnection();

// Obtener solicitudes de arrendamiento del usuario actual
$stmt = $pdo->prepare("SELECT rental_requests.*, properties.titulo FROM rental_requests JOIN properties ON rental_requests.propiedad_id = properties.id WHERE rental_requests.usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $_SESSION['user_id']]);
$solicitudes = $stmt->fetchAll();
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendatario</h3>
        <ul>
            <li><a href="editar_perfil.php">Editar Perfil</a></li>
            <li><a href="favoritos.php">Propiedades Favoritas</a></li>
            <li class="disabled"><a href="solicitudes.php">Solicitudes de Arrendamiento</a></li>
            <li><a href="mensajes.php">Mensajes</a></li>
            <li><a href="historial.php">Historial de Arrendamientos</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Solicitudes de Arrendamiento</h2>
        <?php if (count($solicitudes) > 0): ?>
            <ul>
                <?php foreach ($solicitudes as $solicitud): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($solicitud['titulo']); ?></h3>
                        <p>Mensaje: <?php echo htmlspecialchars($solicitud['mensaje']); ?></p>
                        <p>Fecha: <?php echo htmlspecialchars($solicitud['fecha_solicitud']); ?></p>
                        <p>Estado: <?php echo htmlspecialchars($solicitud['estado']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No has enviado ninguna solicitud de arrendamiento.</p>
        <?php endif; ?>
    </div>
</div>

<?php include "../assets/footer.php"; ?>
