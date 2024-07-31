<?php include "../assets/header.php"; ?>

<section>
    <h2>Registro de Usuario</h2>
    <form action='p_registro.php' method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="rol">Tipo de Usuario:</label>
        <select id="rol" name="rol">
            <option value="arrendador">Arrendador</option>
            <option value="arrendatario">Arrendatario</option>
        </select><br><br>

        <input type="submit" value="Registrarse">
    </form>
</section>

<?php include "../assets/footer.php"; ?>
