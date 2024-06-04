$(document).ready(function () {
  const moduls = $("#data_container");
  const demo = $("#demo");
  $.ajax({
    url: "/src/controllers/UserController.php",
    method: "GET",
    data: {
      request: "users",
    },
    success: function (res) {
      const data = JSON.parse(res);
      //console.log(res);
      data.data.forEach((item) => {
        if (item.modulos) {
          const modulosStr = item.modulos.replace(/{|}/g, ""); // remove curly braces
          item.modulos = modulosStr.split(",").map(Number); // convert to array of numbers
        } else {
          item.modulos = [];
        }
      });
      console.log(data);
      $.get("/src/views/partials/user/users.mustache", function (template) {
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
          console.log("edit");
          const id = $(this).closest("tr").data("id");
          window.location.href = "/menu/edit/" + id;
        });
      });
    },
    error: function (status, error) {
      console.error("error", status, error);
    },
  });
});
