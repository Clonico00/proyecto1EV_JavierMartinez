<?php

namespace models;

use Lib\BaseDatos;

class Rutas extends BaseDatos
{
    private $id;
    private $nombre;
    private $descripcion;
    private $duracion;
    private $dificultad;
    private $imagen;
    private $id_usuario;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getDuracion()
    {
        return $this->duracion;
    }
    public function getDificultad()
    {
        return $this->dificultad;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function getId_usuario()
    {
        return $this->id_usuario;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }
    public function setDificultad($dificultad)
    {
        $this->dificultad = $dificultad;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    public static function fromArray(array $data) : Rutas
    {
        $rutas = new Rutas();
        $rutas->setId($data['id']);
        $rutas->setNombre($data['nombre']);
        $rutas->setDescripcion($data['descripcion']);
        $rutas->setDuracion($data['duracion']);
        $rutas->setDificultad($data['dificultad']);
        $rutas->setImagen($data['imagen']);
        $rutas->setId_usuario($data['id_usuario']);
        return $rutas;
    }


}