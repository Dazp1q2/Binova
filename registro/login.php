<?php include "../assets/header.php"; ?>

<section>
    <h2>Iniciar Sesión</h2>
    <form action='p_login.php' method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
</section>

<?php include "../assets/footer.php"; ?>
