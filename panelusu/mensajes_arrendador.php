<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'arrendador') {
    header("Location: ../registro/login.php");
    exit();
}
include "../assets/header.php";
require_once "../class/conex.php";

$database = new Database();
$pdo = $database->getConnection();

// Obtener mensajes del arrendador actual
$stmt = $pdo->prepare("SELECT * FROM mensajes WHERE arrendador_id = :arrendador_id ORDER BY fecha_envio DESC");
$stmt->execute(['arrendador_id' => $_SESSION['user_id']]);
$mensajes = $stmt->fetchAll();
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendador</h3>
        <ul>
            <li><a href="editar_perfil.php">Editar Perfil</a></li>
            <li><a href="propiedades.php">Propiedades</a></li>
            <li><a href="solicitudes_arrendador.php">Solicitudes de Arrendamiento</a></li>
            <li class="disabled"><a href="mensajes_arrendador.php">Mensajes</a></li>
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
