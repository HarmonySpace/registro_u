$(document).ready(function () {
	const name = $("#name")
	const url = window.location.href
	const match = url.match(/\d+/)
	const modulId = match[0] ? Number(match[0]) : null
	const infoModulId = $('#modul_id')
	const error = $("#error")
	infoModulId.append(modulId)
	$.ajax({
		url: "/src/controllers/ModulController.php",
		method: "GET",
		data: {
			request: "modul",
			id: modulId
		},
		success: function (res) {
			const data = JSON.parse(res)
			name.val(data.data[0].nombre)
		},
		error: function (status, error) {
			console.error('error', status, error)
		}
	})
	$("#form").submit(function (event) {
		event.preventDefault()
		if (name.val() !== "") {
			$.ajax({
				url: "/src/controllers/ModulController.php",
				method: "POST",
				data: {
					request: "update",
					id: modulId,
					name: name.val()
				},
				success: function (res) {
					const data = JSON.parse(res)
					console.log(data)
					if (data.data === "true") {
						window.location.href = "/moduls"
					} else {
						$.get("/src/views/partials/components/error_message.mustache", function(template) {
							const rendered = Mustache.render(template, data)
							error.html(rendered)
							$('#liveToast').toast('show')
						})
					}
				},
				error: function (status, error) {
					console.error('error', status, error)
				}
			})
		} else {
			const data = {
				message: "El nombre es requerido"
			}
			$.get("/src/views/partials/components/error_message.mustache", function(template) {
				const rendered = Mustache.render(template, data)
				error.html(rendered)
				$('#liveToast').toast('show')
			})
		}
	})
});