<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
}
$conexion = new mysqli("localhost", "cbu91029_cberrios", "carlitrox21", "cbu91029_citt");
?>

<!DOCTYPE html>
<html lang="es">
<link rel="icon" type="image/x-icon" href="https://cdn.discordapp.com/attachments/1095898961082056824/1108164201400238130/Icono_2.png">
<!-- Fuente -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Informe</title>
    <!-- iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="https://nukatech.cl/citt/usuario/style.css">
    <style>
        .clickable-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            background-color: #f8f9fa;
        }
        
        .clickable-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .clickable-card h5 {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

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
        
        <main class="container py-5">
            <div class="row g-4">
              <!-- Rectángulo 1 -->
<div class="col-12 col-sm-6 col-lg-4">
    <div class="clickable-card" onclick="window.location.href='generar_info.php?opcion=datos_generales_ovino';">
        <h5>Datos generales</h5>
        <p>Descripción de la opción 1.</p>
    </div>
</div>
<!-- Rectángulo 2 -->
<div class="col-12 col-sm-6 col-lg-4">
    <div class="clickable-card" onclick="window.location.href='generar_info.php?opcion=inseminacion_ovino';">
        <h5>Inseminacion</h5>
        <p>Descripción de la opción 2.</p>
    </div>
</div>
<!-- Rectángulo 3 -->
<div class="col-12 col-sm-6 col-lg-4">
    <div class="clickable-card" onclick="window.location.href='generar_info.php?opcion=parto_ovino';">
        <h5>Partos</h5>
        <p>Descripción de la opción 3.</p>
    </div>
</div>



                    </div>
                </div>
            </div>
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
