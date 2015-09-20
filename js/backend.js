/* JavaScript utilizado en Admin Panel.
 * Definimos varias funciones para trabajar con el, confirmacion para borrar,
 * validacion de formulario en el lado del cliente, mostrar algun menu.
 *
 * */
function confirmReset(evt) {
    if (confirm("Va a reiniciar el formulario ¿desea hacerlo?")) {

    } else {
        evt.preventDefault();
    }
}

function confirmDel(evt) {
    if (confirm("Va a eliminar este elemento, no podra recuperarlo despues ¿ Desea Continuar?")) {

    } else {
        evt.preventDefault();
    }
}

function valEnvio() {

}

function mostrarAdd() {
    var aniadir = document.getElementById('aniadir');
    aniadir.classList.toggle('oculto');
}

function addMenu() {
    var ver = document.getElementById('lista-acc');
    ver.classList.toggle('oculto');
}

function filtro(e) { //e es un objeto keyboardEvent
    // El código Unicode de la tecla pulsada se almacena en keyCode o charCode. Si es un carácter visualizable se almacena en charCode, en otro caso en keyCode 
    var codigo = e.charCode || e.keyCode;
    // Si la tecla es una tecla de función, control, alt o código ASCII < 32 no se filtra
    if (codigo < 32 || e.charCode == 0 || e.ctrlKey || e.altKey) {
        return; // No filtramos el evento
    }
    // Convertimos el código del carácter en un string 
    var texto = String.fromCharCode(codigo);
    var permitidos = "0123456789"
    if (permitidos.indexOf(texto) == -1) { // Es un carácter no permitido
        this.nextElementSibling.innerText = "Sólo números";
        // Cancelamos la acción por defecto para que el texto no sea insertado 
        if (e.preventDefault) e.preventDefault();
        return false;
    }
    // Si todos los caracteres son permitidos, oculta el mensaje 
    this.nextElementSibling.innerText = "";
}

function init() {
    var botoReset = document.getElementById('reinicio');
    var botoEnviar = document.getElementById('enviar');
    var menuadd = document.getElementById('inmuebles-ad');
    var elementoAniadir = document.getElementById('m-add');
    var eliminadores = document.getElementsByClassName('eliminador');

    botoReset.addEventListener("click", confirmReset, false);
    botoEnviar.addEventListener("click", valEnvio, false);
    menuadd.addEventListener('click', addMenu, true);
    elementoAniadir.addEventListener('click', mostrarAdd, true);
    document.getElementById('superficie').addEventListener("keypress", filtro, false);
    document.getElementById('cp').addEventListener("keypress", filtro, false);
    document.getElementById('precio').addEventListener("keypress", filtro, true);
    //
    for (var pos = 0; eliminadores.length; pos++) {
        eliminadores[pos].addEventListener('click', confirmDel, true);
    }

}

window.addEventListener("load", init);