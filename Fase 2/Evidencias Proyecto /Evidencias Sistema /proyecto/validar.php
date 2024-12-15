<?php

session_start();



// Conexión a la base de datos

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");



// Verificar la conexión

if ($conexion->connect_errno) {

    echo "Lo sentimos, este sitio web esta experimentando problemas.";

    echo " Error: Fallo al conectarse a MySQL";

    echo " Codigo de Error: " . $conexion->connect_errno . "\n";

    echo "Detalle del Error: " . $conexion->connect_error . "\n";

    exit;

}



// Verificar si el formulario ha sido enviado

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Verificar si se ha enviado el formulario de inicio de sesión

    if (isset($_POST['login'])) {

        // Obtener las credenciales del formulario

        $correo = $_POST['correo'];

        $contrasena_usuario = $_POST['Password'];

        

        // Consulta SQL para verificar las credenciales del usuario

        $consulta_sql = "SELECT * FROM usuario WHERE correo = '$correo' AND contrasenna = '$contrasena_usuario'";



        // Ejecutar la consulta SQL

        $resultado_consulta = $conexion->query($consulta_sql);



        // Verificar si la consulta se ejecutó correctamente

        if ($resultado_consulta) {

            // Verificar si se encontraron resultados

            if ($resultado_consulta->num_rows > 0) {

                // Inicio de sesión exitoso

                $_SESSION['usuario'] = $correo;

                 echo '<script>location.href="https://nukatech.cl/citt/usuario/ganado/bovinos"</script>';

            } else {

                // Las credenciales no son válidas

                echo '<script>alert("Nombre de usuario o contraseña incorrectos")</script>';

                echo '<script>location.href="https://nukatech.cl/citt/index.php"</script>';

            }

            // Liberar el resultado de la consulta

            $resultado_consulta->free();

        } else {

            // La consulta falló

            // Cambiar en un futuro, no es seguro.

            echo "Lo sentimos, este sitio web esta experimentando problemas.";

            echo "Error: La ejecucion de la consulta fallo debido a: \n";

            echo "Query: " . $consulta_sql . "\n";

            echo "Errno: " . $conexion->errno . "\n";

            echo "Error: " . $conexion->error . "\n";

        }

    }

}



// Cerrar la conexión a la base de datos

$conexion->close();

?>

