<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi��n
if (!$conexion) {
  die("La conexi��n ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$ID_animal = $_POST['id_animal'];
$fecha = $_POST['fecha'];
$cantidad = $_POST['cantidad'];

// Preparar consulta SQL para inserción
$sql = "INSERT INTO mortalidad_lote (lote, fecha, cantidad)
VALUES ('$ID_animal', '$fecha', '$cantidad')";

// Ejecutar consulta y comprobar si se ha insertado correctamente
if (mysqli_query($conexion, $sql)) {
    $resultado = 'exito';
} else {
    echo 'Error: ' . $sql . "<br>" . mysqli_error($conexion);

}


// Cerrar conexión
mysqli_close($conexion);

// Redirigir a la página cria.php
echo '<form id="redirectForm" action="index.php" method="post">';
echo '<input type="hidden" name="id_lote" value="' . htmlspecialchars($ID_animal) . '">';
echo '<script type="text/javascript">';
echo 'document.getElementById("redirectForm").submit();';
echo '</script>';
echo '</form>';
exit();

?>