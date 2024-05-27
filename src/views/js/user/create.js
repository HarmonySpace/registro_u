$(document).ready(function () {
	const button = $('#create_user')

	button.on("click", function (event) {
		event.preventDefault()
		$.ajax({
			url: '/src/controllers/UserController.php',
			method: 'POST',
			data: {
				request: 'postUser',
				name: $('#u_nombre').val(),
				key: $('#u_clave').val(),
				codFac: $('#u_cod_fac').val(),
				uCreator: $('#u_usuario_creador').val(),
				active: $('#u_activo').val(),
				menu: $('#u_tipo_menu').val(),
				dateCreate: $('#u_fecha_creacion').val()
			},
			success: function (res) {
				if (res) {
					window.location.href = '/';
				}
			}
		})
	})
});