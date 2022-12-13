<h3>Crear Ruta</h3>
<form action="index.php?controller=Rutas&action=insertar" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="data[titulo]" id="titulo">

    <label for="descripcion">Descripcion</label>
    <input type="text" name="data[descripcion]" id="descripcion">

    <label for="desnivel">Desnivel</label>
    <input type="text" name="data[desnivel]" id="desnivel">

    <label for="distancia">Distancia</label>
    <input type="text" name="data[distancia]" id="distancia">

    <label for="dificultad">Dificultad</label>
    <input type="text" name="data[dificultad]" id="dificultad">

    <label for="notas">Notas</label>
    <input type="text" name="data[notas]" id="notas">

    <input type="submit" value="Actualizar">
</form>
