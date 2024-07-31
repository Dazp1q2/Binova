<?php include __DIR__ . '/../partials/header.php'; ?>

<section class="hero">
    <!-- Carrusel de imágenes -->
    <div class="carousel">
        <div class="carousel-item active">
            <img src="/BINOVA/public/imgcarousel/OIP.jpg" alt="Imagen 1">
        </div>
        <div class="carousel-item">
            <img src="/BINOVA/public/imgcarousel/OIP 1.jpg" alt="Imagen 2">
        </div>
        <div class="carousel-item">
            <img src="/BINOVA/public/imgcarousel/OIP 3.jpg" alt="Imagen 3">
        </div>
    </div>
    <div class="hero-content">
        <h2>Bienvenido a BINOVA</h2>
        <p>La plataforma que revoluciona el arrendamiento de propiedades horizontales.</p>
        
        <!-- Cuadro de búsqueda -->
        <form action="buscar.php" method="get" class="search-form">
            <input type="text" name="query" placeholder="Buscar propiedades...">
            <button type="submit">Buscar</button>
        </form>
    </div>
</section>

<!-- Listado de propiedades -->
<div class="properties-list">
    <?php if (isset($properties) && !empty($properties)): ?>
        <?php foreach ($properties as $property): ?>
            <div class="property">
                <img src="<?= $property['ruta_imagen'] ?>" alt="Imagen de la propiedad">
                <h3><?= $property['titulo'] ?></h3>
                <p><?= $property['descripcion'] ?></p>
                <p>Ubicación: <?= $property['ubicacion'] ?></p>
                <p>Precio: $<?= $property['precio'] ?></p>
                <a href="propiedad/detalles_propiedad.php?id=<?= $property['id'] ?>">Ver detalles</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay propiedades disponibles.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
<script src="/BINOVA/public/js/carousel.js"></script>
