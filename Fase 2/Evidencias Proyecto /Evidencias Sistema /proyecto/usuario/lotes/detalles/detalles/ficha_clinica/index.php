<?php
session_start();
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");


if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}

if (isset($_POST['id_lote'])) {
    // Obtiene el valor del ID_animal
    $id_lote = $_POST['id_lote'];
} else {
    
}



$sql = "SELECT * FROM ficha_clinica_lotes where id_lote = $id_lote";
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
            
            
            <!--boton para volver atras-->
            <button type="button" class="btn arrow-button" onclick="goBackWithPost();">
    <i class="fas fa-arrow-left"></i>
</button>

            <script type="text/javascript">
            function goBackWithPost() {
                // Crea un formulario temporal
                var form = document.createElement("form");
                form.method = "post";
                form.action = '../index.php';
            
                // Crea un campo oculto para el dato que quieres enviar
                var hiddenField = document.createElement("input");
                hiddenField.type = "hidden";
                hiddenField.name = "id_lote"; // Nombre del campo
                hiddenField.value = "<?php echo htmlspecialchars($id_lote); ?>"; // Valor del campo
            
                // Añade el campo oculto al formulario
                form.appendChild(hiddenField);
            
                // Añade el formulario temporal al cuerpo del documento y envíalo
                document.body.appendChild(form);
                form.submit();
            }
            </script>
                        <!--fin del boton-->

            
            
            <section class="recent">
                <div class="activity-grid">
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">
                                Registro clinico
                            </h4>
                        </div>
                        <form method="post" action="añadir.php">
                            <div class="row show-grid">
                                
                                
                                
                                
                                <div class="">
                                    <input type="hidden" id="id_animal" name="id_animal" value="<?php echo $id_lote; ?>">
                                </div>
                                
                                
                                <div class="col-md-4 grid_box1">
                                    <label>Fecha</label>
                                    <input type="date" name="fecha" class="form-control1"
                                        required>
                                </div>
                                
                                <div class="col-md-10">
                                    <label>Diagnostico</label>
                                    <textarea type="text" name="diagnostico" rows="4" cols="50" class="form-control2"></textarea>
                                </div>
                                
                                <div class="col-md-10">
                                    <label>Tratamiento</label>
                                    <textarea type="text" name="tratamiento" rows="4" cols="50" class="form-control2"></textarea>
                                </div>
                                
                                <div class="col-md-4">
                                    <label>Resultado</label>
                                    <textarea type="text" name="resultado" rows="4" cols="50" class="form-control1"></textarea>
                                </div>
                                
                                <div class="d-grid gap-1 col-6 mx-auto btn-guardar">
                                    <button class="btn btn-primary" type="submit">Confirmar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">
                                Ficha clinica
                            </h4>
                        </div>
                        <section class="recent">
                            <div class="activity-grid">
                                <div class="activity-card">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Diagnostico</th>
                                                    <th>Tratamiento</th>
                                                    <th>Resultado</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                while($row=mysqli_fetch_array($query)){
                            ?>
                                                <tr>
                                                    <td data-label="Fecha"><?php echo $row['fecha']; ?></td>
                                                    <td data-label="Diagnostico"><?php echo $row['diagnostico']; ?></td>
                                                    <td data-label="Tratamiento"><?php echo $row['tratamiento']; ?></td>
                                                    <td data-label="Resultado"><?php echo $row['resultado']; ?></td>
                                                   
                                                    <!-- ELIMINAR -->
                                                    <td>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#confirm-delete-<?php echo $row['id_ficha']; ?>">
                                                            Eliminar
                                                        </button>
                                                        <div class="modal fade" id="confirm-delete-<?php echo $row['id_ficha']; ?>" tabindex="-1" role="dialog"
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
                                                                            <input type="hidden" name="id_ficha" value="<?php echo $row['id_ficha']; ?>">
                                                                            <input type="hidden" name="id_animal" value="<?php echo $id_lote; ?>"> <!-- Segundo dato -->
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