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

    public function busqueda()
    {
        // Comprobamos si se ha enviado el formulario
        $campo = $_POST['campos'];
        $valor = $_POST['busquedaCampo'];
        // hacemos la validacion de los datos
        if (htmlspecialchars($valor, ENT_QUOTES, 'UTF-8')) {
            $valor = filter_var($valor, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/")));
            // hacemos la consulta
            $sql = "SELECT * FROM senderismo.rutas WHERE lower($campo) LIKE lower('%$valor%')";
            $consult = $this->rutas->conexion->prepare($sql);
            // Ejecutamos la consulta
            if ($consult->execute()) {
                $result = $consult->fetchAll();
                // Comprobamos si hay resultados si no hay resultados mostramos un mensaje, si hay se los enviamos a la vista
                if ($result) {
                    $this->pages->render('../views/rutas/mostrar', ['rutas' => $result]);
                } else {
                    echo "No se han encontrado resultados";
                }
            } else {
                header('Location: index.php?controller=Rutas&action=verTodas');
            }
        } else {
            echo "No se ha podido realizar la busqueda";
        }

    }

    public function eliminar()
    {
        $id = $_POST['id'];
        // para borrar una ruta primero tenemos que borrar los comentarios que tenga debido a la clave foranea
        $sql = "DELETE FROM senderismo.rutas_comentarios WHERE id_ruta = :id";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':id', $id);
        if ($consult->execute()) {
            // si se han borrado los comentarios procedemos a borrar la ruta
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
        $id = $_POST['id'];
        //para modificar lka ruta la buscamos por el id
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
        // comprobamos si se ha enviado el formulario
        $data = $_POST['data'];
        // validamos todos los datos
        if (empty($data['titulo'])) {
            $this->pages->render('../views/rutas/modificar', ['error' => 'No se puede realizar la operación: el campo \'Título\' es obligatorio.']);
        } else if (empty($data['descripcion']) || empty($data['desnivel'])) {
            $this->pages->render('../views/rutas/modificar', ['error' => 'No se puede realizar la operación: el campo \'Descripción/Desnivel es obligatorio.\'']);
        } else if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $data['distancia'])) {
            $this->pages->render('../views/rutas/modificar', ['error' => 'ERROR: El formato del campo Distancia es incorrecto.']);
        } else {
            $data['titulo'] = filter_var($data['titulo'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
            if (htmlspecialchars($data['titulo'], ENT_QUOTES, 'UTF-8') && $data['titulo']) {
                $data['descripcion'] = filter_var($data['descripcion'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                if (htmlspecialchars($data['descripcion'], ENT_QUOTES, 'UTF-8') && $data['descripcion']) {
                    $data['desnivel'] = filter_var($data['desnivel'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                    if (htmlspecialchars($data['desnivel'], ENT_QUOTES, 'UTF-8') && $data['desnivel']) {
                        //una vez validados los datos procedemos a actualizar la ruta
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
                    } else {
                        $this->pages->render('../views/rutas/modificar', ['error' => 'ERROR: El formato del campo Desnivel es incorrecto.']);
                    }
                } else {
                    $this->pages->render('../views/rutas/modificar', ['error' => 'ERROR: El formato del campo Descripción es incorrecto.']);
                }
            } else {
                $this->pages->render('../views/rutas/modificar', ['error' => 'ERROR: El formato del campo Título es incorrecto.']);
            }
        }

    }

    public function verTodas()
    {
        //iniciamo la sesion para poder acceder a las variables de sesion y comprobar si el usuario esta logueado
        session_start();
        $sql = "SELECT * FROM senderismo.rutas";
        $consult = $this->rutas->conexion->prepare($sql);
        if ($consult->execute()) {
            $result = $consult->fetchAll();
            if ($result) {
                // si el usuario esta logeado le pasamos a la vista un parametro para que pueda ver el boton de modificar, comentar y eliminar
                if (isset($_SESSION['usuario'])) {
                    $this->pages->render('../views/rutas/mostrarTodas', ['rutas' => $result, 'logeado' => true]);
                } else {
                    $this->pages->render('../views/rutas/mostrarTodas', ['rutas' => $result, 'logeado' => false]);
                }
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
        // comprobamos si se ha enviado el formulario
        $data = $_POST['data'];
        // validamos todos los datos
        if (empty($data['titulo'])) {
            $this->pages->render('../views/rutas/crear', ['error' => 'No se puede realizar la operación: el campo \'Título\' es obligatorio.']);
        } else if (empty($data['descripcion']) || empty($data['desnivel'])) {
            $this->pages->render('../views/rutas/crear', ['error' => 'No se puede realizar la operación: el campo \'Descripción/Desnivel es obligatorio.\'']);
        } else if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $data['distancia'])) {
            $this->pages->render('../views/rutas/crear', ['error' => 'ERROR: El formato del campo Distancia es incorrecto.']);
        } else {
            $data['titulo'] = filter_var($data['titulo'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
            if (htmlspecialchars($data['titulo'], ENT_QUOTES, 'UTF-8') && $data['titulo']) {
                $data['descripcion'] = filter_var($data['descripcion'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                if (htmlspecialchars($data['descripcion'], ENT_QUOTES, 'UTF-8') && $data['descripcion']) {
                    $data['desnivel'] = filter_var($data['desnivel'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                    if (htmlspecialchars($data['desnivel'], ENT_QUOTES, 'UTF-8') && $data['desnivel']) {
                        //una vez validados los datos procedemos a insertar la ruta
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
                    } else {
                        $this->pages->render('../views/rutas/crear', ['error' => 'ERROR: El formato del campo Desnivel es incorrecto.']);
                    }
                } else {
                    $this->pages->render('../views/rutas/crear', ['error' => 'ERROR: El formato del campo Descripción es incorrecto.']);
                }
            } else {
                $this->pages->render('../views/rutas/crear', ['error' => 'ERROR: El formato del campo Título es incorrecto']);
            }
        }

    }

    public function comentar()
    {
        // comprobamos si se ha enviado el formulario
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
        // comprobamos si se ha enviado el formulario y hacemos una consulta para obtener los datos de la ruta
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
                //una vez validados los datos procedemos a insertar el comentario
                if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $data['fecha'])) {
                    $data['nombre'] = filter_var($data['nombre'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                    if (htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8') && $data['nombre']) {
                        $data['comentario'] = filter_var($data['comentario'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                        if (htmlspecialchars($data['comentario'], ENT_QUOTES, 'UTF-8') && $data['comentario']) {
                            $sql = "INSERT INTO senderismo.rutas_comentarios (id_ruta, nombre, fecha, texto) VALUES (:id_ruta, :nombre, :fecha, :comentario)";
                            $consult = $this->rutas->conexion->prepare($sql);
                            $consult->bindParam(':id_ruta', $data['id_ruta']);
                            $consult->bindParam(':nombre', $data['nombre']);
                            $consult->bindParam(':fecha', $data['fecha']);
                            $consult->bindParam(':comentario', $data['comentario']);
                            if ($consult->execute()) {
                                header('Location: index.php?controller=Rutas&action=comentar&id=' . $data['id_ruta']);
                            } else {
                                header('Location: index.php?controller=Rutas&action=comentar&id=' . $data['id_ruta']);
                            }
                        } else {
                            echo "<h3 style='color: red'>ERROR: El formato del campo Comentario es incorrecto.</h3>";
                        }
                    } else {
                        echo "<h3 style='color: red'>ERROR: El formato del campo Nombre es incorrecto.</h3>";
                    }
                } else {
                    echo "<h3 style='color: red'>ERROR: El formato del campo Fecha es incorrecto.</h3>";
                }


            }
        } else {
            header('Location: index.php?controller=Rutas&action=comentar&id=' . $data['id_ruta']);
        }
    }

    public function registrarse()
    {
        $this->pages->render('../views/rutas/registrarse');
    }

    public function registro()
    {
        // comprobamos si se ha enviado el formulario
        $data = $_POST['data'];
        $sql = "SELECT * FROM senderismo.usuarios WHERE senderismo.usuarios.usuario = :usuario";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':usuario', $data['usuario']);
        if ($consult->execute()) {
            $result = $consult->fetch();
            //comprobamos que no exista el usuario
            if ($result) {
                $this->pages->render('../views/rutas/registrarse', ['error' => 'ERROR: Ya existe un usuario con ese nombre.']);
            } else {
                //una vez validados los datos procedemos a insertar el usuario
                $data['usuario'] = filter_var($data['usuario'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                if (htmlspecialchars($data['usuario'], ENT_QUOTES, 'UTF-8') && $data['usuario']) {
                    $data['password'] = filter_var($data['password'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                    if (htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8') && $data['password']) {
                        $data['nombre'] = filter_var($data['nombre'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                        if (htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8') && $data['nombre']) {
                            $data['apellidos'] = filter_var($data['apellidos'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")));
                            if (htmlspecialchars($data['apellidos'], ENT_QUOTES, 'UTF-8') && $data['apellidos']) {
                                $data['email'] = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
                                if (htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') && $data['email']) {
                                    //encriptamos la contraseña
                                    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 4]);
                                    $sql = "INSERT INTO senderismo.usuarios (usuario, pass, nombre, apellidos, email) VALUES (:usuario, :pass, :nombre, :apellidos, :email)";
                                    $consult = $this->rutas->conexion->prepare($sql);
                                    $consult->bindParam(':usuario', $data['usuario']);
                                    $consult->bindParam(':pass', $data['password']);
                                    $consult->bindParam(':nombre', $data['nombre']);
                                    $consult->bindParam(':apellidos', $data['apellidos']);
                                    $consult->bindParam(':email', $data['email']);
                                    if ($consult->execute()) {
                                        header('Location: index.php?controller=Rutas&action=verTodas');
                                    } else {
                                        header('Location: index.php?controller=Rutas&action=registrarse');
                                    }
                                } else {
                                    $this->pages->render('../views/rutas/registrarse', ['error' => 'ERROR: El formato del campo Email es incorrecto.']);
                                }
                            } else {
                                $this->pages->render('../views/rutas/registrarse', ['error' => 'ERROR: El formato del campo Apellidos es incorrecto.']);
                            }
                        } else {
                            $this->pages->render('../views/rutas/registrarse', ['error' => 'ERROR: El formato del campo Nombre es incorrecto.']);
                        }
                    } else {
                        $this->pages->render('../views/rutas/registrarse', ['error' => 'ERROR: El formato del campo Contraseña es incorrecto.']);
                    }
                } else {
                    $this->pages->render('../views/rutas/registrarse', ['error' => 'ERROR: El formato del campo Usuario es incorrecto.']);
                }
            }
        } else {
            header('Location: index.php?controller=Rutas&action=registrarse');
        }
    }

    public function logearse()
    {
        $this->pages->render('../views/rutas/logearse');
    }

    public function login()
    {
        //iniciamos la sesion
        session_start();
        $data = $_POST['data'];
        $sql = "SELECT * FROM senderismo.usuarios WHERE senderismo.usuarios.usuario = :usuario";
        $consult = $this->rutas->conexion->prepare($sql);
        $consult->bindParam(':usuario', $data['usuario']);
        if ($consult->execute()) {
            $result = $consult->fetch();
            //comprobamos que exista el usuario
            if ($result) {
                //comprobamos que la contraseña sea correcta
                if (password_verify($data['password'], $result['pass'])) {
                    //creamos la sesion
                    $_SESSION['usuario'] = $result['usuario'];
                    $_SESSION['nombre'] = $result['nombre'];
                    $_SESSION['apellidos'] = $result['apellidos'];
                    $_SESSION['email'] = $result['email'];
                    header('Location: index.php?controller=Rutas&action=verTodas');
                } else {
                    $this->pages->render('../views/rutas/logearse', ['error' => 'ERROR: La contraseña es incorrecta.']);
                }
            } else {
                $this->pages->render('../views/rutas/logearse', ['error' => 'ERROR: No existe ningún usuario con ese nombre.']);
            }
        } else {
            header('Location: index.php?controller=Rutas&action=logearse');
        }
    }

    public function logout()
    {
        //iniciamos la sesion y la destruimos
        session_start();
        session_destroy();
        header('Location: index.php?controller=Rutas&action=verTodas');
    }
}