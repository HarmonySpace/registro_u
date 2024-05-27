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
    const checkedList = [];
    if (
      name.val() !== "" &&
      type.val() !== "" &&
      active.val() !== "" &&
      deleted.val() !== "" &&
      modul.val() !== ""
    ) {
      console.log(checkedList);
      // $.ajax({
      //   url: "/src/controllers/MenuController.php",
      //   method: "POST",
      //   data: {
      //     request: "create",
      //     name: name.val(),
      //     active: active.val(),
      //     deleted: deleted.val(),
      //     type: type.val(),
      //     modul: modul.val(),
      //   },
      //   success: function (res) {
      //     const data = JSON.parse(res);
      //     if (data.data === "true") {
      //       window.location.href = "/menus";
      //     } else {
      //       $.get(
      //         "/src/views/partials/components/error_message.mustache",
      //         function (template) {
      //           const rendered = Mustache.render(template, data);
      //           error.html(rendered);
      //           $("#liveToast").toast("show");
      //         },
      //       );
      //     }
      //   },
      //   error: function (status, error) {
      //     console.error("error", status, error);
      //   },
      // });
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

// $('input[type="checkbox"]').on('change', function() {
//   const checkedIds = [];
//   $('input[type="checkbox"]:checked').each(function() {
//     checkedIds.push($(this).val());
//   });
//   console.log(checkedIds); // Array of IDs of checked checkboxes
// });
