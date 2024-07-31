<?php
session_start();
require_once "../class/conex.php";

// Obtener el ID de la propiedad desde la URL
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Conectar a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Obtener los detalles de la propiedad
$stmt = $pdo->prepare("SELECT * FROM properties WHERE id = :id");
$stmt->execute(['id' => $property_id]);
$property = $stmt->fetch();

if (!$property) {
    echo "Propiedad no encontrada.";
    exit();
}

// Manejar la adición a favoritos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_favorito'])) {
    if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'arrendatario') {
        $usuario_id = $_SESSION['user_id'];
        $stmt = $pdo->prepare("INSERT INTO favoritos (usuario_id, propiedad_id) VALUES (:usuario_id, :propiedad_id)");
        $stmt->execute(['usuario_id' => $usuario_id, 'propiedad_id' => $property_id]);
        echo "<p>Propiedad agregada a favoritos.</p>";
    } else {
        echo "<p>Debes estar logueado como arrendatario para agregar a favoritos.</p>";
    }
}

// Manejar el envío de mensajes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar_mensaje'])) {
    if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'arrendatario') {
        $usuario_id = $_SESSION['user_id'];
        $mensaje = $_POST['mensaje'];
        $arrendador_id = $property['usuario_id'];
        $stmt = $pdo->prepare("INSERT INTO mensajes (usuario_id, arrendador_id, contenido) VALUES (:usuario_id, :arrendador_id, :contenido)");
        $stmt->execute(['usuario_id' => $usuario_id, 'arrendador_id' => $arrendador_id, 'contenido' => $mensaje]);
        echo "<p>Mensaje enviado al arrendador.</p>";
    } else {
        echo "<p>Debes estar logueado como arrendatario para enviar mensajes.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Propiedad</title>
    <link rel="stylesheet" href="../style/css.css">
</head>
<body>
    <?php include "../assets/header.php"; ?>

    <section class="property-details">
        <h2><?php echo htmlspecialchars($property['titulo']); ?></h2>
        <img src="<?php echo htmlspecialchars($property['ruta_imagen']); ?>" alt="Imagen de la propiedad">
        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($property['descripcion']); ?></p>
        <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($property['ubicacion']); ?></p>
        <p><strong>Precio:</strong> $<?php echo number_format($property['precio'], 2); ?></p>
        <p><strong>Habitaciones:</strong> <?php echo intval($property['num_habitaciones']); ?></p>
        <p><strong>Baños:</strong> <?php echo intval($property['num_banos']); ?></p>
        <p><strong>Área:</strong> <?php echo intval($property['area']); ?> m²</p>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'arrendatario'): ?>
            <form method="post">
                <input type="submit" name="agregar_favorito" value="Agregar a Favoritos">
            </form>
            <form method="post">
                <textarea name="mensaje" placeholder="Escribe tu mensaje al arrendador..."></textarea><br>
                <input type="submit" name="enviar_mensaje" value="Enviar Mensaje">
            </form>
        <?php endif; ?>
    </section>

    <?php include "../assets/footer.php"; ?>
</body>
</html>
