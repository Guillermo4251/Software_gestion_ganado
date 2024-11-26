<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}

require 'vendor/autoload.php';  // Si usas Composer, esto es necesario. Ajusta la ruta si es necesario.

// Conexión a la base de datos
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");
if (isset($_GET['opcion'])) {
    if ($_GET['opcion'] === 'datos_generales') {
        // Consulta para datos generales
        $query = "
            SELECT 
                `numero_crotal`, 
                `diio`, 
                `nombre`, 
                `peso`, 
                `fecha_nacimiento`, 
                `tipo_animal`, 
                `ID_madre`, 
                `ID_padre` 
            FROM 
                `ganado` 
            WHERE 
                `tipo_animal` = 'vacuno'
        ";
    } elseif ($_GET['opcion'] === 'inseminacion') {
        // Consulta para inseminación
        $query = "
            SELECT 
                `id_inseminacion`, 
                `id_animal`, 
                `fecha`, 
                `padre`, 
                `est_parto`, 
                `observaciones` 
            FROM 
                `inseminacion_bovina`
        ";
    } elseif ($_GET['opcion'] === 'parto') {
        // Consulta para partos
        $query = "
            SELECT 
                `ID_parto`, 
                `fecha`, 
                `madre`, 
                `padre`, 
                `sexo_cria`, 
                `observaciones` 
            FROM 
                `parto_bovino`
        ";
    }  elseif ($_GET['opcion'] === 'datos_generales_porcinos') {
        // Consulta para datos generales (porcinos)
        $query = "
            SELECT 
                `ID_animal`, 
                `numero_crotal`, 
                `diio`, 
                `foto`, 
                `nombre`, 
                `peso`, 
                `fecha_nacimiento`, 
                `tipo_animal`, 
                `categoria`, 
                `ID_madre`, 
                `ID_padre`, 
                `tipo_foto` 
            FROM 
                `ganado` 
            WHERE 
                `tipo_animal` = 'porcino'
        ";
    } elseif ($_GET['opcion'] === 'inseminacion_porcina') {
        // Consulta para inseminación porcina
        $query = "
            SELECT 
                `id_monta`, 
                `id_cerdo`, 
                `fecha`, 
                `raza_verraco`, 
                `est_parto` 
            FROM 
                `monta_porcino`
        ";
    } elseif ($_GET['opcion'] === 'parto_porcino') {
        // Consulta para partos porcinos
        $query = "
            SELECT 
                `id_parto`, 
                `id_cerdo`, 
                `fecha`, 
                `lechones_vivos`, 
                `lechones_muertos`, 
                `peso_promedio` 
            FROM 
                `parto_porcino`
        ";
    } elseif ($_GET['opcion'] === 'datos_generales_ovino') {
        // Consulta para datos generales (ovino)
        $query = "
            SELECT 
                `ID_animal`, 
                `numero_crotal`, 
                `diio`, 
                `nombre`, 
                `peso`, 
                `fecha_nacimiento`, 
                `tipo_animal`, 
                `categoria`, 
                `ID_madre`, 
                `ID_padre` 
            FROM 
                `ganado` 
            WHERE 
                `tipo_animal` = 'ovino'
        ";
    } elseif ($_GET['opcion'] === 'datos_generales_ovino') {
        // Consulta para datos generales (ovino)
        $query = "
            SELECT 
                `ID_animal`, 
                `numero_crotal`, 
                `diio`, 
                `nombre`, 
                `peso`, 
                `fecha_nacimiento`, 
                `tipo_animal`, 
                `categoria`, 
                `ID_madre`, 
                `ID_padre` 
            FROM 
                `ganado` 
            WHERE 
                `tipo_animal` = 'ovino'
        ";
    } elseif ($_GET['opcion'] === 'inseminacion_ovino') {
        // Consulta para inseminación ovina
        $query = "
            SELECT 
                `id_inseminacion`, 
                `id_animal`, 
                `fecha`, 
                `padre`, 
                `est_parto`, 
                `observaciones` 
            FROM 
                `inseminacion_ovina`
        ";
    } elseif ($_GET['opcion'] === 'parto_ovino') {
        // Consulta para partos ovinos
        $query = "
            SELECT 
                `id_parto`, 
                `fecha`, 
                `madre`, 
                `padre`, 
                `sexo_cria`, 
                `observaciones` 
            FROM 
                `parto_ovino`
        ";
    } elseif ($_GET['opcion'] === 'datos_generales_equino') {
        // Consulta para datos generales (equino)
        $query = "
            SELECT 
                `id_animal`, 
                `nombre`, 
                `fecha`, 
                `tipo`, 
                `subtipo`, 
                `sexo` 
            FROM 
                `animales_trabajo` 
            WHERE 
                `tipo` = 'equino'
        ";
    } elseif ($_GET['opcion'] === 'datos_generales_lotes') {
        // Consulta para datos generales (lotes)
        $query = "
            SELECT 
                `id_lote`, 
                `numero_lote`, 
                `fecha`, 
                `cantidad`, 
                `especie` 
            FROM 
                `lote`
        ";
    } elseif ($_GET['opcion'] === 'produccion_bovina') {
    // Consulta para producción bovina
    $query = "
        SELECT 
            `id`, 
            `fecha`, 
            `tipo`, 
            `produccion`, 
            `recolector`, 
            `observacion` 
        FROM 
            `produccion` 
        WHERE 
            `tipo` = 'bovina'
    ";
} elseif ($_GET['opcion'] === 'produccion_lotes') {
    // Consulta para producción por lotes
    $query = "
        SELECT 
            fecha,
            id_animal,
            tipo,
            SUM(produccion) AS total_produccion
        FROM 
            produccion_lote
        GROUP BY 
            fecha
        ORDER BY 
            fecha ASC
    ";
} else {
    // Si el parámetro no coincide, redirige al inicio
    header("Location: https://nukatech.cl/citt/");
    exit;
}

// Ejecución de la consulta (común para todas las opciones)
$result = $conexion->query($query);

if (!$result) {
    die("Error al ejecutar la consulta: " . $conexion->error);
}

// Crear matriz de datos con encabezados específicos para cada caso
$data = [];
if ($_GET['opcion'] === 'datos_generales') {
    $data[] = ['Número Crotal', 'DIIO', 'Nombre', 'Peso', 'Fecha Nacimiento', 'Tipo Animal', 'ID Madre', 'ID Padre'];
} elseif ($_GET['opcion'] === 'inseminacion') {
    $data[] = ['ID Inseminación', 'ID Animal', 'Fecha', 'Padre', 'Estado Parto', 'Observaciones'];
} elseif ($_GET['opcion'] === 'parto') {
    $data[] = ['ID Parto', 'Fecha', 'Madre', 'Padre', 'Sexo Cría', 'Observaciones'];
} elseif ($_GET['opcion'] === 'datos_generales_porcinos') {
    $data[] = ['ID Animal', 'Número Crotal', 'DIIO', 'Foto', 'Nombre', 'Peso', 'Fecha Nacimiento', 'Tipo Animal', 'Categoría', 'ID Madre', 'ID Padre', 'Tipo Foto'];
} elseif ($_GET['opcion'] === 'inseminacion_porcina') {
    $data[] = ['ID Monta', 'ID Cerdo', 'Fecha', 'Raza Verraco', 'Estado Parto'];
} elseif ($_GET['opcion'] === 'parto_porcino') {
    $data[] = ['ID Parto', 'ID Cerdo', 'Fecha', 'Lechones Vivos', 'Lechones Muertos', 'Peso Promedio'];
} elseif ($_GET['opcion'] === 'datos_generales_ovino') {
    $data[] = ['ID Animal', 'Número Crotal', 'DIIO', 'Nombre', 'Peso', 'Fecha Nacimiento', 'Tipo Animal', 'Categoría', 'ID Madre', 'ID Padre'];
} elseif ($_GET['opcion'] === 'inseminacion_ovino') {
    $data[] = ['ID Inseminación', 'ID Animal', 'Fecha', 'Padre', 'Estado Parto', 'Observaciones'];
} elseif ($_GET['opcion'] === 'parto_ovino') {
    $data[] = ['ID Parto', 'Fecha', 'Madre', 'Padre', 'Sexo Cría', 'Observaciones'];
} elseif ($_GET['opcion'] === 'datos_generales_equino') {
    $data[] = ['ID Animal', 'Nombre', 'Fecha', 'Tipo', 'Subtipo', 'Sexo'];
} elseif ($_GET['opcion'] === 'datos_generales_lotes') {
    $data[] = ['ID Lote', 'Número Lote', 'Fecha', 'Cantidad', 'Especie'];
} elseif ($_GET['opcion'] === 'produccion_bovina') {
    $data[] = ['ID', 'Fecha', 'Tipo', 'Producción', 'Recolector', 'Observación'];
} elseif ($_GET['opcion'] === 'produccion_lotes') {
    $data[] = ['Fecha', 'ID Animal', 'Tipo', 'Total Producción'];
}

// Rellenar los datos
while ($row = $result->fetch_assoc()) {
    $data[] = array_values($row); // Extrae todos los valores en orden
}

// Cerrar la conexión a la base de datos
$conexion->close();

    // Crea un nuevo archivo Excel
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Establecer el formato de la primera fila (encabezados)
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['argb' => 'FFFFFFFF'],  // Blanco
            'size' => 12,
            'name' => 'Arial'
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['argb' => '4F81BD']  // Azul claro
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000']  // Negro
            ]
        ]
    ];

    // Aplicar estilo a los encabezados
    $sheet->getStyle('A1:Z1')->applyFromArray($headerStyle);

    // Establecer el formato de las celdas
    $dataStyle = [
        'font' => [
            'size' => 10,
            'name' => 'Arial'
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000']  // Negro
            ]
        ]
    ];

    // Rellenar los datos en el archivo Excel
    foreach ($data as $rowNum => $row) {
        $col = 'A'; // Columna inicial
        foreach ($row as $cell) {
            $sheet->setCellValue($col . ($rowNum + 1), $cell);
            $col++;
        }

        // Aplicar el estilo a las celdas de los datos
        if ($rowNum > 0) { // No aplicar estilo a los encabezados
            $sheet->getStyle('A' . ($rowNum + 1) . ':Z' . ($rowNum + 1))->applyFromArray($dataStyle);
        }
    }

    // Ajustar el tamaño de las columnas automáticamente
    foreach (range('A', 'H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Establecer el encabezado para la descarga del archivo Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="informe.xlsx"');
    header('Cache-Control: max-age=0');

    // Escribir el archivo Excel en el flujo de salida
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
} else {
    // Si no se recibe el parámetro o no coincide, redirige al inicio
    header("Location: https://nukatech.cl/citt/");
    exit;
}
?>
