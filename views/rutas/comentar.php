<?php
/* primero creamos una tabla en html para ver los datos de la ruta
 * segundo creamos una tabla en html para ver los comentarios de la ruta, pero la primera fila sera un formulario para añadir un comentario
 * comprobamos si el usuario ha comentado ya hoy, si es asi, le dejamos meter datos, si no no aparecerea el form*/
?>
<h3>Comentaraios Ruta</h3>
<table>
    <tr>
        <td>Titulo</td>
        <td><?= $ruta['titulo']; ?></td>
    </tr>
    <tr>
        <td>Descripcion</td>
        <td><?= $ruta['descripcion']; ?></td>
    </tr>
    <tr>
        <td>Desnivel</td>
        <td><?= $ruta['desnivel']; ?></td>
    </tr>
    <tr>
        <td>Distancia</td>
        <td><?= $ruta['distancia']; ?></td>
    </tr>
    <tr>
        <td>Dificultad</td>
        <td><?= $ruta['dificultad']; ?></td>
    </tr>
    <tr>
        <td>Notas</td>
        <td><?= $ruta['notas']; ?></td>
    </tr>
</table>

<?php
?>

<table border="1px">
    <tr>
        <td>Nombre</td>
        <td>Fecha</td>
        <td>Comentario</td>
    </tr>
    <tr>
        <form action="index.php?controller=Rutas&action=insertarComentario" method="post">
            <td><input type="text" name="data[nombre]" required></td>
            <td><input type="text" name="data[fecha]" value="<?= date('Y-m-d'); ?>"> </td>
            <td><input type="text" name="data[comentario]" required><input type="hidden" name="data[id_ruta]" value="<?= $ruta['id']; ?>"><input type="submit" value="Comentar"></td>
        </form>
    </tr>
    <?php
    /*comprobamos si tiene datos*/
    if($comentarios){
        foreach ($comentarios as $comentario) {
            ?>
            <tr>
                <td><?= $comentario['nombre']; ?></td>
                <td><?= $comentario['fecha']; ?></td>
                <td><?= $comentario['texto']; ?></td>
            </tr>
            <?php
        }
    }
