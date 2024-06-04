$(document).ready(function () {
	const url = window.location.href
	const match = url.match(/\d+/)
	const userId = match[0] ? Number(match[0]) : null
	const infoUserId = $('#user_id')
	infoUserId.append(userId)
	$.ajax({
		url: '/src/controllers/UserController.php',
		method: 'GET',
		data: {
			request: 'getUser',
			id: userId
		},
		success: function (res) {
			const data = JSON.parse(res);
			$('#u_nombre').val(data.data.nombre);
			$('#u_clave').val(data.data.clave);
			$('#u_cod_fac').val(data.data.cod_fac);
			$('#u_usuario_creador').val(data.data.usuario_creador);
			$('#u_activo').val(data.data.activo);
			$('#u_tipo_menu').val(data.data.tipo_menu);
			$('#u_fecha_creacion').val(data.data.fecha_creacion);
		},
		error: function (xhr, status, error) {
			console.error('error', status, error)
		}
	})
	$('#update_user').on('click', function (event) {
		event.preventDefault()
		$.ajax({
			url: '/src/controllers/UserController.php',
			method: 'POST',
			data: {
				request: 'putUser',
				id: userId,
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
					window.location.href = '/'
				}
			}
		})
	})
})