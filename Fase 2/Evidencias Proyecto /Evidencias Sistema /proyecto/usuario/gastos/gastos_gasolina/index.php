<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

$sql = "SELECT * FROM gastos_gasolina ORDER BY fecha limit 5";
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
    <title>Produccion</title>
    <!-- iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="https://nukatech.cl/citt/usuario/style.css">
</head>

<body>

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
            <section class="recent">
                <div class="activity-grid">
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">
                                Registro de gastos de gasolina
                            </h4>
                        </div>
                    <!--insertar animales-->
                        <form method="post" action="insertar.php">
                            <div class="row show-grid">
                                                                
                                <div class="col-md-3 grid_box1">
                                    <label>Fecha</label>
                                    <input type="date" name="fecha" class="form-control1"
                                        required>
                                </div>
                                
                                <div class="col-md-3 grid_box1">
                                    <label>Vehiculo</label>
                                    <input type="text" name="vehiculo"  class="form-control1"></input>
                                </div>
                                
                                <div class="col-md-3 grid_box1">
                                    <label>Despachador</label>
                                    <input type="text" name="despachador"  class="form-control1"></input>
                                </div>
                                
                                <div class="col-md-3 grid_box1">
                                    <label>Litros</label>
                                    <input type="datos" name="litros"  class="form-control1"></input>
                                </div>
                                
                                
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto btn-guardar">
                                    <button class="btn btn-primary" type="submit">Confirmar</button>
                                </div>
                        </form>
                    
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">
                                Ultimos registros
                            </h4>
                        </div>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Vehiculo</th>
                                                    <th>Despachador</th>
                                                    <th>Litros</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($row=mysqli_fetch_array($query)){
                                                ?>
                                                <tr>
                                                    <td data-label="Fecha"><?php echo $row['fecha']; ?></td>
                                                <td data-label="Vehiculo"><?php echo $row['vehiculo']; ?></td>
                                                    <td data-label="Despachador"><?php echo $row['despachador']; ?></td>
                                                    <td data-label="Litros"><?php echo $row['litros']; ?></td>

                                                    <!-- ------------------------------ -->
                                                    <!-- ELIMINAR -->
                                                    
                                                    <td>
                                                        
                                                        <?php if ($_SESSION['tipo_usuario'] === 'Profesor') { ?>
                                                        <button type="button" class="btn btn-danger btn-block btn-custom" data-bs-toggle="modal" data-bs-target="#confirm-delete-<?php echo $row['id_gasto']; ?>">
                                                                Eliminar
                                                            </button>
                                                            
                                                            <div class="modal fade"
                                                            id="confirm-delete-<?php echo $row['id_gasto']; ?>"
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
                                                                        <form action="eliminar.php"
                                                                            method="post">
                                                                            <input type="hidden" name="id_gasto"
                                                                                value="<?php echo htmlspecialchars($row['id_gasto']); ?>">
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
                                                        <?php } elseif ($_SESSION['tipo_usuario'] === 'Administrador') { ?>
                                                        <button type="button" class="btn btn-danger btn-block btn-custom" data-bs-toggle="modal" data-bs-target="#confirm-delete-<?php echo $row['id_gasto']; ?>">
                                                                Eliminar
                                                            </button>
                                                            
                                                            <div class="modal fade"
                                                            id="confirm-delete-<?php echo $row['id_gasto']; ?>"
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
                                                                            <input type="hidden" name="id_gasto"
                                                                                value="<?php echo htmlspecialchars($row['id_gasto']); ?>">
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
                                                        <?php } else { ?>
                                                        <button type="button" class="btn btn-danger btn-block btn-custom" disabled>
                                                                Eliminar
                                                            </button>
                                                        <?php } ?>
                                                        
                                                        
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
</body>

</html>