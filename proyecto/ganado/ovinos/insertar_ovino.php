<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi¨®n
if (!$conexion) {
  die("La conexi¨®n ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$crotal = $_POST['crotal'];
$DIIO = $_POST['DIIO'];
$peso = $_POST['peso'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$tipo_animal = $_POST['tipo_animal'];
$categoria = $_POST['categoria'];
$id_padre = $_POST['id_padre'];
$id_madre = $_POST['id_madre'];


// Preparar consulta SQL para inserciÃ³n
$sql = "INSERT INTO ganado(nombre, numero_crotal, DIIO, peso, fecha_nacimiento, tipo_animal, categoria, ID_padre, ID_madre ) 
VALUES ('$nombre', '$crotal', '$DIIO', '$peso', '$fecha_nacimiento', '$tipo_animal', '$categoria', '$id_padre', '$id_madre')";

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