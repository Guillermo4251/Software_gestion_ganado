<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi��n
if (!$conexion) {
  die("La conexi��n ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$especie = $_POST['especie'];




// Preparar consulta SQL para inserción
$sql = "INSERT INTO Mascotas(nombre, fecha, especie ) 
VALUES ('$nombre', '$fecha', '$especie')";

// Ejecutar consulta y comprobar si se ha insertado correctamente
if (mysqli_query($conexion, $sql)) {
    $resultado = 'exito';
} else {
    echo 'Error: ' . $sql . "<br>" . mysqli_error($conexion);

}


// Cerrar conexión
mysqli_close($conexion);

// Redirigir a la página animal.php
header("Location: index.php?resultado=$resultado");
exit;
?>