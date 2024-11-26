<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Partos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Dashboard de Partos</h2>
    
    <!-- Formulario de Filtro -->
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="tipo_animal" class="form-label">Tipo de Animal</label>
                    <select class="form-select" id="tipo_animal" name="tipo_animal" required>
                        <option value="">Selecciona un tipo de animal</option>
                        <option value="bovino">Bovino</option>
                        <option value="porcino">Porcino</option>
                        <option value="ovino">Ovino</option>
                        <option value="pollo">Pollo</option>
                        <!-- Agrega más opciones según necesites -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="card">
        <div class="card-body">
            <canvas id="partosChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    $pdo = new PDO("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

    // Recibir y filtrar los datos
    $tipo_animal = $_POST['tipo_animal'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Consultar la cantidad de partos por tipo de animal y mes
    $stmt = $pdo->prepare("SELECT MONTH(fecha_parto) AS mes, COUNT(*) AS cantidad_partos 
                           FROM partos 
                           WHERE tipo_animal = :tipo_animal 
                           AND fecha_parto BETWEEN :fecha_inicio AND :fecha_fin 
                           GROUP BY MONTH(fecha_parto)");
    $stmt->bindParam(':tipo_animal', $tipo_animal);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar datos para el gráfico
    $meses = [];
    $cantidad_partos = [];
    foreach ($resultados as $fila) {
        $meses[] = $fila['mes'];
        $cantidad_partos[] = $fila['cantidad_partos'];
    }
}
?>

<script>
<?php if (!empty($meses) && !empty($cantidad_partos)): ?>
    const ctx = document.getElementById('partosChart').getContext('2d');
    const partosChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($meses); ?>,
            datasets: [{
                label: 'Cantidad de Partos',
                data: <?php echo json_encode($cantidad_partos); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
<?php endif; ?>
</script>

</body>
</html>
