<link rel="stylesheet" href="../../styles/styles.css">
<div class="table">
    <table border="2px">
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Desnivel</th>
            <th>Distancia</th>
            <th>Dificultad</th>
            <th>Notas</th>
            <th>Operaciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($rutas != null) {
            foreach ($rutas as $ruta): ?>
                <tr>
                    <td><?= $ruta['titulo']; ?></td>
                    <td><?= $ruta['descripcion']; ?></td>
                    <td><?= $ruta['desnivel']; ?></td>
                    <td><?= $ruta['distancia']; ?></td>
                    <td><?= $ruta['dificultad']; ?></td>
                    <td><?= $ruta['notas']; ?></td>
                    <td>
                        <?php
                        /* comprobamos $error para mostrarle el form o no
                         * */
                        if (isset($logeado)) {
                            if ($logeado) {
                                ?>
                                <br>
                                <form action="index.php?controller=Rutas&action=comentar" method="post">
                                    <input type="hidden" name="id" value="<?= $ruta['id']; ?>">
                                    <input type="submit" name="enviar" value="Comentar">
                                </form>
                                <form action="index.php?controller=Rutas&action=eliminar" method="post">
                                    <input type="hidden" name="id" value="<?= $ruta['id']; ?>">
                                    <input type="submit" name="enviar" value="Eliminar">
                                </form>
                                <form action="index.php?controller=Rutas&action=modificar" method="post">
                                    <input type="hidden" name="id" value="<?= $ruta['id']; ?>">
                                    <input type="submit" name="enviar" value="Modificar">
                                </form>
                                <?php
                            } else {
                                echo "Debes estar logeado para comentar";
                            }
                        }
                        ?>

                        </td>

                </tr>
            <?php endforeach;
        } else {
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
    </table>

    <?php
    if ($rutas != null) {
        echo "Numero de rutas: " . count($rutas);
    } else {
        echo "Numero de rutas: 0";
    }
    ?>


</div>
