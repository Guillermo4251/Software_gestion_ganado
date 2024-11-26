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
        /* Estilos para las tarjetas */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px; /* Bordes redondeados en toda la tarjeta */
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    .card img {
        width: 100%; /* Hace que la imagen cubra todo el ancho de la tarjeta */
        height: 120px; /* Ajusta la altura para que no sea demasiado alta */
        object-fit: cover; /* Corta la imagen para que se ajuste bien en el espacio */
        border-radius: 10px 10px 0 0; /* Bordes redondeados en la parte superior */
    }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 0.9rem;
            color: #555;
        }
        /* Estilos para el contenedor de las tarjetas */
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .card-item {
            flex: 1 1 calc(33.33% - 20px);
            max-width: calc(33.33% - 20px);
        }
           .card-body .btn-primary {
        align-self: flex-end; /* Alinea el botón a la derecha */
        margin-top: 10px; /* Añade un pequeño margen superior para separación */
    }
        .card-body {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
        /* Asegura que las tarjetas sean responsive */
        @media (max-width: 768px) {
            .card-item {
                flex: 1 1 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .card-item {
                flex: 1 1 100%;
                max-width: 100%;
            }
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
        <main>
            <div class="container">
                <h2 class="text-center mb-5">Registrar gastos</h2>

                <!-- Contenedor para las tarjetas -->
  <div class="cards-container">
                    <!-- Tarjeta 1 -->
                    <div class="card-item">
                        <div class="card">
                            <img src="images/cow.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Gasolina</h5>
                                
                                <a href="https://nukatech.cl/citt/usuario/gastos/gastos_gasolina" class="btn btn-primary">Ver más</a>
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
    <!--  JS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
</body>

</html>