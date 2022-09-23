$(function () {
  $(".appointment-form").submit(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: "php/save-appointment.php",
      dataType: "json",
      async: false,
      data: $(".appointment-form").serialize(),
      success: function (data) {
        console.log(data);

        if (data.status == "success") {
          $(".scss-msg").text(data.message);
          $(".scss-div").fadeIn();
          $(".err-div").fadeOut();
          window.location.href = "laser-thank.html";
        }

        if (data.status == "error") {
          $(".err-msg").text(data.message);
          $(".err-div").fadeIn();
          $(".scss-div").fadeOut();
        }
      },
      error: function (textStatus, errorThrown) {
        $(".err-msg").text("Somthing went wrong!");
        $(".err-div").fadeIn();
        $(".scss-div").fadeOut();
      },
    });
  });
});
