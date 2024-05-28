$(document).ready(function () {
  const error = $("#error");
  const name = $("#name");
  const active = $("#active");
  const deleted = $("#deleted");
  const type = $("#type");
  let modul = $("#modul"); // this value is null before *select* render
  const modul_rendered = $("#modul_rendered");
  $.ajax({
    url: "/src/controllers/ModulController.php",
    method: "GET",
    data: {
      request: "modulsOrder",
      order: "ASC",
      column: "nombre",
    },
    success: function (res) {
      const data = JSON.parse(res);
      const options = data.data.map((item) => {
        return {
          text: item.nombre,
          id: item.id_modulo,
        };
      });
      $.get(
        "/src/views/partials/components/check_list.mustache",
        function (template) {
          const rendered_moduls = Mustache.render(template, {
            options: options,
          });
          modul_rendered.html(rendered_moduls);
          modul = $("#modul");
        },
      );
    },
    error: function (status, error) {
      console.error("error", status, error);
    },
  });
  $("#form").submit(function (event) {
    event.preventDefault();
    const modulList = [];
    $("#list-group") >
      $(".form-check-input:checked").each(function () {
        modulList.push($(this).val());
      });
    if (
      name.val() !== "" &&
      type.val() !== "" &&
      active.val() !== "" &&
      deleted.val() !== "" &&
      modul.val() !== "" &&
      modulList.length !== 0
    ) {
      console.log(modulList);
      $.ajax({
        url: "/src/controllers/MenuController.php",
        method: "POST",
        data: {
          request: "create",
          name: name.val(),
          active: active.val(),
          deleted: deleted.val(),
          type: type.val(),
          moduls: JSON.stringify(modulList),
        },
        success: function (res) {
          const data = JSON.parse(res);
          if (data.data === "true") {
            window.location.href = "/menus";
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
