<?php

/**
 * @author Ismael Ferreras García
 * @version 1.0
 * @since 1/12/2023
 */
session_start(); // Iniciar la sesión
// Acceder a las variables de sesión

if (empty($_SESSION['usuarioDAW208LoginLogOffTema5']) || empty($_SESSION['numConexiones']) || empty($_SESSION['ultimaConexion'])) {
    echo '<meta http-equiv="refresh" content="0;url=Login.php">'; // Redirige a la página de inicio de sesión
    exit();
}
// Cerrar sesión al hacer clic en el botón
if (isset($_POST['cerrar_sesion'])) {
    session_unset(); // Desvincula todas las variables de sesión
    session_destroy(); // Destruye la sesión
    echo '<meta http-equiv="refresh" content="0;url=Login.php">'; // Redirige a la página de inicio de sesión
    exit();
}

// Mostrar la información
echo "Bienvenido, {$_SESSION['usuarioDAW208LoginLogOffTema5']}.<br>";
echo "Esta es tu {$_SESSION['numConexiones']} vez conectándote.<br>";
echo "Te conectaste por última vez el {$_SESSION['ultimaConexion']}.<br>";

// Formulario de cierre de sesión
echo '<form method="post" action="">';
echo '<input type="submit" name="cerrar_sesion" value="Cerrar Sesión">';
echo '</form>';

echo '<a href="Detalle.php">Detalle</a>';
?>