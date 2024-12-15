<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: https://nukatech.cl/citt/");

    exit;

}

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['ID_animal'])) {

        $id_animal = $_POST['ID_animal'];

    } else {

        echo "<script>alert('No se recibió ID de animal.');</script>";

        exit;

    }

} else {

    echo "<script>alert('La solicitud no es POST.');</script>";

    exit;

}



$sql = "SELECT * FROM ganado WHERE ID_animal = $id_animal";

$query = mysqli_query($conexion, $sql);

$query_modal = mysqli_query($conexion, $sql);

// Comprobar conexión

if (!$conexion) {

    die("La conexión ha fallado: " . mysqli_connect_error());

}



$sql3 = "SELECT * FROM inseminacion_ovina WHERE id_animal = $id_animal";

$query3 = mysqli_query($conexion, $sql3);



$sql4 = "SELECT * FROM parto_ovino WHERE madre = $id_animal";

$query4 = mysqli_query($conexion, $sql4);



$sql5 = "SELECT * FROM registro_vacuna WHERE id_animal = $id_animal";

$query5 = mysqli_query($conexion, $sql5);



$sql6 = "SELECT * FROM ficha_clinica WHERE id_animal = $id_animal";

$query6 = mysqli_query($conexion, $sql6);



// Obtener datos del animal para usar en el modal

$animal_data = mysqli_fetch_array($query_modal);

?>



<!DOCTYPE html>

<html lang="es">

<head>

    <link rel="icon" type="image/jpeg" href="https://www.nukatech.cl/citt/images/logo2.png">

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

    hiddenField.name = "ID_animal";

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

                                    $sql_imagen = "SELECT foto, tipo_foto FROM ganado WHERE ID_animal = $id_animal";

                                    $resultado_imagen = mysqli_query($conexion, $sql_imagen);



                                    if ($resultado_imagen && mysqli_num_rows($resultado_imagen) > 0) {

                                        $imagen_data = mysqli_fetch_assoc($resultado_imagen);

                                        $imagen = $imagen_data['foto'];

                                        $tipo_imagen = $imagen_data['tipo_foto'];



                                        // Mostrar la imagen con el tipo adecuado

                                        echo '<img src="data:' . $tipo_imagen . ';base64,' . base64_encode($imagen) . '" style="width: 100%;  height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 1.0);" class="img-fluid" alt="Imagen del animal">';

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

                                    <li class="list-group-item"><strong>Peso:</strong>

                                        <?php echo $animal_data['peso']; ?> kg

                                    </li>

                                    <li class="list-group-item"><strong>Fecha de Nacimiento:</strong>

                                        <?php echo $animal_data['fecha_nacimiento']; ?>

                                    </li>

                                    <li class="list-group-item"><strong>Tipo de Animal:</strong>

                                        <?php echo $animal_data['tipo_animal']; ?>

                                    </li>

                                    <li class="list-group-item"><strong>Categoría:</strong>

                                        <?php echo $animal_data['categoria']; ?>

                                    </li>

                                </ul>

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

                                                    <th>ID</th>

                                                    <th>Número crotal</th>

                                                    <th>DIIO</th>

                                                    <th>Nombre</th>

                                                    <th>Peso</th>

                                                    <th>Nacimiento</th>

                                                    <th>Categoría</th>

                                                    <th>ID padre</th>

                                                    <th>ID madre</th>

                                                    

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php while ($row = mysqli_fetch_array($query)): ?>

                                                    <?php

                                                        $animal_id = $row['numero_crotal'];

                                                    ?>

                                                    <tr>

                                                        <td><?php echo $row['ID_animal']; ?></td>

                                                        <td><?php echo $row['numero_crotal']; ?></td>

                                                        <td><?php echo $row['diio']; ?></td>

                                                        <td><?php echo $row['nombre']; ?></td>

                                                        <td><?php echo $row['peso']; ?></td>

                                                        <td><?php echo $row['fecha_nacimiento']; ?></td>

                                                        <td><?php echo $row['categoria']; ?></td>

                                                        <td><?php echo $row['ID_padre']; ?></td>

                                                        <td><?php echo $row['ID_madre']; ?></td>

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

                                            <label for="numero_crotal" class="form-label">Número Crotal</label>

                                            <input type="text" class="form-control" id="numero_crotal" name="numero_crotal" value="<?php echo htmlspecialchars($animal_data['numero_crotal']); ?>">

                                        </div>

                                        <div class="mb-3">

                                            <label for="diio" class="form-label">DIIO</label>

                                            <input type="text" class="form-control" id="diio" name="diio" value="<?php echo htmlspecialchars($animal_data['diio']); ?>">

                                        </div>

                                        <div class="mb-3">

                                            <label for="nombre" class="form-label">Nombre</label>

                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($animal_data['nombre']); ?>">

                                        </div>

                                        <div class="mb-3">

                                            <label for="peso" class="form-label">Peso</label>

                                            <input type="number" class="form-control" id="peso" name="peso" value="<?php echo htmlspecialchars($animal_data['peso']); ?>">

                                        </div>

                                        <div class="mb-3">

                                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>

                                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($animal_data['fecha_nacimiento']); ?>">

                                        </div>

                                        <div class="mb-3">

                                            <label for="categoria">Categoría</label>

                                    <select id="categoria" name="categoria" class="form-control1" required>

                                        <option selected disabled></option>

                                        <option value="cordero">cordero</option>

                                        <option value="oveja">oveja</option>

                                    </select>

                                        </div>

                                        <div class="mb-3">

                                            <label for="ID_padre" class="form-label">ID Padre</label>

                                            <input type="text" class="form-control" id="ID_padre" name="ID_padre" value="<?php echo htmlspecialchars($animal_data['ID_padre']); ?>">

                                        </div>

                                        <div class="mb-3">

                                            <label for="ID_madre" class="form-label">ID Madre</label>

                                            <input type="text" class="form-control" id="ID_madre" name="ID_madre" value="<?php echo htmlspecialchars($animal_data['ID_madre']); ?>">

                                        </div>

                                        <button type="submit" class="btn btn-primary">Actualizar</button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- Sección inseminacion -->

                    <div class="horz-grid">

                        <h4 class="grid-example-basic">Inseminacion</h4>

                        <section class="recent">

                            <div class="activity-grid">

                                <div class="activity-card">

                                    <div class="table-responsive">

                                        <table class="table table-striped">

                                            <thead>

                                                <tr>

                                                    <th>Fecha</th>

                                                    <th>Padre</th>

                                                    <th>Estimación del parto</th>

                                                    <th>Observacion</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php while ($row = mysqli_fetch_array($query3)): ?>

                                                    <tr>

                                                        <td data-label="Fecha"><?php echo $row['fecha']; ?></td>

                                                        <td data-label="Padre"><?php echo $row['padre']; ?></td>

                                                        <td data-label="Estimacion parto"><?php echo $row['est_parto']; ?></td>

                                                        <td data-label="Observaciones"><?php echo $row['observaciones']; ?></td>

                                                    </tr>

                                                <?php endwhile; ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </section>

                        <div class="grid-hor d-flex justify-content-end" style="margin-top: 5px;">

                            <form action="inseminacion/index.php" method="post">

                                <input type="hidden" name="ID_animal" value="<?php echo $id_animal; ?>">

                                <button type="submit" class="btn btn-primary">VER</button>

                            </form>

                        </div>

                    </div>



                    <!-- Sección Partos -->

                    <div class="horz-grid">

                        <h4 class="grid-example-basic">Partos</h4>

                        <section class="recent">

                            <div class="activity-grid">

                                <div class="activity-card">

                                    <div class="table-responsive">

                                        <table class="table table-striped">

                                            <thead>

                                                <tr>

                                                    <th>Fecha</th>

                                                    <th>Lechones vivos</th>

                                                    <th>Lechones muertos</th>

                                                    <th>Peso promedio</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php while ($row = mysqli_fetch_array($query4)): ?>

                                                    <tr>

                                                        <td><?php echo $row['fecha']; ?></td>

                                                        <td><?php echo $row['lechones_vivos']; ?></td>

                                                        <td><?php echo $row['lechones_muertos']; ?></td>

                                                        <td><?php echo $row['peso_promedio']; ?></td>

                                                    </tr>

                                                <?php endwhile; ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </section>

                        <div class="grid-hor d-flex justify-content-end" style="margin-top: 5px;">

                            <form action="partos/index.php" method="post">

                                <input type="hidden" name="ID_animal" value="<?php echo $id_animal; ?>">

                                <button type="submit" class="btn btn-primary">VER</button>

                            </form>

                        </div>

                    </div>



                    <!-- Sección Vacunas -->

                    <div class="horz-grid">

                        <h4 class="grid-example-basic">Vacunas</h4>

                        <section class="recent">

                            <div class="activity-grid">

                                <div class="activity-card">

                                    <div class="table-responsive">

                                        <table class="table table-striped">

                                            <thead>

                                                <tr>

                                                    <th>Fecha</th>

                                                    <th>Vacuna</th>

                                                    <th>Próxima</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php while ($row = mysqli_fetch_array($query5)): ?>

                                                    <tr>

                                                        <td><?php echo $row['fecha']; ?></td>

                                                        <td><?php echo $row['vacuna']; ?></td>

                                                        <td><?php echo $row['proxima']; ?></td>

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

                                <input type="hidden" name="ID_animal" value="<?php echo $id_animal; ?>">

                                <button type="submit" class="btn btn-primary">VER</button>

                            </form>

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

                                                <?php while ($row = mysqli_fetch_array($query6)): ?>

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

                                <input type="hidden" name="ID_animal" value="<?php echo $id_animal; ?>">

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

