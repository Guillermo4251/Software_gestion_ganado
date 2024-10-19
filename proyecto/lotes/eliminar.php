<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi車n
if ($conexion->connect_error) {
  die("La conexi車n ha fallado: " . $conexion->connect_error);
}

// Recibir datos del formulario
$id = $_POST['id_lote'];

// Iniciar transacci車n
$conexion->begin_transaction();

try {
    // Eliminar registros medico
    $stmt = $conexion->prepare("DELETE FROM ficha_clinica_lotes WHERE id_lote = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Eliminar registros de mortalidad
    $stmt = $conexion->prepare("DELETE FROM mortalidad_lote WHERE lote = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
        
    // Continuar con otras tablas hijas seg迆n sea necesario...

    // Eliminar registros de la tabla 
    $stmt = $conexion->prepare("DELETE FROM lote WHERE id_lote = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Confirmar transacci車n
    $conexion->commit();
    header('Location: index.php');
    exit;

} catch (Exception $e) {
    // Revertir transacci車n en caso de error
    $conexion->rollback();
    echo "Error: " . $e->getMessage();
}

// Cerrar declaraci車n y conexi車n
$stmt->close();
$conexion->close();
?>

