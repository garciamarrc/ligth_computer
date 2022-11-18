Nombre: Marco Antonio Garcia Gutierrez
Posicion deseada: Full stack.
Nivel de conocimiento de lenguajes:
- HTML 90%
- Javascript 85%
- CSS 80%
- PHP 80%
- SQL 70%
- Bootstrap 90%
- Jquery 90%
- Linux 90% (es el OS que uso en mi día a día)

Correo de contacto: social.6g0b3@aleeas.com
Página de internet: https://marcogarz.netlify.app/

Nivel para resolver el Assessment:
- Creación de base de datos: INTERMEDIO
- Comunicacion PHP con la base de datos: INTERMEDIO
- Carpeta public_html: AVANZADO


Sobre el proyecto: Ligth Computer

Ligth computer es el nombre del proyecto del Assessment que me fue enviado

Entre las características más destacables se encuentran las siguientes:
- Router creado desde 0 para manejar URLs amigables y relacionarlas dinamicamente con los controladores, metodos y parametros correspondientes.
- Vistas cargadas desde un helper, de esta forma aumenta la facilidad de desarrollo debido a que la configuracion se encuentra centralizada.
- Uso de componentes para la segmentacion de las vistas y de esa forma facilitar su lectura como desarrollador.
- Patrón de arquitectura MVC.

El ciclo de vida de procesamiento de la app web es el siguiente:
1. La petición es interceptada por el .htaccess, el cual convierte la URL en un parametro GET que recibira index.php.
2. Index.php inicializa constantes que son usadas en toda la app, además de inicializar el Router usando como parametro la Request.
3. La Request filtra, sanitiza y convierte la URL en strings de controlador, metodo y (en caso de que existan) parametros.
4. El Router usa la Request recién creada y carga los controladores haciendo uso de los metodos con los parametros que la Request haya definido.
5. El trabajo pasa al metodo del controlador, que en la gran mayoría de las veces obtendrá datos de los modelos para finalmente renderizar vistas con el helper View.
6. Finalmente la vista es entregada al cliente con los datos renderizados en la misma.

Requisitos para montar el proyecto:
- Composer
- PHP 7.4
- Extensiones de PHP para conectarse a mysql (php7.4-mysql)
- XAMPP

Pasos para montar el proyecto:
1. Clonar el respositorio desde Github y mover a la carpeta de XAMPP
2. Ejecutar desde la raíz del proyecto composer dump-autoload
3. Modificar el archivo install/config.ini y definir lo siguiente:
    - HOST: Host de la base de datos
    - DATABASE: Nombre de la base de datos
    - USER: Usuario de la base de datos
    - Password: Contraseña de la base de datos
    - CHARSET: Charset de la base de datos, en caso de no necesitar alguna en especifica mantenerla tal cual se encuentra

    (ES IMPORTANTE QUE LAS SIGUIENTES DOS VARIABLES FINALICEN EN "/")
    - APP_FOLDER: Nombre de la carpeta a la que movimos el proyecto para usarlo desde XAMPP
    - APP_URL: Url de la app, comunmente se deja como está.

4. Ejecutar el script de SQL que se encuentra en install/init.sql para inicializar la base de datos.
5. Ejecutar desde la raíz del proyecto php install/init.php para poblar la base de datos con mayor cantidad de recursos.
6. Una vez hecho esto se podrá acceder a la app web desde xampp y comenzaremos a ver datos con los que podremos interactuar.

Actividades que logré resolver
1. Creación de base de datos:
    BASICO
    1. REALIZADO.
    2. REALIZADO.
    INTERMEDIO
    1. REALIZADO.
    2. REALIZADO.
    3. REALIZADO.
    4. REALIZADO.

2. Comunicación PHP con la base de datos
    BASICO
    1. REALIZADO.
    INTERMEDIO
    1. REALIZADO.
    2. REALIZADO.

3. Carpeta public_html
    BASICO
    1. REALIZADO.
    2. REALIZADO.
    3. REALIZADO.
    4. REALIZADO.
    5. REALIZADO.
    INTERMEDIO
    1. NO REALIZADO.
    AVANZADO
    1. REALIZADO



PLUSSSSS:

- Añadí la funcionalidad para agregar comentarios en los productos.
- Al añadir un comentario se muestra una alerta describiendo si fue agregado correctamente o bien, si en su defecto hubo algún error.
