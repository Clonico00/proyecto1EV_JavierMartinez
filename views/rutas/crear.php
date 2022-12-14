<h3>Crear Ruta</h3>

<?php
//comprobamos que no haya errores
if (isset($error)) {
        echo "<h3 style='color: red'>$error</h3>";

}
?>
<form action="index.php?controller=Rutas&action=insertar" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="data[titulo]" id="titulo">
    <br>
    <br>
    <label for="descripcion">Descripcion</label>
    <input type="text" name="data[descripcion]" id="descripcion">
    <br>
    <br>
    <label for="desnivel">Desnivel</label>
    <input type="text" name="data[desnivel]" id="desnivel">
    <br>
    <br>
    <label for="distancia">Distancia</label>
    <input type="text" name="data[distancia]" id="distancia">
    <br>
    <br>
    <label for="dificultad">Dificultad</label>
    <select name="data[dificultad]" id="dificultad">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <br>
    <br>
    <label for="notas">Notas</label>
    <textarea name="data[notas]" id="notas" cols="30" rows="10"></textarea>
    <br>
    <br>
    <input type="submit" value="Crear">
</form>
