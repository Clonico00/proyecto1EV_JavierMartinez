<link rel="stylesheet" href="../../styles/styles.css">
<div class="form">
    <h2>Rutas Senderismo</h2>
    <form action="index.php?controller=Rutas&action=busqueda" method="post">
        <label for="busquedaCampo">Busqueda por el campo: </label>
        <select name="campos">
            <option>Titulo</option>
            <option>Descripcion</option>
            <option>Desnivel</option>
            <option>Distancia</option>
            <option>Dificultad</option>
            <option>Notas</option>
        </select>
        <input type="text" name="busquedaCampo">
        <input type="submit" name="enviar" value="Enviar">
    </form>
    <form action="index.php?controller=Rutas&action=registrarse" method="post">
        <input type="submit" name="enviar" value="Registrarse" id="registro">
    </form>
    <form action="index.php?controller=Rutas&action=crear" method="post">
        <input type="submit" name="enviar" value="Crear Nueva Ruta" id="crear">
    </form>
    <form action="index.php?controller=Rutas&action=verTodas" method="post">
        <input type="submit" name="enviar" value="Ver todas las rutas" id="vertodas">
    </form>
    <hr>
</div>

