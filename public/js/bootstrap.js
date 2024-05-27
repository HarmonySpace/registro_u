$(document).ready(function () {
	const bootstrap = $('#bootstrap');
	$.get('/src/views/partials/public/bootstrap.mustache', function (template) {
		const rendered = Mustache.render(template);
		bootstrap.html(rendered);
	})
});