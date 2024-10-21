<?php
// Conexión a la base de datos usando MySQLi
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexión
if ($conexion->connect_error) {
    die("La conexión ha fallado: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$crotal = $_POST['num_crotal'];
$DIIO = $_POST['DIIO'];
$peso = $_POST['peso'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$tipo_animal = $_POST['tipo_animal'];
$categoria = $_POST['categoria'];
$id_padre = $_POST['id_padre'];
$id_madre = $_POST['id_madre'];

// Verificar si se subió una imagen
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    // Definir los tipos de archivos permitidos y el tamaño máximo
    $permitidos = array("image/jpg", "image/jpeg", "image/png");
    $limite_kb = 16384; // 16 MB

    // Verificar tipo y tamaño del archivo
    if (in_array($_FILES['foto']['type'], $permitidos) && $_FILES['foto']['size'] <= $limite_kb * 1024) {
        // Leer el archivo temporal en binario
        $imagen_temporal = $_FILES['foto']['tmp_name'];
        $foto_tipo = $_FILES['foto']['type'];

        // Leer el contenido del archivo temporal
        $foto = file_get_contents($imagen_temporal); // Leer el archivo como binario

        // Preparar consulta SQL para inserción, usando consultas preparadas
        $sql = "INSERT INTO ganado (nombre, numero_crotal, DIIO, peso, fecha_nacimiento, tipo_animal, categoria, ID_padre, ID_madre, foto, tipo_foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexion->prepare($sql);

        // Comprobar si la consulta se preparó correctamente
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conexion->error);
        }

        // Enlazar parámetros
        $stmt->bind_param('sssdssssiss', $nombre, $crotal, $DIIO, $peso, $fecha_nacimiento, $tipo_animal, $categoria, $id_padre, $id_madre, $foto, $foto_tipo);

        // Ejecutar consulta y comprobar si se ha insertado correctamente
        if ($stmt->execute()) {
            $resultado = 'exito';
        } else {
            die('Error: ' . $stmt->error);
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        die('Archivo no permitido o excede el tamaño de 16 MB.');
    }
} else {
    die('Error al subir la imagen.');
}

// Cerrar la conexión
$conexion->close();

// Redirigir a la página de éxito
header("Location: index.php?resultado=$resultado");
exit;
?>
