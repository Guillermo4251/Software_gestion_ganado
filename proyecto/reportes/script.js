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

window.addEventListener('load', function () {
    // Fecha de nacimiento
    document.getElementById('fecha_nacimiento').type = 'text';
    document.getElementById('fecha_nacimiento').addEventListener('blur', function () {
        document.getElementById('fecha_nacimiento').type = 'text';
    });
    document.getElementById('fecha_nacimiento').addEventListener('focus', function () {
        document.getElementById('fecha_nacimiento').type = 'date';
    });

    // Primer celo
    document.getElementById('fecha_primer_celo').type = 'text';
    document.getElementById('fecha_primer_celo').addEventListener('blur', function () {
        document.getElementById('fecha_primer_celo').type = 'text';
    });
    document.getElementById('fecha_primer_celo').addEventListener('focus', function () {
        document.getElementById('fecha_primer_celo').type = 'date';
    });

    // Ultimo parto
    document.getElementById('fecha_ultimo_parto').type = 'text';
    document.getElementById('fecha_ultimo_parto').addEventListener('blur', function () {
        document.getElementById('fecha_ultimo_parto').type = 'text';
    });
    document.getElementById('fecha_ultimo_parto').addEventListener('focus', function () {
        document.getElementById('fecha_ultimo_parto').type = 'date';
    });
});


// PESO
var pesoInput = document.getElementById('peso');
// Agregar un event listener para el evento 'input'
pesoInput.addEventListener('input', function () {
    // Obtener el valor ingresado en el campo de entrada
    var valor = this.value.trim();
    // Eliminar todos los caracteres que no sean dígitos
    valor = valor.replace(/\D/g, '');
    // Convertir el valor a un número entero
    var peso = parseInt(valor);
    // Verificar si el valor es menor que 0
    if (peso < 0 || isNaN(peso)) {
        // Si es menor que 0 o no es un número válido, establecer el valor del campo como 0
        peso = 0;
    }
    this.value = peso;
});

// "ID PADRE"
var idPadreInput = document.getElementsByName('id_padre')[0];
// Agregar un event listener para el evento 'input'
idPadreInput.addEventListener('input', function () {
    // Obtener el valor ingresado en el campo de entrada
    var valor = this.value.trim();
    // Eliminar todos los caracteres que no sean dígitos
    valor = valor.replace(/\D/g, '');
    // Convertir el valor a un número entero
    var idPadre = parseInt(valor);
    // Verificar si el valor es menor que 0
    if (idPadre < 0 || isNaN(idPadre)) {
        // Si es menor que 0 o no es un número válido, establecer el valor del campo como 0
        idPadre = 0;
    }
    this.value = idPadre;
});

// "ID MADRE"
var idMadreInput = document.getElementsByName('id_madre')[0];
idMadreInput.addEventListener('input', function () {
    var valor = this.value.trim();
    // Eliminar todos los caracteres que no sean dígitos
    valor = valor.replace(/\D/g, '');
    // Convertir el valor a un número entero
    var idMadre = parseInt(valor);
    // Verificar si el valor es menor que 0
    if (idMadre < 0 || isNaN(idMadre)) {
        // Si es menor que 0 o no es un número válido, establecer el valor del campo como 0
        idMadre = 0;
    }
    this.value = idMadre;
});

//"Número Crotal"
var crotalInput = document.getElementsByName('crotal')[0];
crotalInput.addEventListener('input', function () {
    // Obtener el valor ingresado en el campo de entrada
    var valor = this.value.trim();
    // Eliminar todos los caracteres que no sean dígitos
    valor = valor.replace(/\D/g, '');
    // Actualizar el valor del campo de entrada
    this.value = valor;
});