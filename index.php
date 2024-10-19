<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/jpeg" href="images/logo2.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="astyle.css">
</head>
<body>
    <!-- Efecto de estrellas para la seleccion de rol -->
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>



    <div class="role-selection">
        <div class="role" id="docente">
            <img src="images/docente.png" alt="Docente">
            <h2>Docente</h2>
        </div>
        <div class="role" id="alumno">
            <img src="images/alumno.png" alt="Alumno">
            <h2>Alumno</h2>
        </div>
    </div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('docente').addEventListener('click', function() {
            document.querySelector('.role-selection').style.display = 'none';
            document.querySelector('.w3l-login').style.display = 'block';
            // Cambio de fondo al mostrar el formulario de login
            document.body.style.height = '100%';
            document.body.style.overflow = 'hidden';
            document.body.style.background = "url('images/Meneciano_portada_2.png') no-repeat center center";
            document.body.style.backgroundSize = 'cover';
        });
        document.getElementById('alumno').addEventListener('click', function() {
            window.location.href = 'https://nukatech.cl/citt/validar_alumno.php';
        });
        document.querySelector('.back-arrow').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('.w3l-login').style.display = 'none';
            document.querySelector('.role-selection').style.display = 'flex';
            // Restaurar el fondo original al volver a la selección de rol
            document.body.style.background = "url('images/Meneciano_portada.png') no-repeat center center";
            document.body.style.backgroundSize = 'cover';
        });
    });
</script>



<section class="w3l-login">
    <div class="overlay">
        <div class="form-container" style="position: relative;">
            <!-- Colocamos la flecha dentro del contenedor de formulario -->
            <a href="#" class="back-arrow">&#8592;</a> <!-- Flecha de retorno -->
            <h6>Bienvenidos Docentes</h6>
            <h3>Login</h3>
            <?php if (!empty($error_message)) : ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="POST" class="signin-form" action="validar.php">
                <div class="form-input">
                    <input type="text" name="correo" placeholder="Usuario" required="">
                </div>
                <div class="form-input">
                    <input type="password" name="Password" placeholder="Contraseña" required="">
                </div>
                <button type="submit" name="login" class="btn">Iniciar sesión</button>
            </form>
        </div>
    </div>


<!-- Efecto de estrellas para la seleccion de rol -->
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>

</section>


</body>
</html>

