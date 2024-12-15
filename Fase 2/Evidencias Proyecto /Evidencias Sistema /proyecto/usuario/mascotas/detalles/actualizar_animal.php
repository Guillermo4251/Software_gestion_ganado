<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

if ($conexion->connect_error) {
    die("La conexi¨®n ha fallado: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID_animal'])) {
    $id_animal = $_POST['ID_animal'];
    
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $subtipo = $_POST['subtipo'];
    $sexo = $_POST['sexo'];
    

    $sql = "UPDATE animales_trabajo 
            SET  nombre = ?, fecha = ?, subtipo = ?, sexo = ? 
            WHERE ID_animal = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssss",  $nombre,  $fecha, $subtipo, $sexo, $id_animal);

    if ($stmt->execute()) {
        echo '<form id="redirectForm" action="index.php" method="post">';
        echo '<input type="hidden" name="id_animal" value="' . htmlspecialchars($id_animal) . '">';
        echo '<script type="text/javascript">';
        echo 'document.getElementById("redirectForm").submit();';
        echo '</script>';
        echo '</form>';
exit();
        
        
    } else {
        echo "<script>alert('Error al actualizar los datos.'); window.location.href = 'https://nukatech.cl/citt/usuario/ganado/equinos/';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No se recibi¨® ID de animal o la solicitud no es POST.'); window.location.href = 'https://nukatech.cl/citt/usuario/ganado/equinos/';</script>";
}

$conexion->close();
?>
