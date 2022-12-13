<h2>Mis rutas</h2>
<?php
foreach ($todas_mis_rutas as $fila) {
    echo "<br>";
    echo "Id: ".$fila ['id']."<br>";
    echo "Nombre: " . $fila['nombre'] . "<br>";
    echo "Descripcion: " . $fila['descripcion'] . "<br>";
    echo "Duracion: " . $fila['duracion'] . "<br>";
    echo "Dificultad: " . $fila['dificultad'] . "<br>";
    echo "Imagen: " . $fila['imagen'] . "<br>";
    echo "Id_usuario: " . $fila['id_usuario'] . "<br>";

}