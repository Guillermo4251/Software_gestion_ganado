<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi��n
if (!$conexion) {
  die("La conexi��n ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$fecha = $_POST['fecha'];
$tipo = $_POST['tipo'];
$produccion = $_POST['produccion'];
$recolector = $_POST['recolector'];
$observacion = $_POST['observacion'];



// Preparar consulta SQL para inserción
$sql = "INSERT INTO produccion (fecha, tipo, produccion, recolector, observacion)
VALUES ('$fecha', '$tipo', '$produccion', '$recolector','$observacion')";

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