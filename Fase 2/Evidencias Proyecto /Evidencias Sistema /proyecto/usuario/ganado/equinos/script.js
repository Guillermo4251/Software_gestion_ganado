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