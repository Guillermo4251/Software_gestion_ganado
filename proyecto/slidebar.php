<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
</head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Outfit', sans-serif;
    }
    body{
        height: 100vh;
        width: 100%;
    }

    /*-----------------Menu*/
    .menu{
        position: fixed;
        width: 50px;
        height: 50px;
        font-size: 30px;
        display: none;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        cursor: pointer;
        background-color: black;
        color: white;
        right: 15px;
        top: 15px;
        z-index: 100;
    }

    /*----------------Barra Lateral*/
    .barra-lateral{
        position: fixed;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 250px;
        height: 100%;
        overflow: hidden;
        padding: 20px 15px;
        background-color: #025a81;
        transition: width 0.5s ease,background-color 0.3s ease,left 0.5s ease;
        z-index: 50;
    }

    .mini-barra-lateral{
        width: 80px;
    }
    .barra-lateral span{
        width: 100px;
        white-space: nowrap;
        font-size: 18px;
        text-align: left;
        opacity: 1;
        transition: opacity 0.5s ease,width 0.5s ease;
    }
    .barra-lateral span.oculto{
        opacity: 0;
        width: 0;
    }

    /*-----------------> Linea*/
    .barra-lateral .linea{
        width: 100%;
        height: 1px;
        margin-top: 15px;
        background-color: rgb(180,180,180);
    }


    /*---------------> Usuario*/
    .barra-lateral .usuario{
        width: 100%;
        display: flex;
    }
    .barra-lateral .usuario img{
        width: 50px;
        min-width: 50px;
        border-radius: 10px;
    }
    .barra-lateral .usuario .info-usuario{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--color-texto);
        overflow: hidden;
    }
    .barra-lateral .usuario .nombre-email{
        width: 100%;
        display: flex;
        flex-direction: column;
        margin-left: 5px;
    }
    .barra-lateral .usuario .nombre{
        font-size: 15px;
        font-weight: 600;
    }
    .barra-lateral .usuario .email{
        font-size: 13px;
    }
    .barra-lateral .usuario ion-icon{
        font-size: 20px;
    }

    /*------------------> Responsiva*/
    @media (max-width: 1200px){
        .barra-lateral{
            position: fixed;
            left: -250px;
        }
        .max-barra-lateral{
            left: 0;
        }
        .menu{
            display: flex;
        }
        .menu ion-icon:nth-child(2){
            display: none;
        }
        main{
            margin-left: 0;
        }
        main.min-main{
            margin-left: 0;
        }
        
    }

    /* ----------------------------- */
    .nav_combined {
        width: 300px;
    }

    .nav_link_combined {
        color: #ffffff;
        display: block;
        padding: 15px 0;
        text-decoration: none;
    }
    .nav_link_combined--inside {
        border-radius: 6px;
        padding-left: 20px;
    }
    .list_combined {
        width: 100%;
        height: 60vh;
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
    .list_item_combined {
        list-style: none;
        width: 100%;
        text-align: center;
        overflow: hidden;
    }

    .list_item_combined--click {
        cursor: pointer;
    }

    .list_button_combined {
        display: flex;
        align-items: center;
        gap: 1em;
        width: 70%;
        margin: 0 auto;
    }

    .list_arrow_combined {
        margin-left: auto;
        transition: transform .3s;
    }

    .list_show_combined {
        width: 80%;
        margin-left: auto;
        border-left: 2px solid #303440;
        list-style: none;
        transition: height .4s;
        height: 0;
    }

    
    </style>
<body>
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <img class="img-circle img-md" src="https://nukatech.cl/citt/images/logo.png" alt="Profile Picture" style="width: 200px; height: 100px;">
            </div>
        </div>

        <nav class="nav">
            <ul class="list_combined">
                <li class="list_item_combined list_item_combined--click">
                    <div class="list_button_combined list_button_combined--click">
                        <img src="https://nukatech.cl/citt/usuario/iconos/ganado.png" style="width: 24px; height: 24px;" alt="" class="list_img">
                        <a href="#" class="nav_link_combined">Ganado</a>
                        <img src="https://nukatech.cl/citt/usuario/iconos/arrow.svg"  alt="" class="list_arrow_combined">
                    </div>
                    <ul class="list_show_combined">
                        <li class="list_inside">
                            <a href="https://nukatech.cl/citt/usuario/ganado/bovinos" class="nav_link_combined nav_link_combined--inside">Vacas</a>
                        </li>
                        <li class="list_inside">
                            <a href="https://nukatech.cl/citt/usuario/ganado/porcinos" class="nav_link_combined nav_link_combined--inside">Cerdos</a>
                        </li>
                        <li class="list_inside">
                            <a href="https://nukatech.cl/citt/usuario/ganado/ovinos" class="nav_link_combined nav_link_combined--inside">Ovejas</a>
                        </li>
                    </ul>
                </li>
                <li class="list_item_combined">
                    <div class="list_button_combined">
                        <img src="https://nukatech.cl/citt/usuario/iconos/lotes.png" style="width: 24px; height: 24px;" alt="" class="list_img">
                        <a href="https://nukatech.cl/citt/usuario/lotes/index.php" class="nav_link_combined">lotes</a>
                    </div>
                </li>
                <li class="list_item_combined">
                    <div class="list_button_combined">
                        <img src="https://nukatech.cl/citt/usuario/iconos/docs.png" alt="" style="width: 24px; height: 24px;" class="list_img">
                        <a href="https://nukatech.cl/citt/usuario/reportes/generar_reporte.php" class="nav_link_combined">Reportes</a>
                    </div>
                </li>
                <li class="list_item_combined">
                    <div class="list_button_combined">
                        <img src="https://nukatech.cl/citt/usuario/iconos/cerrar.png" style="width: 24px; height: 24px;" alt="" class="list_img">
                        <a href="" class="nav_link_combined">Salir</a>
                    </div>
                </li>
            </ul>
        </nav>

        <div>
            <div class="linea"></div>

    
            <div class="usuario">
                <img src="https://nukatech.cl/citt/usuario/iconos/usuario_.png" alt="">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="nombre">Usuario</span>
                        <span class="email"></span>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Para el menú lateral expandible
            const listElements = document.querySelectorAll('.list_item_combined--click');
            listElements.forEach(listElement => {
                const button = listElement.querySelector('.list_button_combined');
                const menu = listElement.querySelector('.list_show_combined');
                const arrow = button.querySelector('.list_arrow_combined');

                button.addEventListener('click', () => {
                    let height = menu.clientHeight === 0 ? menu.scrollHeight : 0;
                    menu.style.height = `${height}px`;
                    arrow.style.transform = height ? 'rotate(90deg)' : 'rotate(0deg)';
                });
            });
        });
        const menu = document.querySelector(".menu");
        const main = document.querySelector("main");
        const barraLateral = document.querySelector(".barra-lateral");
        menu.addEventListener("click",()=>{
            barraLateral.classList.toggle("max-barra-lateral");
            if(barraLateral.classList.contains("max-barra-lateral")){
                menu.children[0].style.display = "none";
                menu.children[1].style.display = "block";
            }
            else{
                menu.children[0].style.display = "block";
                menu.children[1].style.display = "none";
            }
            if(window.innerWidth<=320){
                barraLateral.classList.add("mini-barra-lateral");
                main.classList.add("min-main");
                spans.forEach((span)=>{
                    span.classList.add("oculto");
                })
            }
        });

    </script>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>