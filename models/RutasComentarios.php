<?php

namespace models;

use Lib\BaseDatos;

class RutasComentarios extends BaseDatos
{
    private $id;
    private $comentario;
    private $id_usuario;
    private $id_ruta;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getComentario()
    {
        return $this->comentario;
    }
    public function getId_usuario()
    {
        return $this->id_usuario;
    }
    public function getId_ruta()
    {
        return $this->id_ruta;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    public function setId_ruta($id_ruta)
    {
        $this->id_ruta = $id_ruta;
    }

}