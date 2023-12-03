<?php  
session_start(); // Iniciar la sesión
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel = "stylesheet" href = "/208DWESProyectoTema3/webroot/css/style.css">
        <style>
            body {
                margin-top: 70px;
                margin-bottom: 100px;
                font-family: Arial, sans-serif;
            }

            .navbar {
                background-color: #007BFF;
            }

            .navbar-brand {
                color: #fff;
            }

            h1 {
                text-align: center;
            }

            form {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;
            }

            label {
                display: block;
                margin-bottom: 10px;
            }
            #f_actual{
                background-color: #bbb;
                color: black;
            }
            input[type = "text"],
            select {
                width: 200px;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            input[type = "text"],
            input[type = "password"],
            .radioq
            select {
                width: 200px;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .obligatorio{
                background-color: #f5ec78;
            }

            input[type = "radio"] {
                margin: 10px;
            }
            .radio {
                display: flex; /* Hace que los elementos radio se muestren en línea */
                align-items: center; /* Centra verticalmente los elementos radio */
            }

            .radio input[type = "radio"] {
                margin-right: 10px; /* Agrega un margen derecho entre los elementos radio */
                width: auto; /* Ancho automático para evitar que los elementos se expandan */
            }
            input{
                min-width: 20px;
            }

            input[type = "reset"],
            input[type = "submit"] {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 20px;
                margin-right: 20px;

            }
            .error{
                color: red;
            }
            input[type = "reset"]:hover,
            input[type = "submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body style = "margin-top:70px; margin-bottom: 100px">
        <nav class = "navbar navbar-expand-lg bg-primary fixed-top">
            <div class = "container">
                <a class = "navbar-brand text-white" href = "/index.html">Login</a>
                <button class = "navbar-toggler" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navbarNav"
                        aria-controls = "navbarNav" aria-expanded = "false" aria-label = "Toggle navigation">
                    <span class = "navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <?php
        include_once('../core/231018libreriaValidacion.php'); // Importar la librería de validación
        require_once '../config/confDB.php';

        $entradaOK = true; // Indica si todas las respuestas son correctas
        $_REQUEST['fecha_deshabilitada'] = date('Y-m-d - H:i:s'); // Inicializamos la fecha actual ya que es un campo deshabilitado
// Almacena las respuestas
        $aRespuestas = [
            'usuario' => '',
            'contrasena' => ''
        ];

// Almacena los errores
        $aErrores = [
            'usuario' => '',
            'contrasena' => ''
        ];

// Validar los campos
        if (isset($_REQUEST['enviar'])) {
            $aErrores = [
                'usuario' => validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 32, 4, 1),
                'contrasena' => validacionFormularios::validarPassword($_REQUEST['contrasena'], 32, 4, 2, 1)
            ];

            // Recorre aErrores para ver si hay alguno
            foreach ($aErrores as $campo => $valor) {
                if ($valor != null) {
                    $entradaOK = false;
                    // Limpiamos el campo
                    $_REQUEST[$campo] = '';
                }
            }
        } else {
            $entradaOK = false;
        }

// En caso de que '$entradaOK' sea true, cargamos las respuestas en el array '$aRespuestas' 
        if ($entradaOK) {
            $aRespuestas = [
                'usuario' => $_REQUEST['usuario'],
                'contrasena' => $_REQUEST['contrasena']
            ];

            // Conexion a la base de datos
            $miDB = new PDO(DSN, USERNAME, PASSWORD);
            $usuario = $_REQUEST['usuario'];
            $contrasena = $_REQUEST['contrasena'];
            $hashContrasena = hash('sha256', $usuario . $contrasena);

            // Preparar la consulta SQL para verificar las credenciales
            $stmt = $miDB->prepare("SELECT * FROM T01_Usuario WHERE T01_CodUsuario = :usuario AND T01_Password = :hashContrasena");

            // Ejecutamos la consulta
            $stmt->execute(['usuario' => $usuario, 'hashContrasena' => $hashContrasena]);

            // Almacenamos el resultado de la query como objeto mediante FETCH_OBJ
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if ($result) {
                // Incrementamos el número de conexiones
                $numConexiones = $result->T01_NumConexiones + 1;

                // Actualizamos la fecha y hora de la última conexión
                $fechaHoraUltimaConexion = $result->T01_FechaHoraUltimaConexion;

                // Actualizamos la base de datos con la nueva información
                $miDB->query("UPDATE T01_Usuario SET T01_NumConexiones = $numConexiones, T01_FechaHoraUltimaConexion = CURRENT_TIMESTAMP WHERE T01_CodUsuario = '$usuario'");

                // Configuramos sesiones para almacenar la información del usuario
                $_SESSION['usuario'] = $result->T01_DescUsuario;
                $_SESSION['numConexiones'] = $numConexiones;
                $_SESSION['ultimaConexion'] = $fechaHoraUltimaConexion;

                // Redirigir a programa.php
                echo '<meta http-equiv="refresh" content="0;url=Programa.php">';
                exit(); // Asegurarse de que el script se detenga después de la redirección
            } else {
                // Mostramos un mensaje de error y el formulario nuevamente
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <table>
                        <tr>
                            <td><label for="usuario">Usuario:</label></td>
                            <td><input class="obligatorio" type="text" id="usuario" name="usuario" value="<?php echo (isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : ''); ?>"></td>
                            <td class="error"><?php echo (!empty($aErrores["usuario"]) ? $aErrores["usuario"] : ''); ?></td>
                        </tr>
                        <tr>
                            <td><label for="contrasena">Contraseña:</label></td>
                            <td><input class="obligatorio" type="password" id="contrasena" name="contrasena" value="<?php echo (isset($_REQUEST['contrasena']) ? $_REQUEST['contrasena'] : ''); ?>"></td>
                            <td class="error"><?php echo (!empty($aErrores["contrasena"]) ? $aErrores["contrasena"] : ''); ?></td>
                        </tr>
                    </table>
                    <p class='error'>Usuario o contraseña incorrectos. Inténtalo de nuevo.</p>
                    <input name="enviar" type="submit" value="Iniciar Sesion">
                </form>
                <?php
            }
        } else {
            // Formulario que se le muestra al cliente para que lo rellene
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table>
                    <tr>
                        <td><label for="usuario">Usuario:</label></td>
                        <td><input class="obligatorio" type="text" id="usuario" name="usuario" value="<?php echo (isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : ''); ?>"></td>
                        <td class="error"><?php echo (!empty($aErrores["usuario"]) ? $aErrores["usuario"] : ''); ?></td>
                    </tr>
                    <tr>
                        <td><label for="contrasena">Contraseña:</label></td>
                        <td><input class="obligatorio" type="password" id="contrasena" name="contrasena" value="<?php echo (isset($_REQUEST['contrasena']) ? $_REQUEST['contrasena'] : ''); ?>"></td>
                        <td class="error"><?php echo (!empty($aErrores["contrasena"]) ? $aErrores["contrasena"] : ''); ?></td>
                    </tr>
                </table>
                <input name="enviar" type="submit" value="Iniciar Sesion">
            </form>
            <?php
        }
        ?>
        <footer class="bg-primary text-light py-4 fixed-bottom">
            <div class="container">
                <div class="row">
                    <div class="col text-center text-white">
                        <a href="/index.html">
                            <p class="text-white">&copy; 2023/24 Ismael Ferreras
                                García. Todos los derechos
                                reservados.</p>
                        </a>
                    </div>
                    <div class="col text-end">
                        <a href="../indexProyectoTema3.html">
                            <img src="/webroot/imagenes/casa-removebg-preview.png" alt="Home" width="35" height="35">
                        </a>
                        <a href="https://github.com/IsmaelFG" target="_blank">
                            <img src="/webroot/imagenes/github-removebg-preview.png" alt="GitHub" width="35" height="35">
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>

