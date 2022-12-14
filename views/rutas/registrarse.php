<?php
//comprobamos que no haya errores
if (isset($error)) {
    echo "<h3 style='color: red'>$error</h3>";

}
?>
<link rel="stylesheet" href="../../styles/styles.css">
<div class="form">
    <h3>Registrar Nuevo Uusuario</h3>
    <form action="index.php?controller=Rutas&action=registro" method="post">
        <label for="user">Usuario</label>
        <input type="text" name="data[usuario]" id="user" required>
        <br>
        <br>
        <label for="pass">Contraseña</label>
        <input type="password" name="data[password]" id="pass" required>
        <br>
        <br>
        <label for="nombre">Nombre</label>
        <input type="text" name="data[nombre]" id="nombre" required>
        <br>
        <br>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="data[apellidos]" id="apellidos" required>
        <br>
        <br>
        <label for="email">Email</label>
        <input type="email" name="data[email]" id="email" required>
        <br>
        <br>
        <input type="submit" value="Registrar">
    </form>
</div>

