$(document).ready(function () {
	const moduls = $("#data_container")
	const demo = $("#demo")
	$.ajax({
		url: "/src/controllers/MenuController.php",
		method: "GET",
		data: { 
			request: "menus",
			// order: "ASC",
			// column: "id_modulo"
		 },
		success: function (res) {
			const data = JSON.parse(res)
			$.get("/src/views/partials/menu/menus.mustache", function (template) {
				demo.pagination({
					dataSource: data.data,
					pageSize: 10,
					callback: function (data, pagination) {
						const rendered = Mustache.render(template, { data: data })
						moduls.html(rendered);
					}
				});
				
				moduls.on("click", "#edit", function (event) {
					event.preventDefault()
					console.log("edit")
					const id = $(this).closest("tr").data("id")
					window.location.href = '/menu/edit/' + id
				})
			})
		},
		error: function (status, error) {
			console.error('error', status, error)
		}
	})


});