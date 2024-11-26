<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi車n
if ($conexion->connect_error) {
  die("La conexi車n ha fallado: " . $conexion->connect_error);
}
$id = $_POST['id'];

// Recibir datos del formulario
$sql = "DELETE FROM produccion WHERE id = '$id'"; 


// Ejecutar consulta y comprobar si se ha insertado correctamente
if (mysqli_query($conexion, $sql)) {
    $resultado = 'exito';
} else {
    echo 'Error: ' . $sql . "<br>" . mysqli_error($conexion);

}


// Cerrar conexi贸n
mysqli_close($conexion);

// Redirigir a la p谩gina animal.php
header("Location: index.php?resultado=$resultado");
exit;
?>

