<?php
/**
 * @author Ismael Ferreras García
 * @version 1.0
 * @since 21/11/2023
 */
// Comprobamos si la cookie esta declarada
if (!isset($_COOKIE['idioma'])) {
    // En caso negativo la creamos y ponemos el valor por defecto
    setcookie("idioma", "es", time() + 2592000);
    header('Location: indexProyectoLoginLogoffTema5.php');
    exit();
}
//Comprobamos si pulsa el boton login
if (isset($_REQUEST['login'])) {
    // Redirige a la página de login
    header('Location: codigoPHP/Login.php');
    exit();
}
//Comprobamos si pulsa algun boton de idioma
if (isset($_REQUEST['espanol'])) {
//Cambiamos la cookie al idioma seleccionado y refrescamos la pagina
    setcookie("idioma", "es", time() + 2592000);
    header('Location: indexProyectoLoginLogoffTema5.php');
    exit();
}
if (isset($_REQUEST['ingles'])) {
//Cambiamos la cookie al idioma seleccionado y refrescamos la pagina
    setcookie("idioma", "en", time() + 2592000);
    header('Location: indexProyectoLoginLogoffTema5.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ismael Ferreras García</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/208DWESProyectoTema3/webroot/css/style.css">
        <style>
            .login {
                position: relative;
                left: 1800px;
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 20px;
                margin-right: 20px;

            }

            h1 {
                color: #0E6EF7;
                font-size: 64px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container">
                <a class="navbar-brand text-white" href="/index.html">LoginLogoffTema5</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form method="post">
                    <button type="submit" name="espanol" class="btn btn-primary">
                        <img src="webroot/imagenes/spain.jpg" alt="es" width="30" height="20">
                    </button>
                    <button type="submit" name="ingles" class="btn btn-primary">
                        <img src="webroot/imagenes/english.png" alt="en" width="30" height="20">
                    </button>
                </form>           
                <form method="post" action="">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>
        </nav>
        <div class="position-absolute top-50 start-50 translate-middle">
            <h1>LoginLogoffTema5</h1>
        </div>
        <footer class="bg-primary text-light py-4 fixed-bottom">
            <div class="container">
                <div class="row">
                    <div class="col text-center text-white">
                        <a href="/index.html">
                            <p class="text-white">&copy; 2023/24 Ismael Ferreras García. Todos los derechos reservados.</p>
                        </a>
                    </div>
                    <div class="col text-end">
                        <a href="../208DWESProyectoDWES/indexProyectoDWES.html">
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