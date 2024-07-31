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

// Obtener propiedades favoritas del usuario actual
$stmt = $pdo->prepare("SELECT properties.* FROM favoritos JOIN properties ON favoritos.propiedad_id = properties.id WHERE favoritos.usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $_SESSION['user_id']]);
$favoritos = $stmt->fetchAll();
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendatario</h3>
        <ul>
            <li><a href="editar_perfil.php">Editar Perfil</a></li>
            <li class="disabled"><a href="favoritos.php">Propiedades Favoritas</a></li>
            <li><a href="solicitudes.php">Solicitudes de Arrendamiento</a></li>
            <li><a href="mensajes.php">Mensajes</a></li>
            <li><a href="historial.php">Historial de Arrendamientos</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Propiedades Favoritas</h2>
        <?php if (count($favoritos) > 0): ?>
            <ul>
                <?php foreach ($favoritos as $favorito): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($favorito['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($favorito['descripcion']); ?></p>
                        <p>Ubicación: <?php echo htmlspecialchars($favorito['ubicacion']); ?></p>
                        <p>Precio: $<?php echo number_format($favorito['precio'], 2); ?></p>
                        <img src="<?php echo htmlspecialchars($favorito['ruta_imagen']); ?>" alt="Imagen de la propiedad" style="max-width: 100px;">
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tienes propiedades favoritas.</p>
        <?php endif; ?>
    </div>
</div>

<?php include "../assets/footer.php"; ?>
