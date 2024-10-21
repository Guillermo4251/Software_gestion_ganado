<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Verificar si hay un error de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_animal'])) {
        $id_animal = intval($_POST['id_animal']); // Asegurarse de que sea un número entero
    } else {
        echo "<script>alert('No se recibió ID de animal.');</script>";
        exit;
    }
} else {
    echo "<script>alert('La solicitud no es POST.');</script>";
    exit;
}

// Consultar datos del animal en la tabla "animales_trabajo"
$sql = "SELECT * FROM animales_trabajo WHERE ID_animal = $id_animal"; // Usar `ID_animal` consistente
$query = mysqli_query($conexion, $sql);
$query_modal = mysqli_query($conexion, $sql);

// Verificar si la consulta tuvo éxito y si se encontraron resultados
if (!$query_modal || mysqli_num_rows($query_modal) == 0) {
    echo "<script>alert('No se encontraron datos para el animal con ID: $id_animal');</script>";
    exit;
}

// Consultar otros datos del animal
$sql2 = "SELECT * FROM ficha_clinica_animal_trabajo WHERE ID_animal = $id_animal";
$query2 = mysqli_query($conexion, $sql2);

$sql3 = "SELECT * FROM registro_vacuna_animal_trabajo WHERE ID_animal = $id_animal";
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
    <title>Mascotas</title>
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
    hiddenField.name = "id_animal";
    hiddenField.value = "<?php echo htmlspecialchars($id_animal); ?>";

    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
}
</script>




            <section class="recent">
                <div class="activity-grid">
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">Detalles del animal</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Mostrar la imagen del animal -->
                                <?php
                                if (!empty($animal_data['ID_animal'])) {
                                    // Obtener la imagen del animal directamente en este archivo
                                    $sql_imagen = "SELECT foto, tipo_foto FROM animales_trabajo WHERE ID_animal = $id_animal";
                                    $resultado_imagen = mysqli_query($conexion, $sql_imagen);
                    
                                    if ($resultado_imagen && mysqli_num_rows($resultado_imagen) > 0) {
                                        $imagen_data = mysqli_fetch_assoc($resultado_imagen);
                                        $imagen = $imagen_data['foto'];
                                        $tipo_imagen = $imagen_data['tipo_foto'];
                    
                                        // Mostrar la imagen con el tipo adecuado
                                        echo '<img src="data:' . $tipo_imagen . ';base64,' . base64_encode($imagen) . '" style="width: 100%; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 1.0);" class="img-fluid" alt="Imagen del animal">';
                                    } else {
                                        echo '<p>No hay imagen disponible.</p>';
                                    }
                                } else {
                                    echo '<p>No hay información del animal.</p>';
                                }
                                ?>
                            </div>
                            <div class="col-md-8">
                                <!-- Mostrar los detalles del animal en texto -->
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Nombre:</strong>
                                        <?php echo $animal_data['nombre']; ?>
                                    </li>
                                    <li class="list-group-item"><strong>Tipo de animal:</strong>
                                        <?php echo $animal_data['subtipo']; ?> kg
                                    </li>
                                    <li class="list-group-item"><strong>Sexo:</strong>
                                        <?php echo $animal_data['sexo']; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">Datos del animal</h4>
                        </div>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Fecha</th>
                                                    <th>Especie</th>
                                                    <th>Sexo</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($query)): ?>
                                                    <?php
                                                        
                                                        
                                                    ?>
                                                    <tr>
                                                        <td data-label="Nombre"><?php echo $row['nombre']; ?></td>
                                                <td data-label="Fecha"><?php echo $row['fecha']; ?></td>
                                                <td data-label="Especie"><?php echo $row['subtipo']; ?></td>
                                                <td data-label="Sexo"><?php echo $row['sexo']; ?></td>
                                                        
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
                                        <input type="hidden" name="ID_animal" value="<?php echo $id_animal; ?>">
                                        
                                        <div class="mb-3">
                                            <label  class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($animal_data['nombre']); ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Fecha</label>
                                            <input type="date" class="form-control" name="fecha" value="<?php echo htmlspecialchars($animal_data['fecha']); ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="especie">especie</label>
                                    
                                    <select name="subtipo" class="form-control1" required>
                                        <option selected disabled value="">Selecciona una especie</option>
                                        <option value="perro" <?php if ($animal_data['subtipo'] === 'perro') echo 'selected'; ?>>perro</option>
                                        <option value="gato" <?php if ($animal_data['subtipo'] === 'gato') echo 'selected'; ?>>gato</option>
                                    </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                    <label>sexo</label>
                                    <select name="sexo" class="form-control1" required>
                                        <option selected disabled>selecciona un sexo</option>
                                        <option value="macho" <?php if ($animal_data['sexo'] === 'macho') echo 'selected'; ?>>macho</option>
                                        <option value="hembra" <?php if ($animal_data['sexo'] === 'hembra') echo 'selected'; ?>>hembra</option>
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
                                <input type="hidden" name="id_animal" value="<?php echo $id_animal; ?>">
                                <button type="submit" class="btn btn-primary">VER</button>
                            </form>
                        </div>
                    </div>
                    
                    <!--vacuna-->
                    <div class="horz-grid">
                        <h4 class="grid-example-basic">Vacuna</h4>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID vacuna</th>
                                                    <th>Fecha</th>
                                                    <th>Vacuna</th>
                                                    <th>Proxima</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($query3)): ?>
                                                    <tr>
                                                    <td data-label="ID"><?php echo $row['id_vacuna']; ?></td>
                                                    <td data-label="Fecha"><?php echo $row['fecha']; ?></td>
                                                    <td data-label="Vacuna"><?php echo $row['vacuna']; ?></td>
                                                    <td data-label="Proxima"><?php echo $row['proxima']; ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="grid-hor d-flex justify-content-end" style="margin-top: 5px;">
                            <form action="vacunas/index.php" method="post">
                                <input type="hidden" name="id_animal" value="<?php echo $id_animal; ?>">
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
