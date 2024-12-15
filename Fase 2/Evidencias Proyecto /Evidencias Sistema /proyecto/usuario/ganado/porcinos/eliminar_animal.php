<?php
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexi車n
if ($conexion->connect_error) {
  die("La conexi車n ha fallado: " . $conexion->connect_error);
}

// Recibir datos del formulario
$id = $_POST['ID_animal'];

// Iniciar transacci車n
$conexion->begin_transaction();

try {
    // Eliminar registros de monta
    $stmt = $conexion->prepare("DELETE FROM monta_porcino WHERE id_cerdo = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Eliminar registros de parto
    $stmt = $conexion->prepare("DELETE FROM parto_porcino WHERE id_cerdo = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();


    // Eliminar registros de destete
        $stmt = $conexion->prepare("DELETE FROM destete WHERE id_madre = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        
        // Eliminar registros de vacunas
        $stmt = $conexion->prepare("DELETE FROM registro_vacuna WHERE id_animal = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        
        // Eliminar registros medicos
        $stmt = $conexion->prepare("DELETE FROM ficha_clinica WHERE id_animal = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    // Continuar con otras tablas hijas seg迆n sea necesario...

    // Eliminar registros de la tabla 
    $stmt = $conexion->prepare("DELETE FROM ganado WHERE ID_animal = ?");
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

