<?php
// Conexi¨®n a la base de datos
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

if ($conexion->connect_error) {
    die("La conexi¨®n ha fallado: " . $conexion->connect_error);
}

// Si el formulario ha sido enviado
if (isset($_GET['tipo_animal'])) {
    // Obtener el tipo de animal seleccionado
    $tipo_animal = $conexion->real_escape_string($_GET['tipo_animal']);

    // Consulta para obtener los datos seg¨²n el tipo de animal
    $sql_reporte = "
    SELECT 
        g.ID_animal,
        g.numero_crotal,
        g.diio,
        g.nombre,
        g.peso,
        g.fecha_nacimiento,
        g.tipo_animal,
        g.categoria,
        g.ID_madre,
        g.ID_padre,
        cr.ID_cria,
        cr.nombre AS nombre_cria,
        cr.sexo AS sexo_cria,
        cr.peso AS peso_cria,
        cr.fecha_nacimiento AS fecha_nacimiento_cria,
        fc.fecha AS fecha_ficha,
        fc.diagnostico,
        fc.tratamiento,
        fc.resultado,
        mp.fecha AS fecha_monta,
        mp.raza_verraco,
        pp.fecha AS fecha_parto,
        pp.lechones_vivos,
        pp.lechones_muertos,
        pp.peso_promedio
    FROM 
        ganado g
    LEFT JOIN 
        cria cr ON g.ID_animal = cr.ID_madre OR g.ID_animal = cr.ID_padre
    LEFT JOIN 
        ficha_clinica fc ON g.ID_animal = fc.id_animal
    LEFT JOIN 
        monta_porcino mp ON g.ID_animal = mp.id_cerdo
    LEFT JOIN 
        parto_porcino pp ON g.ID_animal = pp.id_cerdo
    WHERE 
        g.tipo_animal = '$tipo_animal'";

    $resultado_reporte = $conexion->query($sql_reporte);

    if ($resultado_reporte === false) {
        die("Error en la consulta: " . $conexion->error);
    }

    // Preparar el archivo para descarga
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="reporte_' . $tipo_animal . '.csv"');

    $salida = fopen('php://output', 'w');

    // Escribir los encabezados del archivo CSV
    $encabezados = array(
        'ID Animal', 'N¨²mero Crotal', 'DIIO', 'Nombre', 'Peso', 'Fecha Nacimiento', 'Tipo Animal', 
        'Categor¨ªa', 'ID Madre', 'ID Padre', 'ID Cr¨ªa', 'Nombre Cr¨ªa', 'Sexo Cr¨ªa', 'Peso Cr¨ªa', 
        'Fecha Nacimiento Cr¨ªa', 'Fecha Ficha', 'Diagn¨®stico', 'Tratamiento', 'Resultado', 
        'Fecha Monta', 'Raza Verraco', 'Fecha Parto', 'Lechones Vivos', 'Lechones Muertos', 'Peso Promedio'
    );
    fputcsv($salida, $encabezados);

    // Escribir los datos obtenidos
    while ($row = $resultado_reporte->fetch_assoc()) {
        // Construir el array de datos para cada fila
        $datos_fila = array(
            $row['ID_animal'],
            $row['numero_crotal'],
            $row['diio'],
            $row['nombre'],
            $row['peso'],
            $row['fecha_nacimiento'],
            $row['tipo_animal'],
            $row['categoria'],
            $row['ID_madre'],
            $row['ID_padre'],
            $row['ID_cria'] ?? '',  // Usamos el operador null coalescing para evitar valores nulos
            $row['nombre_cria'] ?? '',
            $row['sexo_cria'] ?? '',
            $row['peso_cria'] ?? '',
            $row['fecha_nacimiento_cria'] ?? '',
            $row['fecha_ficha'] ?? '',
            $row['diagnostico'] ?? '',
            $row['tratamiento'] ?? '',
            $row['resultado'] ?? '',
            $row['fecha_monta'] ?? '',
            $row['raza_verraco'] ?? '',
            $row['fecha_parto'] ?? '',
            $row['lechones_vivos'] ?? '',
            $row['lechones_muertos'] ?? '',
            $row['peso_promedio'] ?? ''
        );

        // Escribir los datos en el archivo CSV
        fputcsv($salida, $datos_fila);
    }

    fclose($salida);
    exit;
}

// Consulta para obtener los tipos de animales distintos
$sql_tipos = "SELECT DISTINCT tipo_animal FROM ganado";
$query_tipos = $conexion->query($sql_tipos);
if (!$query_tipos) {
    die("Error en la consulta de tipos de animales: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reporte por Tipo de Animal</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Generar Reporte por Tipo de Animal</h2>
    <form action="generar_reporte.php" method="GET">
        <div class="mb-3">
            <label for="tipo_animal" class="form-label">Selecciona el tipo de animal:</label>
            <select name="tipo_animal" id="tipo_animal" class="form-select" required>
                <option value="" disabled selected>Elige un tipo de animal</option>
                <?php while($row = $query_tipos->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['tipo_animal'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['tipo_animal'], ENT_QUOTES, 'UTF-8'); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Descargar Reporte</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
