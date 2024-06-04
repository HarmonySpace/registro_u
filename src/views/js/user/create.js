$(document).ready(function () {
  const error = $("#error");
  const name = $("#name");
  const lastnames = $("#lastnames");
  const inss = $("#inss");
  const range = $("#range");
  const menu = $("#menu");
  const faculty = $("#faculty");
  const active = $("#active");
  const deleted = $("#deleted");
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
          request: "create",
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
