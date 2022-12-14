<link rel="stylesheet" href="../../styles/styles.css">
<?php

//comprobamos que no haya errores
if (isset($error)) {
    echo "<h3 style='color: red'>$error</h3>";
    ?>
    <div class="form">
        <h3>Modificar Ruta</h3>
        <form action="index.php?controller=Rutas&action=actualizar" method="post">
            <label for="titulo">Titulo</label>
            <input type="text" name="data[titulo]" id="titulo" value="">
            <br>
            <br>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="data[descripcion]" id="descripcion" value="">
            <br>
            <br>

            <label for="desnivel">Desnivel</label>
            <input type="text" name="data[desnivel]" id="desnivel" value="">
            <br>
            <br>

            <label for="distancia">Distancia</label>
            <input type="text" name="data[distancia]" id="distancia" value="">
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

            <input type="hidden" name="data[id]" value="">
            <input type="submit" value="Actualizar">
        </form>
    </div>

    <?php
} else {
    ?>
    <div class="form">
        <h3>Modificar Ruta</h3>
        <form action="index.php?controller=Rutas&action=actualizar" method="post">
            <label for="titulo">Titulo</label>
            <input type="text" name="data[titulo]" id="titulo" value="<?php echo $ruta['titulo'] ?>">
            <br>
            <br>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="data[descripcion]" id="descripcion" value="<?php echo $ruta['descripcion'] ?>">
            <br>
            <br>

            <label for="desnivel">Desnivel</label>
            <input type="text" name="data[desnivel]" id="desnivel" value="<?php echo $ruta['desnivel'] ?>">
            <br>
            <br>

            <label for="distancia">Distancia</label>
            <input type="text" name="data[distancia]" id="distancia" value="<?php echo $ruta['distancia'] ?>">
            <br>
            <br>

            <label for="dificultad">Dificultad</label>
            <select name="data[dificultad]" id="dificultad">
                <option value="<?php echo $ruta['dificultad'] ?>"><?php echo $ruta['dificultad'] ?></option>
                <option value="<?php echo $ruta['dificultad'] ?>"><?php echo $ruta['dificultad'] ?></option>
                <option value="<?php echo $ruta['dificultad'] ?>"><?php echo $ruta['dificultad'] ?></option>
            </select>
            <br>
            <br>

            <label for="notas">Notas</label>
            <textarea name="data[notas]" id="notas" cols="30" rows="10"><?php echo $ruta['notas'] ?></textarea>
            <br>
            <br>

            <input type="hidden" name="data[id]" value="<?php echo $ruta['id'] ?>">
            <input type="submit" value="Actualizar">
        </form>

    </div>

    <?php
}
?>





