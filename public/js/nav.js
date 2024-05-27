$(document).ready(function () {
  const nav = $('#nav')
	const data = [
		{
			title: 'Usuarios',
			link: '/users'
		},
		{
			title: 'Menus',
			link: '/menus'
		},
		{
			title: 'Modulos',
			link: '/moduls'
		},
	]
	const dataObject = {
		data: data
	}
  $.get('/src/views/partials/public/nav.mustache', function (template) {
    const rendered = Mustache.render(template, dataObject)
    nav.html(rendered)
  })
});