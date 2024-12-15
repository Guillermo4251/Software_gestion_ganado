<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: https://nukatech.cl/citt/");

    exit;

}

$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");



$sql = "SELECT * FROM ganado where tipo_animal = 'ovino' ORDER BY ID_animal DESC";$query = mysqli_query($conexion, $sql);

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

    <link rel="icon" type="image/jpeg" href="https://www.nukatech.cl/citt/images/logo2.png">

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Animales</title>

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

                                Registrar ovino

                            </h4>

                        </div>

                    <!--insertar animales-->

                        <form method="post" action="insertar_ovino.php" enctype="multipart/form-data">

                            <div class="row show-grid">

                                

                                <div class="">

                                    <input type="hidden" id="tipo_animal" name="tipo_animal" value="ovino">

                                </div>

                                

                                <div class="col-md-4 grid_box1">

                                    <label>Nombre</label>

                                    <input type="text" name="nombre" class="form-control1" 

                                        required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">

                                </div>

                                

                                <div class="col-md-4 grid_box1">

                                    <label for="foto">Foto animal</label>

                                    <input type="file" id="foto" name="foto" class="form-control1" accept="image/*"

                                        required>

                                    <button id="verImagenBtn" type="button" class="btn btn-primary mt-2"

                                        style="display:none;" data-bs-toggle="modal" data-bs-target="#imageModal">Ver

                                        imagen</button>

                                </div>

                                

                                <div class="col-md-4 grid_box1">

                                    <label>Crotal</label>

                                    <input type="text" name="crotal_id" data-name="crotal" class="form-control1">

                                </div>

                                

                                <div class="col-md-3 grid_box1">

                                    <label>DIIO</label>

                                    <input type="number" name="DIIO" id="DIIO" class="form-control1">

                                </div>

                                

                                <div class="col-md-3 grid_box1">

                                    <label>Peso</label>

                                    <input type="number" name="peso" id="peso" class="form-control1">

                                </div>                          

                                

                                <div class="col-md-3 grid_box1">

                                    <label>Nacida</label>

                                    <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" class="form-control1" required>

                                </div>

                                

                                <div class="col-md-3 grid_box1">

                                    <label>Categoria</label>

                                    <select name="categoria" class="form-control1" required>

                                        <option selected disabled></option>

                                        <option value="cordero">Cordero</option>

                                        <option value="borrego">Borrego</option>

                                        <option value="oveja">Oveja</option>

                                        <option value="carnero">Carnero</option>

                                    </select>

                                </div>



                                <div class="col-md-6 grid_box1">

                                    <label>Padre</label>

                                    <input type="number" name="id_padre" class="form-control1" >

                                </div>

                                

                                <div class="col-md-6 grid_box1">

                                    <label>Madre</label>

                                    <input type="number" name="id_madre" class="form-control1" >

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

                                                    <th>Numero crotal</th>

                                                    <th>DIIO</th>

                                                    <th>Nombre</th>

                                                    <th>Peso</th>

                                                    <th>nacimeinto</th>

                                                    <th>categoria</th>

                                                    <th>ID padre</th>

                                                    <th>ID madre</th>

                                                    

                                                    <th> </th>

                                                    <th> </th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                while($row=mysqli_fetch_array($query)){

                                    $animal_id = $row['numero_crotal'];

                            

                            

                            

                            ?>

                                                <tr>

                                                <td data-label="ID"><?php echo $row['ID_animal']; ?></td>

                                                <td data-label="Número de crotal"><?php echo $row['numero_crotal']; ?></td>

                                                <td data-label="DIIO"><?php echo $row['diio']; ?></td>

                                                <td data-label="Nombre"><?php echo $row['nombre']; ?></td>

                                                <td data-label="Peso"><?php echo $row['peso']; ?></td>

                                                <td data-label="nacimiento"><?php echo $row['fecha_nacimiento']; ?></td>

                                                <td data-label="categoria"><?php echo $row['categoria']; ?></td>

                                                <td data-label="ID del padre"><?php echo $row['ID_padre']; ?></td>

                                                <td data-label="ID de la madre"><?php echo $row['ID_madre']; ?></td>

                                                

                                                    <!-- EDITAR 

                                                    <th>

                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"

                                                            data-bs-target="#myModal<?php echo $row['ID_animal'] ?>"

                                                            value="<?php echo $row['ID_animal'] ?>">Editar

                                                        </button>

                                                    </th>-->

                                                    

                                                    <!-- ------------------------------ -->

                                                    <!-- ELIMINAR -->

                                                    <td>

                                                        <form action="detalles/index.php" method="post">

                                                            <input type="hidden" name="ID_animal" value="<?php echo htmlspecialchars($row['ID_animal']); ?>">

                                                            <button type="submit" class="btn btn-primary">Detalles</button>

                                                        </form>

                                                    </td>

                                                    <td>

                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"

                                                            data-bs-target="#confirm-delete-<?php echo $row['ID_animal']; ?>">

                                                            Eliminar

                                                        </button>

                                                        <div class="modal fade" id="confirm-delete-<?php echo $row['ID_animal']; ?>" tabindex="-1" role="dialog"

                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                            <div class="modal-dialog" role="document">

                                                                <div class="modal-content">

                                                                    <div class="modal-header">

                                                                        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro que desea eliminar este animal?</h5>

                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <p>Esta acción no se puede deshacer.</p>

                                                                        <form action="eliminar_animal.php" method="post">

                                                                            <input type="hidden" name="ID_animal" value="<?php echo htmlspecialchars($row['ID_animal']); ?>">

                                                                            <button type="submit" class="btn btn-danger">Eliminar</button>

                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                                                        </form>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </td>

                                                    <!-- FIN ELIMINAR -->

                                                </tr>

                                                <?php 

                                }

                            ?>

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