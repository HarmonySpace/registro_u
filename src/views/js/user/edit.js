$(document).ready(function () {
  const url = window.location.href;
  const match = url.match(/\d+/);
  const infoUserId = $("#user_id");
  const userId = match[0] ? Number(match[0]) : null;
  infoUserId.append(userId);
  const error = $("#error");
  const name = $("#name");
  const lastnames = $("#lastnames");
  const inss = $("#inss");
  const range = $("#range");
  const menu = $("#menu");
  const faculty = $("#faculty");
  const active = $("#active");
  const deleted = $("#deleted");
  $.ajax({
    url: "/src/controllers/UserController.php",
    method: "GET",
    data: {
      request: "user",
      id: userId,
    },
    success: function (res) {
      const data = JSON.parse(res);
      name.val(data.data[0].nombre);
      lastnames.val(data.data[0].apellidos);
      inss.val(data.data[0].inss);
      range.val(data.data[0].cargo);
      menu.val(data.data[0].id_menu);
      faculty.val(data.data[0].cod_fac);
      active.val(data.data[0].activo);
      deleted.val(data.data[0].eliminado);
    },
    error: function (status, error) {
      console.error("error", status, error);
    },
  });
  $("#form").submit(function (event) {
    event.preventDefault();
    if (
      name.val() !== "" &&
      lastnames.val() !== "" &&
      inss.val() !== "" &&
      range.val() !== "" &&
      menu.val() !== "" &&
      faculty.val() !== "" &&
      active.val() !== "" &&
      deleted.val() !== ""
    ) {
      $.ajax({
        url: "/src/controllers/UserController.php",
        method: "POST",
        data: {
          request: "update",
          id: userId,
          name: name.val(),
          lastnames: lastnames.val(),
          inss: inss.val(),
          range: range.val(),
          menu: menu.val(),
          faculty: faculty.val(),
          active: active.val(),
          deleted: deleted.val(),
        },
        success: function (res) {
          console.log(res);
          const data = JSON.parse(res);
          if (data.data === "true") {
            window.location.href = "/users";
          } else {
            $.get(
              "/src/views/partials/components/error_message.mustache",
              function (template) {
                const rendered = Mustache.render(template, data);
                error.html(rendered);
                $("#liveToast").toast("show");
              },
            );
          }
        },
        error: function (status, error) {
          console.error("error", status, error);
        },
      });
    } else {
      const data = {
        message: "Todos los campos son requeridos",
      };
      $.get(
        "/src/views/partials/components/error_message.mustache",
        function (template) {
          const rendered = Mustache.render(template, data);
          error.html(rendered);
          $("#liveToast").toast("show");
        },
      );
    }
  });
});
