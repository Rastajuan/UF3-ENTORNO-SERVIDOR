document
	.getElementById("botonRegistrar")
	.addEventListener("click", validarRegistro);

//Validacion del formulario de registro
function validarRegistro() {
	var usuario = document.getElementById("usuario").value;
	var nombre = document.getElementById("nombre").value;
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var password2 = document.getElementById("password2").value;

	if (usuario == "") {
		alert("El campo usuario es obligatorio");
		return false;
	}
	if (nombre == "") {
		alert("El campo nombre es obligatorio");
		return false;
	}

	if (email == "") {
		alert("El campo email es obligatorio");
		return false;
	}
	if (password == "") {
		alert("El campo password es obligatorio");
		return false;
	}
	if (password2 == "") {
		alert("El campo password2 es obligatorio");
		return false;
	}
	if (password != password2) {
		alert("Las contraseñas no coinciden");
		return false;
	}
	return true;
}
