<?php
session_start();
include "../assets/header.php";

// Incluir archivo de configuración de la base de datos
require_once "../class/conex.php";

$database = new Database();
$pdo = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de edición
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $precio = $_POST['precio'];
    // Subir imagen
    $ruta_imagen = '';
    if ($_FILES['imagen']['tmp_name']) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $ruta = '../img/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
        $ruta_imagen = $ruta;
    }
    // Actualizar la propiedad en la base de datos
    $stmt = $pdo->prepare("UPDATE properties SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, precio = :precio, ruta_imagen = :ruta_imagen WHERE id = :id");
    $stmt->execute(['id' => $id, 'titulo' => $titulo, 'descripcion' => $descripcion, 'ubicacion' => $ubicacion, 'precio' => $precio, 'ruta_imagen' => $ruta_imagen]);
    // Redirigir a propiedades.php con un mensaje de éxito
    header("Location: propiedades.php?message=edit_success");
    exit();
} else {
    // Obtener el ID de la propiedad a editar
    $id = $_GET['id'];
    // Obtener los datos de la propiedad de la base de datos
    $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $propiedad = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<section>
    <h2>Editar Propiedad</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $propiedad['titulo']; ?>" required><br><br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"><?php echo $propiedad['descripcion']; ?></textarea><br><br>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $propiedad['ubicacion']; ?>"><br><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $propiedad['precio']; ?>"><br><br>
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>
        <input type="submit" value="Guardar Cambios">
    </form>
</section>

<?php include "../assets/footer.php"; ?>
