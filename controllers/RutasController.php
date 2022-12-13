<?php

namespace Controllers;
use Lib\Pages;
use models\Rutas;

class RutasController{
    private Pages $pages;
    private Rutas $rutas;

    public function __construct()
    {
        $this->pages = new Pages();
        $this->rutas = new Rutas();
    }

    public function default(){

    }

    public function busqueda(){
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
    public function eliminar(){
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

    public function modificar(){
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

    public function actualizar(){
        /*recogemos los datos que estan data*/
        $data = $_POST['data'];
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

    public function verTodas(){
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

    public function crear(){
        $this->pages->render('../views/rutas/crear');
    }

    public function insertar(){
        $data = $_POST['data'];
        $sql = "INSERT INTO senderismo.rutas (titulo, descripcion, desnivel, distancia, dificultad, notas) VALUES (:titulo, :descripcion, :desnivel, :distancia, :dificultad, :notas)";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':titulo', $data['titulo']);
        $consult->bindParam(':descripcion', $data['descripcion']);
        $consult->bindParam(':desnivel', $data['desnivel']);
        $consult->bindParam(':distancia', $data['distancia']);
        $consult->bindParam(':dificultad', $data['dificultad']);
        $consult->bindParam(':notas', $data['notas']);
        if ($consult->execute()) {
            $this->pages->render('verTodas');
        } else {
            $this->pages->render('verTodas');
        }
    }

}