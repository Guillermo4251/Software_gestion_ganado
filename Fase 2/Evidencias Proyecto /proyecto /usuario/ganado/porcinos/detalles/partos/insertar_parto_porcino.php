<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi��n
if (!$conexion) {
  die("La conexi��n ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$ID_madre = $_POST['id_madre'];
$fecha = $_POST['fecha'];
$lechones_vivos = $_POST['vivos'];
$lechones_muertos = $_POST['muertos'];
$promedio = $_POST['promedio'];




// Preparar consulta SQL para inserción
$sql = "INSERT INTO parto_porcino (id_cerdo, fecha, lechones_vivos, lechones_muertos, peso_promedio)
VALUES ('$ID_madre', '$fecha', '$lechones_vivos', '$lechones_muertos', '$promedio')";

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
echo '<input type="hidden" name="ID_animal" value="' . htmlspecialchars($ID_madre) . '">';
echo '<script type="text/javascript">';
echo 'document.getElementById("redirectForm").submit();';
echo '</script>';
echo '</form>';
exit();

?>