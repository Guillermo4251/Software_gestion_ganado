<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: https://nukatech.cl/citt/");
    exit;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css">


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
        <main>
            
    <!-- Botón para regresar al index -->
    <a href="https://nukatech.cl/citt/usuario/graficos/index.php" class="btn arrow-button">
        <i class="fas fa-arrow-left"></i>
    </a>
            <section class="recent">
                <div class="activity-grid">
                    <h2 class="text-center mb-5">Datos</h2>
                    <!-- INICIO LookerStudio  ----------------------------------------------------------------------->
                            <div class="horz-grid">
                                <div class="row show-grid">
                                    <iframe width="935" height="702" src="https://lookerstudio.google.com/embed/reporting/6f7a7e36-c97b-4c8c-9ce7-391b5fdd3e5d/page/CWDWE" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
                                </div>
                            </div>
                    <!-- Fin LookerStudio  ----------------------------------------------------------------------->
                    
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
    <!-- Importacion para graficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Ver grafico -->
    <script>
    // Pasar los datos de PHP a una variable global de JavaScript
    window.datosGrafico = <?php echo json_encode($datosGrafico); ?>;
    </script>
</body>

</html>


    