<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="auth-container">
    <h2>Recuperar Contraseña</h2>
    <?php if (isset($message)): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>
    <form action="/recover-password/submit" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Enviar Enlace de Recuperación</button>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
