<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi¨®n
if (!$conexion) {
  die("La conexi¨®n ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$numero = $_POST['numero_lote'];
$fecha = $_POST['fecha'];
$cantidad = $_POST['cantidad'];
$especie = $_POST['especie'];



// Preparar consulta SQL para inserciÃ³n
$sql = "INSERT INTO lote(numero_lote, fecha, cantidad, especie ) 
VALUES ('$numero', '$fecha', '$cantidad', '$especie')";

// Ejecutar consulta y comprobar si se ha insertado correctamente
if (mysqli_query($conexion, $sql)) {
    $resultado = 'exito';
} else {
    echo 'Error: ' . $sql . "<br>" . mysqli_error($conexion);

}


// Cerrar conexiÃ³n
mysqli_close($conexion);

// Redirigir a la pÃ¡gina animal.php
header("Location: index.php?resultado=$resultado");
exit;
?>