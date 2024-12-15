<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_lote'])) {
        $id_lote = $_POST['id_lote'];
    } else {
        echo "<script>alert('No se recibio ID de lote.');</script>";
        exit;
    }
} else {
    echo "<script>alert('La solicitud no es POST.');</script>";
    exit;
}

$sql = "SELECT * FROM lote WHERE id_lote = $id_lote";
$query = mysqli_query($conexion, $sql);
$query_modal = mysqli_query($conexion, $sql);
// Comprobar conexión
if (!$conexion) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}


$sql2 = "SELECT * FROM ficha_clinica_lotes WHERE id_lote = $id_lote";
$query2 = mysqli_query($conexion, $sql2);

$sql3 = "SELECT * FROM mortalidad_lote WHERE lote = $id_lote";
$query3 = mysqli_query($conexion, $sql3);

// Obtener datos del animal para usar en el modal
$animal_data = mysqli_fetch_array($query_modal);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales</title>
    <link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/1095898961082056824/1108164201400238130/Icono_2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://nukatech.cl/citt/usuario/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <input type="checkbox" id="sidebar-toggle">
    <?php
    $sidebar_content = file_get_contents('https://nukatech.cl/citt/usuario/slidebar.php');
    echo $sidebar_content;
    ?>

    <div class="main-content">
        <main>
     <button type="button" class="btn arrow-button" onclick="goBackWithPost();">
    <i class="fas fa-arrow-left"></i>
</button>

<script type="text/javascript">
function goBackWithPost() {
    var form = document.createElement("form");
    form.method = "post";
    form.action = '../index.php'; // Asegúrate de que esta ruta sea correcta

    var hiddenField = document.createElement("input");
    hiddenField.type = "hidden";
    hiddenField.name = "id_lote";
    hiddenField.value = "<?php echo htmlspecialchars($id_lote); ?>";

    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
}
</script>




            <section class="recent">
                <div class="activity-grid">
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">Detalles del lote</h4>
                        </div>
                    </div>

                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">Datos del lote</h4>
                        </div>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Numero de lote</th>
                                                    <th>fecha de lote</th>
                                                    <th>numero de animales</th>
                                                    <th>especie</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($query)): ?>
                                                    <?php
                                                        $animal_id = $row['numero_crotal'];
                                                        
                                                    ?>
                                                    <tr>
                                                        <td data-label="ID"><?php echo $row['id_lote']; ?></td>
                                                <td data-label="No de lote"><?php echo $row['numero_lote']; ?></td>
                                                <td data-label="fecha"><?php echo $row['fecha']; ?></td>
                                                <td data-label="cantidad"><?php echo $row['cantidad']; ?></td>
                                                <td data-label="especie"><?php echo $row['especie']; ?></td>
                                                        
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                        <div class="button-container">
                                        <button type="button" class="btn btn-success position-relative" data-bs-toggle="modal" data-bs-target="#updateModal"  style="bottom: 0; right: 0; position: absolute; margin-top: 5px;">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Modal para actualizar datos del animal -->
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Actualizar Datos del Animal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="actualizar_animal.php" method="post">
                                        <input type="hidden" name="ID_animal" value="<?php echo $id_lote; ?>">
                                        <div class="mb-3">
                                            <label for="numero_crotal" class="form-label">Número de lote</label>
                                            <input type="number" class="form-control" name="numero_lote" value="<?php echo htmlspecialchars($animal_data['numero_lote']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="diio" class="form-label">DIIO</label>
                                            <input type="date" class="form-control" name="fecha" value="<?php echo htmlspecialchars($animal_data['fecha']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="number" class="form-control" name="cantidad" value="<?php echo htmlspecialchars($animal_data['cantidad']); ?>">
                                        </div>
                
                                        
                                        <div class="mb-3">
                                            <label for="especie">especie</label>
                                    <select name="especie" class="form-control1" required>
                                        <option selected disabled></option>
                                        <option value="gallina">gallina</option>
                                    </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Ficha Clínica -->
                    <div class="horz-grid">
                        <h4 class="grid-example-basic">Ficha Clínica</h4>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Diagnóstico</th>
                                                    <th>Tratamiento</th>
                                                    <th>Resultado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($query2)): ?>
                                                    <tr>
                                                        <td><?php echo $row['fecha']; ?></td>
                                                        <td><?php echo $row['diagnostico']; ?></td>
                                                        <td><?php echo $row['tratamiento']; ?></td>
                                                        <td><?php echo $row['resultado']; ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="grid-hor d-flex justify-content-end" style="margin-top: 5px;">
                            <form action="ficha_clinica/index.php" method="post">
                                <input type="hidden" name="id_lote" value="<?php echo $id_lote; ?>">
                                <button type="submit" class="btn btn-primary">VER</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="horz-grid">
                        <h4 class="grid-example-basic">Mortalidad</h4>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Lote</th>
                                                    <th>fecha</th>
                                                    <th>cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($query3)): ?>
                                                    <tr>
                                                        <td data-label="Lote"><?php echo $row['lote']; ?></td>
                                                    <td data-label="Fecha"><?php echo $row['fecha']; ?></td>
                                                    <td data-label="cantidad"><?php echo $row['cantidad']; ?></td>
                                                   
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="grid-hor d-flex justify-content-end" style="margin-top: 5px;">
                            <form action="mortalidad/index.php" method="post">
                                <input type="hidden" name="id_lote" value="<?php echo $id_lote; ?>">
                                <button type="submit" class="btn btn-primary">VER</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
