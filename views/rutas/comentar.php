<link rel="stylesheet" href="../../styles/styles.css">

<div class="table">
    <h3>Comentarios Ruta</h3>
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
    // inciamos la sesion para poder usar las variables de sesion
    session_start();
    ?>
    <div class="tablacomentarios">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Comentario</th>
            </tr>
            <tr>
                <form action="index.php?controller=Rutas&action=insertarComentario" method="post">
                    <td><input type="text" name="data[nombre]" value="<?= $_SESSION['nombre']; ?>" required></td>
                    <td><input type="text" name="data[fecha]" value="<?= date('Y-m-d'); ?>"></td>
                    <td id="comentar"><input type="text" name="data[comentario]" required><input type="hidden"
                                                                                                 name="data[id_ruta]"
                                                                                                 value="<?= $ruta['id']; ?>"><input
                                type="submit" value="Comentar"></td>
                </form>
            </tr>
            <?php
            /*comprobamos si tiene datos*/
            if ($comentarios) {
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
            ?>
    </div>

</div>
