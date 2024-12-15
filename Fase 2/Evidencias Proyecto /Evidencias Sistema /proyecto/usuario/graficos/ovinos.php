<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Partos
// ----------------------------------------------------------------------------------------------------------------------------
// ------------------------------- Variables  -------------------------------
$anios_disponibles = [];
$meses_nombre = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$datosTabla = [];
$tipo_animal = "Ovino";

// ------------------------------- Años  -------------------------------
$anios_result = $conexion->query("SELECT DISTINCT YEAR(fecha) as anio FROM inseminacion_ovina ORDER BY anio DESC");
if ($anios_result) {
    while ($fila = $anios_result->fetch_assoc()) {
        $anios_disponibles[] = $fila['anio'];
    }
}

// ----------------- Filtrar mes y año  ----------------------
$anio_actual = date("Y");
$anio_seleccionado = isset($_POST['anio']) ? $conexion->real_escape_string($_POST['anio']) : $anio_actual;
$mes_seleccionado = isset($_POST['mes']) ? $conexion->real_escape_string($_POST['mes']) : date("n");

if (!empty($anio_seleccionado) && !empty($mes_seleccionado)) {
    $tabla_parto = 'inseminacion_ovina';
    $alias_tabla = 'io';
    $campos = "io.id_inseminacion, g.nombre AS nombre_animal, io.fecha, io.padre, io.est_parto, io.observaciones";
    $join_condicion = "g.ID_animal = io.id_animal";
    $tipo_animal = "Ovino";
    
    // ----------------- Consultar datos para la tabla ----------------- 
    $consultaTabla = "
        SELECT $campos, 
               DATE_FORMAT($alias_tabla.fecha, '%e de %M de %Y') AS fecha_formateada, 
               DATE_FORMAT($alias_tabla.est_parto, '%e de %M de %Y') AS prox_parto, 
               MONTH($alias_tabla.fecha) AS mes, 
               YEAR($alias_tabla.fecha) AS anio
        FROM $tabla_parto AS $alias_tabla
        INNER JOIN ganado g ON $join_condicion
        WHERE MONTH($alias_tabla.fecha) = '$mes_seleccionado' 
          AND YEAR($alias_tabla.fecha) = '$anio_seleccionado'
        ORDER BY $alias_tabla.fecha ASC";

    $resultadoTabla = $conexion->query($consultaTabla);

    if ($resultadoTabla && $resultadoTabla->num_rows > 0) {
        while ($fila = $resultadoTabla->fetch_assoc()) {
            $fila['fecha_formateada'] = ucfirst($fila['fecha_formateada']);
            $datosTabla[] = $fila;
        }
    } else {
        $datosTabla = [];
    }
}
// ----------------------------------------------------------------------------------------------------------------------------
// FIN Partos
?>



<!DOCTYPE html>
<html lang="es">
<link rel="icon" type="image/x-icon"
    href="https://cdn.discordapp.com/attachments/1095898961082056824/1108164201400238130/Icono_2.png">
<!-- Fuente -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

<head>
    <link rel="icon" type="image/jpeg" href="https://www.nukatech.cl/citt/images/logo2.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales</title>
    <!-- iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css">


</head>

<body>

    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <img class="img-circle img-md" src="https://nukatech.cl/citt/images/logo.png" alt="Profile Picture"
                    style="width: 200px; height: 100px;">
            </div>
        </div>

        <nav class="nav">
            <ul class="list_combined">
                <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'Administrador') { ?>

                <?php
                $sidebar_content = file_get_contents('https://nukatech.cl/citt/usuario/SlidebarAdmin.php');
                echo $sidebar_content;
                ?>

                <?php } else { ?>

                <?php
                $sidebar_content = file_get_contents('https://nukatech.cl/citt/usuario/slidebar.php');
                echo $sidebar_content;
                ?>

                <?php } ?>
            </ul>
        </nav>

        <div>
            <div class="linea"></div>
            <div class="usuario">
                <img src="https://nukatech.cl/citt/usuario/iconos/usuario_.png" alt="">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'Profesor') { ?>
                        <span id="nombre-usuario" class="nombre">
                            <?php echo $_SESSION['nombre_usuario']; ?>
                        </span>
                        <span class="email">
                            <?php echo $_SESSION['usuario']; ?>
                        </span>
                        <?php } elseif (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'Administrador') { ?>
                        <span id="nombre-usuario" class="nombre">
                            <?php echo $_SESSION['tipo_usuario']; ?>
                        </span>
                        <span class="email">
                            <?php echo $_SESSION['usuario']; ?>
                        </span>
                        <?php } else { ?>
                        <span class="nombre">Alumno</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-content">
        <main>
    <!-- Botón para regresar al index -->
    <a href="https://nukatech.cl/citt/usuario/graficos/index.php" class="btn arrow-button">
        <i class="fas fa-arrow-left"></i>
    </a>
            <section class="recent">
                <div class="activity-grid">
                    <h2 class="text-center mb-5">Datos</h2>
                    
                    <!-- INICIO partos ----------------------------------------------------------------------->
                    <div class="collapse-trigger border border-dark rounded-3 p-2 bg-white text-dark"
                        data-bs-toggle="collapse" data-bs-target="#collapsePartos" aria-expanded="false"
                        aria-controls="collapsePartos">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Próximos partos</span>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="collapse mt-2" id="collapsePartos">
                        <div class="card card-body">
                            <div class="hoz-grid">
                                <form method="POST" class="my-4">
                                    <div class="row">
                                        <div class="col-md-6 grid_box1">
                                            <label for="mes" class="form-label">Mes:</label>
                                            <select id="mes" name="mes" class="form-control" required>
                                                <?php foreach ($meses_nombre as $index => $mes): ?>
                                                <option value="<?php echo $index + 1; ?>" <?php echo ($index + 1) == $mes_seleccionado ? 'selected' : ''; ?>>
                                                    <?php echo $mes; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 grid_box1">
                                            <label for="anio" class="form-label">Año:</label>
                                            <select id="anio" name="anio" class="form-control" required>
                                                <?php foreach ($anios_disponibles as $anio): ?>
                                                <option value="<?php echo $anio; ?>" <?php echo $anio == $anio_seleccionado ? 'selected' : ''; ?>>
                                                    <?php echo $anio; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 col-6 mx-auto btn-guardar">
                                        <button class="btn btn-primary" type="submit">Generar</button>
                                    </div>
                                </form>
                    
                                <h2 class="text-center mb-5">Datos de partos "<?php echo ucfirst($tipo_animal); ?>"</h2>
                    
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Fecha inseminacion</th>
                                                <th>Nombre padre</th>
                                                <th>Padre</th>
                                                <th>Observaciones</th>
                                                <th>Proximo parto</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaPartos">
                                            <?php foreach ($datosTabla as $fila): ?>
                                            <tr>
                                                <td><?php echo $fila['fecha_formateada']; ?></td>
                                                <td><?php echo $fila['nombre_animal']; ?></td>
                                                <td><?php echo $fila['padre']; ?></td>
                                                <td><?php echo $fila['observaciones']; ?></td>
                                                <td><?php echo $fila['prox_parto']; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php if (empty($datosTabla)): ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No se encontraron datos para los criterios seleccionados.</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN partos ----------------------------------------------------------------------->
                    <!-- INICIO LookerStudio  ----------------------------------------------------------------------->
                    <div class="collapse-trigger border border-dark rounded-3 p-2 bg-white text-dark"
                        data-bs-toggle="collapse" data-bs-target="#collapseLooker" aria-expanded="false"
                        aria-controls="collapseLooker">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Dashboard</span>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="collapse mt-2" id="collapseLooker">
                        <div class="card card-body">
                            <div class="horz-grid">
                                <div class="row show-grid">
                                    <iframe width="935" height="702" src="https://lookerstudio.google.com/embed/reporting/540fcef9-bbc8-4187-8d0f-2a11d985b191/page/16BWE" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <!-- Fin LookerStudio  ----------------------------------------------------------------------->
            </section>
        </main>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    
    <!--  JS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
    <!-- Importacion para graficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Ver grafico -->
    <script>
    // Pasar los datos de PHP a una variable global de JavaScript
    window.datosGrafico = <?php echo json_encode($datosGrafico); ?>;
    </script>
</body>

</html>


    