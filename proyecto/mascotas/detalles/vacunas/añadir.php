<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi®Æn
if (!$conexion) {
  die("La conexi®Æn ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$ID_animal = $_POST['id_animal'];
$fecha = $_POST['fecha'];
$vacuna = $_POST['vacuna'];
$proxima = $_POST['proxima'];
// Preparar consulta SQL para inserci√≥n
$sql = "INSERT INTO registro_vacuna_mascota (id_animal ,fecha, vacuna, proxima)
VALUES ('$ID_animal', '$fecha', '$vacuna','$proxima')";

// Ejecutar consulta y comprobar si se ha insertado correctamente
if (mysqli_query($conexion, $sql)) {
    $resultado = 'exito';
} else {
    echo 'Error: ' . $sql . "<br>" . mysqli_error($conexion);

}


// Cerrar conexi√≥n
mysqli_close($conexion);

// Redirigir a la p√°gina cria.php
echo '<form id="redirectForm" action="index.php" method="post">';
echo '<input type="hidden" name="id_mascota" value="' . htmlspecialchars($ID_animal) . '">';
echo '<script type="text/javascript">';
echo 'document.getElementById("redirectForm").submit();';
echo '</script>';
echo '</form>';
exit();

?>