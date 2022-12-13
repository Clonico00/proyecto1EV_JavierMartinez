<?php
/*creamos un formulario html que tengas los datos de la ruta, y al enviarlo, se actualizara la ruta, los campos son titulo,
descripcion, desnivel,distancia,dificultad y notas, los datos estan en la variable $ruta*/

?>
<h3>Modificar Ruta</h3>
<form action="index.php?controller=Rutas&action=actualizar" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="data[titulo]" id="titulo" value="<?php echo $ruta['titulo'] ?>">

    <label for="descripcion">Descripcion</label>
    <input type="text" name="data[descripcion]" id="descripcion" value="<?php echo $ruta['descripcion'] ?>">

    <label for="desnivel">Desnivel</label>
    <input type="text" name="data[desnivel]" id="desnivel" value="<?php echo $ruta['desnivel'] ?>">

    <label for="distancia">Distancia</label>
    <input type="text" name="data[distancia]" id="distancia" value="<?php echo $ruta['distancia'] ?>">

    <label for="dificultad">Dificultad</label>
    <input type="text" name="data[dificultad]" id="dificultad" value="<?php echo $ruta['dificultad'] ?>">

    <label for="notas">Notas</label>
    <input type="text" name="data[notas]" id="notas" value="<?php echo $ruta['notas'] ?>">

    <input type="hidden" name="data[id]" value="<?php echo $ruta['id'] ?>">
    <input type="submit" value="Actualizar">
</form>



