<?php

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");



// Comprobar conexi��n

if (!$conexion) {

  die("La conexi��n ha fallado: " . mysqli_connect_error());

}



// Recibir datos del formulario

$id = $_POST['ID_animal'];

$nombre = $_POST['nombre'];

$peso = $_POST['peso'];

$fecha_nacimiento = $_POST['fecha_nacimiento'];

$animal = $_POST['animal'];

$id_padre = $_POST['id_padre'];

$id_madre = $_POST['id_madre'];

$crotal = $_POST['crotal'];

$genero = $_POST['genero'];

$celo = $_POST['celo'];

$parto = $_POST['parto'];



// Preparar consulta SQL para inserción

$sql = "UPDATE Animales SET nombre = '$nombre', peso = '$peso', fecha_nacimiento = '$fecha_nacimiento', tipo_animal = '$animal', ID_padre = '$id_padre', 

        ID_madre = '$id_madre', numero_crotal = '$crotal', genero = '$genero', primer_celo = '$celo', ultimo_parto = '$parto' WHERE ID_animal = '$id'";



// Ejecutar consulta y comprobar si se ha insertado correctamente

if (mysqli_query($conexion, $sql)) {

    header('Location: animal.php');

    exit;

} else {

    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);

}



// Cerrar conexión

mysqli_close($conexion);

?>

