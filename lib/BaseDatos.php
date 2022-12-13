<?php
namespace lib;
use PDO;
use PDOException;

class BaseDatos {   // Tambien se puede poner como que la clase hereda de PDO

    public PDO $conexion;
    private mixed $resultado;

    public function __construct(
        private  string $servidor = SERVIDOR,
        private  string $usuario = USUARIO,
        private  string $password = PASS,
        private  string $baseDatos = BASE_DATOS
    ) {
        $this->conexion = $this->conectar();
    }

    private function conectar(): PDO {
        try {
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::MYSQL_ATTR_FOUND_ROWS => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            return new PDO("mysql:host=$this->servidor;dbname=$this->baseDatos", $this->usuario, $this->password, $opciones);
        }
        catch (PDOException $e) {
            echo "Ha surgido un error y no se puede conectar a la base de datos: " . $e->getMessage();
            exit;
        }
    }

    public function consulta(string $consultaSQL) : void {
        $this->resultado = $this->conexion->query($consultaSQL);
    }

    public function consultaPrep(string $consultaSQL, array $parametros = null) : array|bool {
        $this->resultado = $this->conexion->prepare($consultaSQL);

        try {
            if ($parametros != null) {
                $this->resultado->execute($parametros);
                return $this->extraerRegistro();
            } else {
                return $this->resultado->execute();
            }
        } catch (PDOException $e) {
            echo "Error al realizar la operación: " . $e->getMessage();
            return false;
        }
    }

    public function extraerRegistro() : bool|array {
        return ($fila = $this->resultado->fetch(PDO::FETCH_ASSOC)) ? $fila : false;
    }

    public function extraerTodos() : array {
        return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filasAfectadas() : int {
        return $this->resultado->rowCount();
    }

    public function ultimoIdInsertado() : int {
        return $this->conexion->lastInsertId();
    }

}
