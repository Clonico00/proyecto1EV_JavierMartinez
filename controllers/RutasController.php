<?php

namespace Controllers;

use Lib\Pages;
use models\Rutas;

class RutasController
{
    private Pages $pages;
    private Rutas $rutas;

    public function __construct()
    {
        $this->pages = new Pages();
        $this->rutas = new Rutas();
    }

    public function default()
    {

    }

    public function busqueda()
    {
        $campo = $_POST['campos'];
        $valor = $_POST['busquedaCampo'];
        $sql = "SELECT * FROM senderismo.rutas WHERE $campo LIKE '%$valor%'";
        $consult = $this->rutas->conexion->prepare($sql);
        if ($consult->execute()) {
            $result = $consult->fetchAll();
            if ($result) {
                $this->pages->render('../views/rutas/mostrar', ['rutas' => $result]);
            } else {
                header('Location: index.php?controller=Rutas&action=verTodas');
            }
        } else {
            header('Location: index.php?controller=Rutas&action=verTodas');
        }
    }

    public function eliminar()
    {
        $id = $_POST['id'];
        /*eliminamos los comentarios asociados a esza ruta*/
        $sql = "DELETE FROM senderismo.rutas_comentarios WHERE id_ruta = :id";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':id', $id);
        if ($consult->execute()) {
            $sql = "DELETE FROM senderismo.rutas WHERE senderismo.rutas.id = :id";
            $consult = $this->rutas->conexion->prepare($sql);
            $consult->bindParam(':id', $id);
            if ($consult->execute()) {
                header('Location: index.php?controller=Rutas&action=verTodas');
            } else {
                header('Location: index.php?controller=Rutas&action=verTodas');
            }
        } else {
            header('Location: index.php?controller=Rutas&action=verTodas');
        }

    }

    public function modificar()
    {
        /*mostraremos un formulario con todos los campos, y en estos estaran los valores de la ruta, al enviar el form, se actualizara su valor*/
        $id = $_POST['id'];
        $sql = "SELECT * FROM senderismo.rutas WHERE senderismo.rutas.id = :id";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':id', $id);
        if ($consult->execute()) {
            $result = $consult->fetch();
            if ($result) {
                $this->pages->render('../views/rutas/modificar', ['ruta' => $result]);
            } else {
                header('Location: index.php?controller=Rutas&action=verTodas');
            }
        } else {
            header('Location: index.php?controller=Rutas&action=verTodas');
        }
    }

    public function actualizar()
    {
        $data = $_POST['data'];
        if (empty($data['titulo'])) {
            $this->pages->render('../views/rutas/modificar', ['error' => 'No se puede realizar la operación: el campo \'Título\' es obligatorio.']);
        } else if (empty($data['descripcion']) || empty($data['desnivel'])) {
            $this->pages->render('../views/rutas/modificar', ['error' => 'No se puede realizar la operación: el campo \'Descripción/Desnivel es obligatorio.\'']);
        } else if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $data['distancia'])) {
            $this->pages->render('../views/rutas/modificar', ['error' => 'ERROR: El formato del campo Distancia es incorrecto.']);
        } else {
            $sql = "UPDATE senderismo.rutas SET titulo = :titulo, descripcion = :descripcion, desnivel = :desnivel, distancia = :distancia, dificultad = :dificultad, notas = :notas WHERE senderismo.rutas.id = :id";
            $consult = $this->rutas->conexion->prepare($sql);
            $consult->bindParam(':id', $data['id']);
            $consult->bindParam(':titulo', $data['titulo']);
            $consult->bindParam(':descripcion', $data['descripcion']);
            $consult->bindParam(':desnivel', $data['desnivel']);
            $consult->bindParam(':distancia', $data['distancia']);
            $consult->bindParam(':dificultad', $data['dificultad']);
            $consult->bindParam(':notas', $data['notas']);
            if ($consult->execute()) {
                header('Location: index.php?controller=Rutas&action=verTodas');
            } else {
                header('Location: index.php?controller=Rutas&action=verTodas');
            }
        }

    }

    public function verTodas()
    {
        $sql = "SELECT * FROM senderismo.rutas";
        $consult = $this->rutas->conexion->prepare($sql);
        if ($consult->execute()) {
            $result = $consult->fetchAll();
            if ($result) {
                $this->pages->render('../views/rutas/mostrarTodas', ['rutas' => $result]);
            } else {
                $this->pages->render('../views/rutas/mostrar', ['rutas' => null]);
            }
        } else {
            $this->pages->render('../views/rutas/mostrar', ['rutas' => null]);
        }
    }

    public function crear()
    {
        $this->pages->render('../views/rutas/crear');
    }

    public function insertar()
    {
        $data = $_POST['data'];
        if (empty($data['titulo'])) {
            $this->pages->render('../views/rutas/crear', ['error' => 'No se puede realizar la operación: el campo \'Título\' es obligatorio.']);
        } else if (empty($data['descripcion']) || empty($data['desnivel'])) {
            $this->pages->render('../views/rutas/crear', ['error' => 'No se puede realizar la operación: el campo \'Descripción/Desnivel es obligatorio.\'']);
        } else if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $data['distancia'])) {
            $this->pages->render('../views/rutas/crear', ['error' => 'ERROR: El formato del campo Distancia es incorrecto.']);
        } else {
            $sql = "INSERT INTO senderismo.rutas (titulo, descripcion, desnivel, distancia, dificultad, notas) VALUES (:titulo, :descripcion, :desnivel, :distancia, :dificultad, :notas)";
            $consult = $this->rutas->conexion->prepare($sql);
            $consult->bindParam(':titulo', $data['titulo']);
            $consult->bindParam(':descripcion', $data['descripcion']);
            $consult->bindParam(':desnivel', $data['desnivel']);
            $consult->bindParam(':distancia', $data['distancia']);
            $consult->bindParam(':dificultad', $data['dificultad']);
            $consult->bindParam(':notas', $data['notas']);
            if ($consult->execute()) {
                header('Location: index.php?controller=Rutas&action=verTodas');
            } else {
                header('Location: index.php?controller=Rutas&action=verTodas');
            }
        }
    }

    public function comentar()
    {
        $id = $_POST['id'];
        $sql = "SELECT * FROM senderismo.rutas WHERE senderismo.rutas.id = :id";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':id', $id);
        if ($consult->execute()) {
            $result = $consult->fetch();
            if ($result) {
                //comprobamos que existe la ruta, ahora mostramos los comentarios
                $sql = "SELECT * FROM senderismo.rutas_comentarios WHERE senderismo.rutas_comentarios.id_ruta = :id ORDER BY senderismo.rutas_comentarios.fecha DESC";
                $consult = $this->rutas->conexion->prepare($sql);
                $consult->bindParam(':id', $id);
                if ($consult->execute()) {
                    $result2 = $consult->fetchAll();
                    //si hay comentarios se los pasamos a la vista
                    if ($result2) {
                        $this->pages->render('../views/rutas/comentar', ['ruta' => $result, 'comentarios' => $result2]);
                    } else {
                        $this->pages->render('../views/rutas/comentar', ['ruta' => $result, 'comentarios' => null]);
                    }
                }
            } else {
                header('Location: index.php?controller=Rutas&action=verTodas');
            }
        } else {
            header('Location: index.php?controller=Rutas&action=verTodas');
        }
    }

    public function insertarComentario()
    {
        /* primero comprobamos que no haya un comentario con el mismo nombre y la misma fecha, de ser asi le mandamos de vuelta a la comentar.php */
        $data = $_POST['data'];
        $sql = "SELECT * FROM senderismo.rutas_comentarios WHERE senderismo.rutas_comentarios.id_ruta = :id_ruta AND senderismo.rutas_comentarios.nombre = :nombre AND senderismo.rutas_comentarios.fecha = :fecha";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':id_ruta', $data['id_ruta']);
        $consult->bindParam(':nombre', $data['nombre']);
        $consult->bindParam(':fecha', $data['fecha']);
        if ($consult->execute()) {
            $result = $consult->fetch();
            if ($result) {
                echo "<h3 style='color: red'>Ya existe un comentario con ese nombre y fecha</h3>";
            } else {
                $sql = "INSERT INTO senderismo.rutas_comentarios (id_ruta, nombre, texto, fecha) VALUES (:id_ruta, :nombre, :texto, :fecha)";
                $consult = $this->rutas->conexion->prepare($sql);
                $consult->bindParam(':id_ruta', $data['id_ruta']);
                $consult->bindParam(':nombre', $data['nombre']);
                $consult->bindParam(':texto', $data['comentario']);
                $consult->bindParam(':fecha', $data['fecha']);
                if ($consult->execute()) {
                    echo "Comentario insertado";
                } else {
                    echo "Error al insertar el comentario";
                }
            }
        } else {
            header('Location: index.php?controller=Rutas&action=comentar&id=' . $data['id_ruta']);
        }
    }

}