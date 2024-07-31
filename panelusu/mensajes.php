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

// Obtener mensajes del usuario actual
$stmt = $pdo->prepare("SELECT * FROM mensajes WHERE usuario_id = :usuario_id OR arrendador_id = :usuario_id ORDER BY fecha_envio DESC");
$stmt->execute(['usuario_id' => $_SESSION['user_id']]);
$mensajes = $stmt->fetchAll();
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendatario</h3>
        <ul>
            <li><a href="editar_perfil.php">Editar Perfil</a></li>
            <li><a href="favoritos.php">Propiedades Favoritas</a></li>
            <li><a href="solicitudes.php">Solicitudes de Arrendamiento</a></li>
            <li class="disabled"><a href="mensajes.php">Mensajes</a></li>
            <li><a href="historial.php">Historial de Arrendamientos</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Mensajes</h2>
        <?php if (count($mensajes) > 0): ?>
            <ul>
                <?php foreach ($mensajes as $mensaje): ?>
                    <li>
                        <p><?php echo htmlspecialchars($mensaje['contenido']); ?></p>
                        <p>Fecha: <?php echo htmlspecialchars($mensaje['fecha_envio']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tienes mensajes.</p>
        <?php endif; ?>
    </div>
</div>

<?php include "../assets/footer.php"; ?>
