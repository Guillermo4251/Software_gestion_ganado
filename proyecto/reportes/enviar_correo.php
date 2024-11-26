<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");

// se traera el correo el profe de la misma sesion, pero vamos a verificar primero si es un profesor 
$correoProfesor = "";
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'Profesor') {
    $nombre_usuario = $_SESSION['usuario'];
    $consultauser = "SELECT correo FROM usuario WHERE tipo = 'Profesor' AND correo = '$nombre_usuario'";
    $resultado2 = mysqli_query($conexion, $consultauser);
    
    if ($resultado2 && $row2 = $resultado2->fetch_assoc()) {
        $correoProfesor = $row2['correo'];
    }
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
                    <?php if ($_SESSION['tipo_usuario'] === 'Profesor') { ?>
                    
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 class="grid-example-basic">
                                Enviar correo electrónico
                            </h4>
                        </div>
                        <form action="enviar.php" method="post">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Profesor</label>
                                <input type="text" class="form-control" name="profe" id="profe" 
                                       value="<?php echo htmlspecialchars($correoProfesor); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Destinatario</label>
                                <input type="email" class="form-control" id="destinatario" name="destinatario" placeholder="Escribe el correo del destinatario" required>
                            </div>
                            <div class="mb-3">
                                <label for="asunto" class="form-label">Asunto</label>
                                <textarea class="form-control" id="asunto" name="asunto" rows="2" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Mensaje</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-outline-success">Enviar</button>
                            </div>
                        </form>
                    </div>
        
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <!-- Modal de Éxito -->
                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Correo enviado correctamente.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        // Mostrar el modal automáticamente al cargar la página
                        document.addEventListener('DOMContentLoaded', function() {
                            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                            successModal.show();
                        });
                    </script>
                    <?php endif; ?>
        
                    <?php } else { ?>
                    <!-- Modal de Permiso Denegado -->
                    <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="permissionModalLabel">Lo sentimos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    Solo los profesores pueden enviar correos electrónicos.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="redirectButton" data-bs-dismiss="modal">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- JavaScript para mostrar el modal automáticamente y redirigir -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var myModal = new bootstrap.Modal(document.getElementById('permissionModal'), {
                                keyboard: false
                            });
                            myModal.show();
        
                            // Redirigir al hacer clic en el botón
                            document.getElementById('redirectButton').addEventListener('click', function () {
                                window.location.href = 'index.php'; // Redirige a index.php
                            });
                        });
                    </script>
                    <?php } ?>
                </div>
            </section>
        </main>


    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>