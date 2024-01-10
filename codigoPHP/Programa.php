<?php
/**
 * @author Ismael Ferreras García
 * @version 1.0
 * @since 1/12/2023
 */
// Recuperar la sesión
session_start();
//Si se intenta acceder a la pagina sin iniciar sesion redirige a la pagina de inicio de la aplicación
if (empty($_SESSION['usuarioDAW208LoginLogOffTema5'])) {
    // Redirige a la página de inicio de sesión
    header("Location:../indexProyectoLoginLogoffTema5.php");
    exit();
}
// Cerrar sesión al hacer clic en el botón
if (isset($_POST['cerrar_sesion'])) {
    session_unset(); // Desvincula todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location:Login.php"); // Redirige a la página de inicio de sesión
    exit();
}

// Ir a detalle al pulsar el boton
if (isset($_POST['detalle'])) {
    header('Location:Detalle.php'); // Redirige a la página
    exit();
}
// Define los mensajes según el idioma
if ($_COOKIE['idioma'] == 'es') {
    $bienvenida = "Bienvenido, {$_SESSION['usuarioDAW208LoginLogOffTema5']}.<br>";
    $numConexiones = "Esta es tu {$_SESSION['numConexiones']} vez conectándote.<br>";
    if ($_SESSION['numConexiones'] == 1) {
        $ultimaConexion = "Esta es la primera vez que te conectas";
    } else {
        $ultimaConexion = "Te conectaste por última vez {$_SESSION['ultimaConexion']}.";
    }
} elseif ($_COOKIE['idioma'] == 'en') {
    $bienvenida = "Welcome, {$_SESSION['usuarioDAW208LoginLogOffTema5']}.<br>";
    $numConexiones = "This is your {$_SESSION['numConexiones']} time logging in.<br>";
    if ($_SESSION['numConexiones'] == 1) {
        $ultimaConexion = "This is the first time you connect";
    } else {
        $ultimaConexion = "You last logged in on {$_SESSION['ultimaConexion']}.";
    }
}
// Mostrar el mensaje
echo $bienvenida;
echo $numConexiones;
echo $ultimaConexion;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Programa</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/208DWESProyectoTema3/webroot/css/style.css">
        <style>
            .detalle,.cerrar_sesion {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 20px;
                margin-right: 20px;

            }
        </style>
    </head>
    <body style = "margin-top:70px; margin-bottom: 100px">
        <nav class = "navbar navbar-expand-lg bg-primary fixed-top">
            <div class = "container">
                <a class = "navbar-brand text-white" href = "/index.html">Programa</a>
                <button class = "navbar-toggler" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navbarNav"
                        aria-controls = "navbarNav" aria-expanded = "false" aria-label = "Toggle navigation">
                    <span class = "navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <?php
        // Formulario de cierre de sesión
        echo '<form method="post" action="">';
        echo '<input class="cerrar_sesion" type="submit" name="cerrar_sesion" value="Cerrar Sesión">';
        echo '<input class="detalle" type="submit" name="detalle" value="Detalle">';
        echo '</form>';
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
                        <a href="../indexProyectoLoginLogoffTema5.html">
                            <img src="/webroot/imagenes/casa-removebg-preview.png" alt="Home" width="35" height="35">
                        </a>
                        <a href="https://github.com/IsmaelFG/208DWESProyectoLoginLogoffTema5" target="_blank">
                            <img src="/webroot/imagenes/github-removebg-preview.png" alt="GitHub" width="35" height="35">
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>