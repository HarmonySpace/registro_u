$(document).ready(function () {
  const moduls = $("#data_container");
  const demo = $("#demo");
  $.ajax({
    url: "/src/controllers/ModulController.php",
    method: "GET",
    data: {
      request: "modulsOrder",
      order: "ASC",
      column: "id_modulo",
    },
    success: function (res) {
      const data = JSON.parse(res);
      $.get("/src/views/partials/modul/moduls.mustache", function (template) {
        demo.pagination({
          dataSource: data.data,
          pageSize: 10,
          callback: function (data, pagination) {
            const rendered = Mustache.render(template, { data: data });
            moduls.html(rendered);
          },
        });
        moduls.on("click", "#edit", function (event) {
          event.preventDefault();
          const id = $(this).closest("tr").data("id");
          window.location.href = "/modul/edit/" + id;
        });
      });
    },
    error: function (status, error) {
      console.error("error", status, error);
    },
  });
});
