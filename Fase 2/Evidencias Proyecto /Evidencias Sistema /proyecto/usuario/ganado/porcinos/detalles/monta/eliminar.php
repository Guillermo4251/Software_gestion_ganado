<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexión
if (!$conexion) {
  die("La conexión ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$id = $_POST['id_monta'];
$id_animal = $_POST['id_animal'];
// Preparar consulta SQL para inserción
$sql = "DELETE FROM monta_porcino WHERE id_monta = '$id'"; 

// Ejecutar consulta y comprobar si se ha insertado correctamente
if (mysqli_query($conexion, $sql)) {
    echo '<form id="redirectForm" action="index.php" method="post">';
    echo '<input type="hidden" name="ID_animal" value="' . htmlspecialchars($id_animal) . '">';
    echo '<script type="text/javascript">';
    echo 'document.getElementById("redirectForm").submit();';
    echo '</script>';
    echo '</form>';
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}

// Cerrar conexión
mysqli_close($conexion);
?>

