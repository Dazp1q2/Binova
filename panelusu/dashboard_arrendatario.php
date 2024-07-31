<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'arrendatario') {
    header("Location: ../registro/login.php");
    exit();
}
include "../assets/header.php";
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendatario</h3>
        <ul>
            <li><a href="editar_perfilarre.php">Editar Perfil</a></li>
            <li><a href="favoritos.php">Propiedades Favoritas</a></li>
            <li><a href="solicitudes.php">Solicitudes de Arrendamiento</a></li>
            <li><a href="mensajes.php">Mensajes</a></li>
            <li><a href="historial.php">Historial de Arrendamientos</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="content">
        <!-- Aquí se cargará el contenido dinámicamente -->
        <h2>Bienvenido al Panel del Arrendatario</h2>
        <p>Seleccione una opción del menú para comenzar.</p>
    </div>
</div>

<?php include "../assets/footer.php"; ?>
