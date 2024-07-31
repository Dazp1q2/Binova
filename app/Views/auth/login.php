<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="auth-container">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form action="/login/submit" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <div class="additional-options">
        <a href="recover_password.php">Recuperar Contraseña</a> | 
        <a href="register.php">Registrarse</a>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
