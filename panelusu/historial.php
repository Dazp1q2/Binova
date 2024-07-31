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

// Obtener historial de arrendamientos del usuario actual
$stmt = $pdo->prepare("SELECT properties.*, arrendamientos.fecha_inicio, arrendamientos.fecha_fin 
                       FROM arrendamientos 
                       JOIN properties ON arrendamientos.propiedad_id = properties.id 
                       WHERE arrendamientos.usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $_SESSION['user_id']]);
$historial = $stmt->fetchAll();
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendatario</h3>
        <ul>
            <li><a href="editar_perfil.php">Editar Perfil</a></li>
            <li><a href="favoritos.php">Propiedades Favoritas</a></li>
            <li><a href="solicitudes.php">Solicitudes de Arrendamiento</a></li>
            <li><a href="mensajes.php">Mensajes</a></li>
            <li class="disabled"><a href="historial.php">Historial de Arrendamientos</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Historial de Arrendamientos</h2>
        <?php if (count($historial) > 0): ?>
            <ul>
                <?php foreach ($historial as $arrendamiento): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($arrendamiento['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($arrendamiento['descripcion']); ?></p>
                        <p>Ubicación: <?php echo htmlspecialchars($arrendamiento['ubicacion']); ?></p>
                        <p>Precio: $<?php echo number_format($arrendamiento['precio'], 2); ?></p>
                        <p>Fecha de inicio: <?php echo htmlspecialchars($arrendamiento['fecha_inicio']); ?></p>
                        <p>Fecha de fin: <?php echo htmlspecialchars($arrendamiento['fecha_fin']); ?></p>
                        <img src="<?php echo htmlspecialchars($arrendamiento['ruta_imagen']); ?>" alt="Imagen de la propiedad" style="max-width: 100px;">
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tienes arrendamientos anteriores.</p>
        <?php endif; ?>
    </div>
</div>

<?php include "../assets/footer.php"; ?>
