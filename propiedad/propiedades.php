<?php
session_start();
include "../assets/header.php";

// Incluir archivo de configuración de la base de datos
require_once "../class/conex.php";

$database = new Database();
$pdo = $database->getConnection();

// Obtener propiedades del usuario actual
$stmt = $pdo->prepare("SELECT * FROM properties WHERE usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $_SESSION['user_id']]);
$propiedades = $stmt->fetchAll();
?>

<section class="properties-section">
    <div class="container">
        <h2>Propiedades Registradas</h2>
        <a href="agregar_propiedad.php" class="btn-add">Agregar Propiedad</a>
        <table class="properties-table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($propiedades as $propiedad) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($propiedad['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($propiedad['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($propiedad['ubicacion']); ?></td>
                        <td>$<?php echo number_format($propiedad['precio'], 2); ?></td>
                        <td><img src="<?php echo htmlspecialchars($propiedad['ruta_imagen']); ?>" alt="Imagen de la propiedad" class="property-image"></td>
                        <td>
                            <a href="editar_propiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn-edit">Editar</a>
                            <a href="eliminar_propiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn-delete" onclick="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include "../assets/footer.php"; ?>
