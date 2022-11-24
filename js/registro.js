document
	.getElementById("botonRegistrar")
	.addEventListener("click", validarRegistro);

//Validacion del formulario de registro
function validarRegistro() {
	var usuario = document.getElementById("id").value;
	var nombre = document.getElementById("nombre").value;
	var correo = document.getElementById("correo").value;
	var contraseña = document.getElementById("contraseña").value;
	var contraseña2 = document.getElementById("contraseña2").value;

	if (usuario == "") {
		alert("El campo usuario es obligatorio");
		return false;
	}
	if (nombre == "") {
		alert("El campo nombre es obligatorio");
		return false;
	}

	if (correo == "") {
		alert("El campo email es obligatorio");
		return false;
	}
	if (contraseña == "") {
		alert("El campo password es obligatorio");
		return false;
	}
	if (contraseña2 == "") {
		alert("El campo password2 es obligatorio");
		return false;
	}
	if (contraseña != contraseña2) {
		alert("Las contraseñas no coinciden");
		return false;
	}
	return true;
}
