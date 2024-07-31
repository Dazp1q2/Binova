<?php
session_start();
include "../assets/header.php";

// Incluir archivo de configuración de la base de datos
require_once "../class/conex.php";

$database = new Database();
$pdo = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de registro
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $precio = $_POST['precio'];
    $num_habitaciones = $_POST['num_habitaciones'];
    $num_banos = $_POST['num_banos'];
    $area = $_POST['area'];

    // Subir imagen
    $ruta_imagen = '';
    if ($_FILES['imagen']['tmp_name']) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $ruta = '../img/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
        $ruta_imagen = $ruta;
    }

    // Insertar los datos en la base de datos
    $stmt = $pdo->prepare("INSERT INTO properties (usuario_id, titulo, descripcion, ubicacion, precio, num_habitaciones, num_banos, area, ruta_imagen)
                            VALUES (:usuario_id, :titulo, :descripcion, :ubicacion, :precio, :num_habitaciones, :num_banos, :area, :ruta_imagen)");
    $stmt->execute([
        'usuario_id' => $_SESSION['user_id'],
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'ubicacion' => $ubicacion,
        'precio' => $precio,
        'num_habitaciones' => $num_habitaciones,
        'num_banos' => $num_banos,
        'area' => $area,
        'ruta_imagen' => $ruta_imagen
    ]);

    // Redirigir a propiedades.php con un mensaje de éxito
    header("Location: propiedades.php?message=add_success");
    exit();
}
?>

<section>
    <h2>Agregar Propiedad</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion"><br><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01"><br><br>
        <label for="num_habitaciones">Número de Habitaciones:</label>
        <input type="number" id="num_habitaciones" name="num_habitaciones" min="0"><br><br>
        <label for="num_banos">Número de Baños:</label>
        <input type="number" id="num_banos" name="num_banos" min="0"><br><br>
        <label for="area">Área:</label>
        <input type="number" id="area" name="area" min="0"><br><br>
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>
        <input type="submit" value="Agregar">
    </form>
</section>

<?php include "../assets/footer.php"; ?>
