<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

$sql = "SELECT * FROM lote ORDER BY especie DESC";
$query = mysqli_query($conexion, $sql);
// Comprobar conexión
if (!$conexion) {
  die("La conexión ha fallado: " . mysqli_connect_error());
}
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotes</title>
    <!-- iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
                            <h4 class="grid-example-basic">
                                Registrar Lote 
                            </h4>
                        </div>
                    <!--insertar animales-->
                        <form method="post" action="insertar.php">
                            <div class="row show-grid">                                
                                
                                <div class="col-md-3">
                                    <label>Numero del lote</label>
                                    <input type="number" name="numero_lote"  class="form-control1">
                                </div>
                                
                                <div class="col-md-2 grid_box1">
                                    <label>Fecha</label>
                                    <input id="fecha" type="date" name="fecha" class="form-control1" required>
                                </div>
                                
                                <div class="col-md-3">
                                    <label>cantidad de animales</label>
                                    <input type="number" name="cantidad" class="form-control1">
                                </div>
                                
                                <div class="col-md-4 grid_box1">
                                    <label>especie</label>
                                    <select name="especie" class="form-control1" required>
                                        <option selected disabled></option>
                                        <option value="gallina">Gallina</option>
                                    </select>
                                </div>
                                
                                <div class="d-grid gap-2 col-6 mx-auto btn-guardar">
                                    <button class="btn btn-primary" type="submit">Confirmar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- ----------------------------------------------------------------------------------------- -->
                    <!-- Modal que se inserto 
                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="successModalLabel">Completado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Se ha insertado el animal correctamente.
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!-- ----------------------------------------------------------------------------------------- -->
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">
                                Animales registrados
                            </h4>
                        </div>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Numero de lote</th>
                                                    <th>fecha de lote</th>
                                                    <th>numero de animales</th>
                                                    <th>especie</th>
                                                    <th> </th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($row=mysqli_fetch_array($query)){ $animal_id = $row['numero_crotal']; 
                                                
                            
                            
                            
                            
                            ?>
                                                <tr>
                                                <td data-label="ID"><?php echo $row['id_lote']; ?></td>
                                                <td data-label="No de lote"><?php echo $row['numero_lote']; ?></td>
                                                <td data-label="fecha"><?php echo $row['fecha']; ?></td>
                                                <td data-label="cantidad"><?php echo $row['cantidad']; ?></td>
                                                <td data-label="especie"><?php echo $row['especie']; ?></td>
                                                    
                                                    <!-- ------------------------------ -->
                                                    <!-- ELIMINAR -->
                                                    <td>
                                                        <form action="detalles/index.php" method="POST">
                                                            <input type="hidden" name="id_lote" value="<?php echo $row['id_lote']; ?>">
                                                            <button type="submit" class="btn btn-primary">detalles</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#confirm-delete-<?php echo $row['id_lote']; ?>">
                                                            Eliminar
                                                        </button>
                                                        <div class="modal fade" id="confirm-delete-<?php echo $row['id_lote']; ?>" tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro que desea eliminar este animal?</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Esta acción no se puede deshacer.</p>
                                                                        <form action="eliminar.php" method="post">
                                                                            <input type="hidden" name="id_lote" value="<?php echo $row['id_lote']; ?>">
                                                                            <button type="submit" class="btn btn-danger btn-ok">Eliminar</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!-- FIN ELIMINAR -->
                                                </tr>
                                                <?php }?>
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    
    <!--  JS -->
    <script src="script.js"></script>
</body>

</html>