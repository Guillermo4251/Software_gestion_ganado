// ----------------------
// Slidebar
// ----------------------

// Función para obtener el parámetro de la URL
function getParameterByName(name) {
    const url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// Cambia el nombre del usuario si se recibe el parámetro
const usuarioParam = getParameterByName('carlosWeco');
if (usuarioParam) {
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('nombre-usuario').textContent = usuarioParam;
    });
}

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

    const menu = document.querySelector(".menu");
    const main = document.querySelector("main");
    const barraLateral = document.querySelector(".barra-lateral");

    menu.addEventListener("click", () => {
        barraLateral.classList.toggle("max-barra-lateral");
        if (barraLateral.classList.contains("max-barra-lateral")) {
            menu.children[0].style.display = "none";
            menu.children[1].style.display = "block";
        } else {
            menu.children[0].style.display = "block";
            menu.children[1].style.display = "none";
        }
        if (window.innerWidth <= 320) {
            barraLateral.classList.add("mini-barra-lateral");
            main.classList.add("min-main");
        }
    });
});

// ----------------------
// Fin Slidebar
// ----------------------
//------------------------------------------------------------


