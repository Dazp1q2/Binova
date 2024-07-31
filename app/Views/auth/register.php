<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="auth-container">
    <h2>Registrarse</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form action="/register/submit" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="arrendador">Arrendador</option>
                <option value="arrendatario">Arrendatario</option>
            </select>
        </div>
        <button type="submit">Registrarse</button>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
