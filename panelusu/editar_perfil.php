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

// Manejar el formulario de edición de perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Actualizar el perfil en la base de datos
    $stmt = $pdo->prepare("UPDATE users SET nombre = :nombre, email = :email WHERE id = :id");
    $stmt->execute(['nombre' => $nombre, 'email' => $email, 'id' => $_SESSION['user_id']]);
    echo "<p>Perfil actualizado exitosamente.</p>";
}

// Obtener los datos actuales del usuario
$stmt = $pdo->prepare("SELECT nombre, email FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$usuario = $stmt->fetch();
?>

<div class="dashboard-container">
    <div class="sidebar">
        <h3>Panel del Arrendador</h3>
        <ul>
            <li><a href="editar_perfil.php">Editar Perfil</a></li>
            <li><a href="propiedades.php">Propiedades</a></li>
            <li><a href="mensajes.php">Mensajes</a></li>
            <li><a href="solicitudes.php">Solicitudes de Arrendamiento</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Editar Perfil</h2>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br><br>
            <input type="submit" value="Actualizar Perfil">
        </form>
    </div>
</div>

<?php include "../assets/footer.php"; ?>
