<?php
//comprobamos que no haya errores
if (isset($error)) {
    echo "<h3 style='color: red'>$error</h3>";

}
?>
<link rel="stylesheet" href="../../styles/styles.css">
<div class="form">
    <h2>Login</h2>
    <form action="index.php?controller=Rutas&action=login" method="post">
        <label for="usuario">Usuario</label>
        <input type="text" name="data[usuario]" id="usuario">
        <br>
        <br>
        <label for="password">Password</label>
        <input type="text" name="data[password]" id="password">
        <br>
        <br>
        <input type="submit" value="Login">
    </form>
</div>

