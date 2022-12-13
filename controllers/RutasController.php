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
}