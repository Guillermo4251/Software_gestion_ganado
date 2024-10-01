<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi®Æn
if (!$conexion) {
  die("La conexi®Æn ha fallado: " . mysqli_connect_error());
}

// Recibir datos del formulario
$ID_madre = $_POST['id_madre'];
$fecha = $_POST['fecha'];
$padre = $_POST['padre'];
$sexo = $_POST['sexo'];
$obs = $_POST['obs'];





// Preparar consulta SQL para inserci√≥n
$sql = "INSERT INTO parto_bovino (madre, fecha, padre, sexo_cria, observaciones)
VALUES ('$ID_madre', '$fecha', '$padre', '$sexo', '$obs')";

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
echo '<input type="hidden" name="ID_animal" value="' . htmlspecialchars($ID_madre) . '">';
echo '<script type="text/javascript">';
echo 'document.getElementById("redirectForm").submit();';
echo '</script>';
echo '</form>';
exit();

?>