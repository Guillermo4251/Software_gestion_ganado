<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// Comprobar conexión
if ($conexion->connect_error) {
    die("La conexión ha fallado: " . $conexion->connect_error);
}

$sql = "SELECT * FROM ganado WHERE tipo_animal = 'porcino' ORDER BY ID_animal DESC";
$query = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales</title>
    <!-- iconos -->
    <link rel="icon" type="image/x-icon"
        href="https://cdn.discordapp.com/attachments/1095898961082056824/1108164201400238130/Icono_2.png">
    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="https://nukatech.cl/citt/usuario/style.css">
</head>

<body>
    
    

    <input type="checkbox" id="sidebar-toggle">
    <?php
    $sidebar_content = file_get_contents('https://nukatech.cl/citt/usuario/slidebar.php');
    echo $sidebar_content;
    ?>

    <div class="main-content">
        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">Registrar porcino</h4>
                        </div>
                        <!-- Insertar animales -->
                        <form method="post" action="insertar_vacuno.php" enctype="multipart/form-data">
                            <div class="row show-grid">
                                <div class="col-md-12">
                                    <input type="hidden" id="tipo_animal" name="tipo_animal" value="porcino">
                                </div>
                                <div class="col-md-4">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control1" required
                                        pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
                                </div>
                                <div class="col-md-4">
                                    <label for="foto">Foto animal</label>
                                    <input type="file" id="foto" name="foto" class="form-control1" accept="image/*"
                                        required>
                                    <button id="verImagenBtn" type="button" class="btn btn-primary mt-2"
                                        style="display:none;" data-bs-toggle="modal" data-bs-target="#imageModal">Ver
                                        imagen</button>
                                </div>
                                <div class="col-md-3">
                                    <label for="crotal">Crotal</label>
                                    <input type="text" name="num_crotal" id="crotal" class="form-control1">
                                </div>
                                <div class="col-md-3">
                                    <label for="DIIO">DIIO</label>
                                    <input type="number" id="DIIO" name="DIIO" class="form-control1">
                                </div>
                                <div class="col-md-2">
                                    <label for="peso">Peso</label>
                                    <input type="number" id="peso" name="peso" class="form-control1">
                                </div>
                                <div class="col-md-2">
                                    <label for="fecha_nacimiento">Nacida</label>
                                    <input id="fecha_nacimiento" type="date" name="fecha_nacimiento"
                                        class="form-control1" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="categoria">Categoría</label>
                                    <select id="categoria" name="categoria" class="form-control1" required>
                                        <option selected disabled></option>
                                        <option value="lechon">Lechón</option>
                                        <option value="puerco">Puerco</option>
                                        <option value="verraco">Verraco</option>
                                        <option value="cerdo">Cerdo</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="id_padre">Padre</label>
                                    <input type="number" id="id_padre" name="id_padre" class="form-control1">
                                </div>
                                <div class="col-md-3">
                                    <label for="id_madre">Madre</label>
                                    <input type="number" id="id_madre" name="id_madre" class="form-control1">
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto btn-guardar">
                                <button class="btn btn-primary" type="submit">Confirmar</button>
                            </div>
                        </form>
                    </div>


                    <!-- Modal para mostrar la imagen -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Imagen Subida</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img id="imagenModalVista" src="" alt="Imagen subida" class="img-fluid">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('foto').addEventListener('change', function (event) {
                            const fileInput = event.target;
                            const file = fileInput.files[0];
                            const verImagenBtn = document.getElementById('verImagenBtn');
                            const imagenModalVista = document.getElementById('imagenModalVista');

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    imagenModalVista.src = e.target.result;  // Cargar la imagen en el modal
                                }
                                reader.readAsDataURL(file);  // Leer la imagen como URL

                                verImagenBtn.style.display = 'block';  // Mostrar el botón
                            } else {
                                verImagenBtn.style.display = 'none';  // Ocultar el botón si no hay imagen
                            }
                        });
                    </script>


                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">Animales registrados</h4>
                        </div>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Numero crotal</th>
                                                    <th>DIIO</th>
                                                    <th>Nombre</th>
                                                    <th>Peso</th>
                                                    <th>Nacimiento</th>
                                                    <th>Categoria</th>
                                                    <th>ID padre</th>
                                                    <th>ID madre</th>
                                                    <th>Detalles</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($row = mysqli_fetch_array($query)): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['ID_animal']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['numero_crotal']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['diio']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['nombre']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['peso']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['fecha_nacimiento']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['categoria']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['ID_padre']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($row['ID_madre']); ?>
                                                    </td>
                                                    <td>
                                                        <form action="detalles/index.php" method="post">
                                                            <input type="hidden" name="ID_animal"
                                                                value="<?php echo htmlspecialchars($row['ID_animal']); ?>">
                                                            <button type="submit"
                                                                class="btn btn-primary">Detalles</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirm-delete-<?php echo $row['ID_animal']; ?>">
                                                            Eliminar
                                                        </button>
                                                        <div class="modal fade"
                                                            id="confirm-delete-<?php echo $row['ID_animal']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            ¿Está seguro que desea eliminar este animal?
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Esta acción no se puede deshacer.</p>
                                                                        <form action="eliminar_animal.php"
                                                                            method="post">
                                                                            <input type="hidden" name="ID_animal"
                                                                                value="<?php echo htmlspecialchars($row['ID_animal']); ?>">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Eliminar</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancelar</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <!-- JS -->
    <script src="script.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>