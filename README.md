# proyecto1EV_JavierMartinez
PROYECTO SENDERISMO
Se desea crear una web de rutas de senderismo con un aspecto parecido al siguiente:
Observa que se ofrecen varios botones para gestionar las rutas: buscar ruta, añadir nueva ruta, mostrar las rutas guardadas (listado completo). Además, en cada ruta aparecen los botones que permiten modificar sus datos (Editar), borrar una ruta (Borrar) y añadir comentarios a la misma (Comentar).
Notas de interés para el implementar el proyecto:
a. La base de datos para trabajar en este proyecto se llamará “senderismo” y tendrá la siguiente estructura:
• “rutas”, con los datos de las rutas, y
• “rutas_comentarios”, que contiene los diferentes comentarios acerca de las mismas.
b. La conexión a la base de datos será orientada a objetos. Preferiblemente PDO.
c. Para la resolución del ejercicio se implementará el MVC y se valorará positivamente el uso del patrón Repository.
d. Si deseas realizar el apartado “extra” deberás añadir a la base de dados senderismo una tabla que permita guardar los usuarios registrados . De cada usuario, se almacenará como mínimo sus datos personales, el nombre de usuario y la contraseña.
e. No es necesario que el ejercicio vaya acompañado de un archivo CSS.
f. Las imágenes presentadas, a continuación, no tienen por qué corresponder con el aspecto final de vuestra aplicación.
Se pide:
1. Añadir una ruta(botón Nueva ruta)
2. Modificar una ruta, nos mostrará los datos de dicha ruta dando la oportunidad de modificarlos tras pulsar el botón de editar.
Tanto en la opción Nueva ruta como en Editar:
• si se pulsa el botón Alta ruta o Modificar ruta sin escribir el título, se muestra el mensaje “No se puede realizar la operación: el campo 'Título' es obligatorio.” y no se hace nada.
• Si no se escribe la descripción o el desnivel se muestra el mensaje “No se puede realizar la operación: el campo 'Descripción/Desnivel es obligatorio.” y no se hace nada.
• Si se escribe la distancia de la ruta en formato incorrecto se muestra el mensaje “ERROR: El formato del campo Distancia es incorrecto.” y no se hace nada.
3. El botón Borrar, que aparece también junto a cada ruta, permite eliminar una ruta de la lista. Cuando se pulse, se borrarán también todos los comentarios que estén asociados a esa ruta en concreto.
4. El botón de Buscar permite mostrar los datos de la ruta que coinciden con la introducida:
5. Si se pulsa el botón “Comentar” aparecen los datos de la ruta y los comentarios asociados a la misma ordenados decrecientemente:
Además, permitirá añadir un nuevo comentario a la ruta. Ten en cuenta que los campos “Nombre” y “Comentario” son obligatorios a la hora de dar de alta un nuevo comentario.
Un mismo usuario no podrá realizar más de un comentario el mismo día sobre la misma ruta.
6. Apartado “extra”: En la página principal se mostrarán las opciones de búsqueda y de listado completo. Las opciones de editar, borrar o insertar nuevas rutas o comentarios sólo estarán disponibles para los usuarios registrados. Por lo tanto se debe de incluir la posibilidad de al menos hacer el login .
