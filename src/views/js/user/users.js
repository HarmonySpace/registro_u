$(document).ready(function () {
	const userTable = $('#render_user_table');
	$.ajax({
		url: 'src/controllers/UserController.php',
		method: 'GET',
		data: { request: 'getUsers' },
		success: function (res) {
			const data = JSON.parse(res)
			$.get('/src/views/partials/home/user_table.mustache', function (template) {
				const renderTable = Mustache.render(template, data);
				userTable.html(renderTable);
			})
		},
		error: function (xhr, status, error) {
			console.error('error', status, error)
		}
	})

			// const user_id = $(this).parents().parents('tr').data('id');

	userTable.on("click", '#edit', function (event) {
		event.preventDefault()
		const userId = $(this).closest('tr').data('id')
		console.log(userId)
		window.location.href = '/users/edit/' + userId
	})
})
