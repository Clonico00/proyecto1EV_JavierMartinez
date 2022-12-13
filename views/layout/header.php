<h2>Rutas Senderismo</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="busquedaCampo">Busqueda por el campo: </label>
    <select name="campos">
        <option >Titulo</option>
        <option >Descripcion</option>
        <option >Desnivel</option>
        <option >Distancia</option>
        <option >Dificultad</option>
    </select>
    <input type="text" name="busquedaCampo">
    <input type="submit" name="enviar" value="Enviar">
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" name="enviar" value="Crear Nueva Ruta">
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" name="enviar" value="Ver todas las rutas">
</form>
