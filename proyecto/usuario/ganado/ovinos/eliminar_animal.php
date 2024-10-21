<?php

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");



// Comprobar conexi܇n

if ($conexion->connect_error) {

  die("La conexi܇n ha fallado: " . $conexion->connect_error);

}



// Recibir datos del formulario

$id = $_POST['ID_animal'];



// Iniciar transacci܇n

$conexion->begin_transaction();



try {

    // Eliminar registros de monta

    $stmt = $conexion->prepare("DELETE FROM inseminacion_ovina WHERE id_animal = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    

    // Eliminar registros de parto

    $stmt = $conexion->prepare("DELETE FROM parto_ovino WHERE madre = ?");

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

    // Continuar con otras tablas hijas seg�~n sea necesario...



    // Eliminar registros de la tabla 

    $stmt = $conexion->prepare("DELETE FROM ganado WHERE ID_animal = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();



    // Confirmar transacci܇n

    $conexion->commit();

    header('Location: index.php');

    exit;



} catch (Exception $e) {

    // Revertir transacci܇n en caso de error

    $conexion->rollback();

    echo "Error: " . $e->getMessage();

}



// Cerrar declaraci܇n y conexi܇n

$stmt->close();

$conexion->close();

?>



