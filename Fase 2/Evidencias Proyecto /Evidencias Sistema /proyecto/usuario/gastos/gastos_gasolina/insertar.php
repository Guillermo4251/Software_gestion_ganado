<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi��n
if (!$conexion) {
  die("La conexi��n ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$fecha = $_POST['fecha'];
$vehiculo = $_POST['vehiculo'];
$despachador = $_POST['despachador'];
$litros = $_POST['litros'];



// Preparar consulta SQL para inserción
$sql = "INSERT INTO gastos_gasolina (fecha, vehiculo, despachador, litros)
VALUES ('$fecha', '$vehiculo', '$despachador', '$litros')";

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