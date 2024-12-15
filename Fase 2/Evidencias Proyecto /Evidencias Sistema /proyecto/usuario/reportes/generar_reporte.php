<?php
require 'vendor/autoload.php'; // Asegúrate de tener PhpSpreadsheet instalado y de cargar el autoload.php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Conexión a la base de datos
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

if ($conexion->connect_error) {
    die("La conexión ha fallado: " . $conexion->connect_error);
}

// Si el formulario ha sido enviado
if (isset($_GET['tipo_animal'])) {
    // Obtener el tipo de animal seleccionado
    $tipo_animal = $conexion->real_escape_string($_GET['tipo_animal']);

    // Consulta para obtener los datos según el tipo de animal
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

    // Crear un nuevo archivo de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Títulos de las columnas
    $titulos = [
        'ID Animal', 'Número Crotal', 'DIIO', 'Nombre', 'Peso', 'Fecha Nacimiento',
        'Tipo Animal', 'Categoría', 'ID Madre', 'ID Padre', 'ID Cría', 
        'Nombre Cría', 'Sexo Cría', 'Peso Cría', 'Fecha Nacimiento Cría', 
        'Fecha Ficha', 'Diagnóstico', 'Tratamiento', 'Resultado', 'Fecha Monta', 
        'Raza Verraco', 'Fecha Parto', 'Lechones Vivos', 'Lechones Muertos', 'Peso Promedio'
    ];

    // Escribir los títulos en la primera fila
    $sheet->fromArray($titulos, null, 'A1');

    // Procesar cada fila de resultados y agregarla al archivo de Excel
    $fila = 2;
    while ($row = $resultado_reporte->fetch_assoc()) {
        $datos_fila = [
            $row['ID_animal'], $row['numero_crotal'], $row['diio'], $row['nombre'], $row['peso'],
            $row['fecha_nacimiento'], $row['tipo_animal'], $row['categoria'], $row['ID_madre'], $row['ID_padre'],
            $row['ID_cria'] ?? '', $row['nombre_cria'] ?? '', $row['sexo_cria'] ?? '', $row['peso_cria'] ?? '',
            $row['fecha_nacimiento_cria'] ?? '', $row['fecha_ficha'] ?? '', $row['diagnostico'] ?? '', 
            $row['tratamiento'] ?? '', $row['resultado'] ?? '', $row['fecha_monta'] ?? '', 
            $row['raza_verraco'] ?? '', $row['fecha_parto'] ?? '', $row['lechones_vivos'] ?? '', 
            $row['lechones_muertos'] ?? '', $row['peso_promedio'] ?? ''
        ];
        $sheet->fromArray($datos_fila, null, "A$fila");
        $fila++;
    }

    // Guardar el contenido en memoria
    $writer = new Xlsx($spreadsheet);
    ob_start();
    $writer->save('php://output');
    $contenido_excel = ob_get_clean();

    // Si se seleccionó enviar por correo
    if (isset($_GET['enviar_correo'])) {
        // Preparar el correo
        $para = 'maldonadoguillermo1299@gmail.com';
        $asunto = 'Informe de Ganado: ' . $tipo_animal;
        $mensaje = 'Adjunto encontrarás el informe solicitado.';
        $cabeceras = 'From: tuemail@tudominio.com' . "\r\n" .
                     'Reply-To: tuemail@tudominio.com' . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();

        // Adjuntar el archivo Excel
        $boundary = md5(uniqid(time()));
        $cabeceras .= "\r\nMIME-Version: 1.0\r\n" .
                      "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";

        $mensaje .= "\r\n\r\n--{$boundary}\r\n" .
                    "Content-Type: text/plain; charset=\"UTF-8\"\r\n" .
                    "Content-Transfer-Encoding: 7bit\r\n\r\n" .
                    "Adjunto encontrarás el informe solicitado.\r\n\r\n";

        $mensaje .= "--{$boundary}\r\n" .
                    "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; name=\"reporte_{$tipo_animal}.xlsx\"\r\n" .
                    "Content-Disposition: attachment; filename=\"reporte_{$tipo_animal}.xlsx\"\r\n" .
                    "Content-Transfer-Encoding: base64\r\n\r\n" .
                    chunk_split(base64_encode($contenido_excel)) . "\r\n\r\n" .
                    "--{$boundary}--";

        // Enviar el correo
        if (mail($para, $asunto, $mensaje, $cabeceras)) {
            echo "El informe ha sido enviado a $para.";
        } else {
            echo "Hubo un error al enviar el correo.";
        }
    } else {
        // Descargar el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="reporte_' . $tipo_animal . '.xlsx"');
        echo $contenido_excel;
        exit;
    }
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
        <div class="mb-3">
            <button type="submit" name="descargar" class="btn btn-success">Descargar Reporte</button>
            <button type="submit" name="enviar_correo" class="btn btn-primary">Enviar por Correo</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
