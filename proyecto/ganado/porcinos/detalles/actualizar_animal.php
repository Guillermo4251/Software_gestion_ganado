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
    $numero_crotal = $_POST['numero_crotal'];
    $diio = $_POST['diio'];
    $nombre = $_POST['nombre'];
    $peso = $_POST['peso'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $categoria = $_POST['categoria'];
    $ID_padre = $_POST['ID_padre'];
    $ID_madre = $_POST['ID_madre'];

    $sql = "UPDATE ganado 
            SET numero_crotal = ?, diio = ?, nombre = ?, peso = ?, fecha_nacimiento = ?, categoria = ?, ID_padre = ?, ID_madre = ? 
            WHERE ID_animal = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssdsssii", $numero_crotal, $diio, $nombre, $peso, $fecha_nacimiento, $categoria, $ID_padre, $ID_madre, $id_animal);

    if ($stmt->execute()) {
        echo '<form id="redirectForm" action="index.php" method="post">';
        echo '<input type="hidden" name="ID_animal" value="' . htmlspecialchars($id_animal) . '">';
        echo '<script type="text/javascript">';
        echo 'document.getElementById("redirectForm").submit();';
        echo '</script>';
        echo '</form>';
exit();
        
        
    } else {
        echo "<script>alert('Error al actualizar los datos.'); window.location.href = 'detalle_animal.php?ID_animal=$id_animal';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No se recibi¨® ID de animal o la solicitud no es POST.'); window.location.href = 'detalle_animal.php';</script>";
}

$conexion->close();
?>
