$(document).ready(function () {
  const name = $("#name");
  const direction = $("#direction");
  const error = $("#error");
  $("#form").submit(function (event) {
    event.preventDefault();
    if (name.val() !== "" && direction.val() !== "") {
      $.ajax({
        url: "/src/controllers/ModulController.php",
        method: "POST",
        data: {
          request: "create",
          name: name.val(),
          direction: direction.val(),
        },
        success: function (res) {
          const data = JSON.parse(res);
          if (data.data === "true") {
            window.location.href = "/moduls";
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
        message: "El nombre es requerido",
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
