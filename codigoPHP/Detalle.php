<?php
/**
 * @author Ismael Ferreras García
 * @version 1.0
 * @since 21/11/2023
 */
// Recuperar la sesión
session_start();
// Acceder a las variables de sesión
if (empty($_SESSION['usuarioDAW208LoginLogOffTema5'])) {
    // Redirige a la página de inicio
    header("Location:../indexProyectoLoginLogoffTema5.php"); 
    exit();
}
if (isset($_REQUEST['volver'])) {
    // Redirige a la página principal del programa
    header('Location:Programa.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalle</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/208DWESProyectoTema3/webroot/css/style.css">
        <style>
            .volver {
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
    <body style="margin-top:70px">
        <nav class="navbar navbar-expand-lg bg-primary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/index.html">Detalle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post">
            <input class="volver" type="submit" name="volver" value="Volver">
        </form>
        <?php
        /**
         * @author Ismael Ferreras García
         * @version 1.0
         * @since 21/11/2023
         */
        if (isset($_SESSION)) {
            echo '<br><br><h2>Variable <b>$_SESSION</b></h2>';
            foreach ($_SESSION as $key => $value) {
                echo "<b>$key</b>: $value<br>";
            }
        } else {
            echo '<h2>La variable <b>$_SESSION</b> no está definida</h2>';
        }

        echo '<br><br><h2>Variable <b>$_COOKIE</b></h2>';
        foreach ($_COOKIE as $key => $value) {
            echo "<b>$key</b>: $value<br>";
        }
        echo '<br><br><h2>Variable <b>$_SERVER</b></h2>';
        foreach ($_SERVER as $key => $value) {
            echo "<b>$key</b>: $value<br>";
        }

        echo '<br><br><h2>Variable <b>$_GET</b></h2>';
        foreach ($_GET as $key => $value) {
            echo "<b>$key</b>: $value<br>";
        }

        echo '<br><br><h2>Variable <b>$_POST</b></h2>';
        foreach ($_POST as $key => $value) {
            echo "$key: $value<br>";
        }

        echo '<br><br><h2>Variable <b>$_FILES</b></h2>';
        foreach ($_FILES as $key => $value) {
            echo "<b>$key</b>: $value<br>";
        }

        echo '<br><br><h2>Variable <b>$_REQUEST</b></h2>';
        foreach ($_REQUEST as $key => $value) {
            echo "<b>$key</b>: $value<br>";
        }

        echo '<br><br><h2>Variable <b>$_ENV</b></h2>';
        foreach ($_ENV as $key => $value) {
            echo "<b>$key</b>: $value<br>";
        }

        echo '<br><br><h2>Variable <b>$GLOBALS</b></h2>';
        echo '<pre>';
        print_r($GLOBALS);
        echo '</pre>';
        phpinfo();
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