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

// Obtener solicitudes de arrendamiento
$stmt = $pdo->prepare("SELECT rental_requests.*, properties.titulo, users.nombre 
                       FROM rental_requests 
                       JOIN properties ON rental_requests.propiedad_id = properties.id 
                       JOIN users ON rental_requests.usuario_id = users.id 
                       WHERE properties.usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $_SESSION['user_id']]);
$solicitudes = $stmt->fetchAll();
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendador</h3>
        <ul>
            <li><a href="editar_perfil.php">Editar Perfil</a></li>
            <li><a href="propiedades.php">Propiedades</a></li>
            <li class="disabled"><a href="solicitudes_arrendador.php">Solicitudes de Arrendamiento</a></li>
            <li><a href="mensajes_arrendador.php">Mensajes</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Solicitudes de Arrendamiento</h2>
        <?php if (count($solicitudes) > 0): ?>
            <ul>
                <?php foreach ($solicitudes as $solicitud): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($solicitud['titulo']); ?></h3>
                        <p>Arrendatario: <?php echo htmlspecialchars($solicitud['nombre']); ?></p>
                        <p>Mensaje: <?php echo htmlspecialchars($solicitud['mensaje']); ?></p>
                        <p>Fecha: <?php echo htmlspecialchars($solicitud['fecha_solicitud']); ?></p>
                        <p>Estado: <?php echo htmlspecialchars($solicitud['estado']); ?></p>
                        <a href="aceptar_solicitud.php?id=<?php echo $solicitud['id']; ?>" class="btn-accept">Aceptar</a>
                        <a href="rechazar_solicitud.php?id=<?php echo $solicitud['id']; ?>" class="btn-reject">Rechazar</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tienes solicitudes de arrendamiento.</p>
        <?php endif; ?>
    </div>
</div>

<?php include "../assets/footer.php"; ?>
