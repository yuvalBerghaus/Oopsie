$(function () {
    $('#myFormName').on('submit',function (e) {

              $.ajax({
                type: 'post',
                url: 'myPageName.php',
                data: $('#myFormName').serialize(),
                success: function () {
                 alert("Email has been sent!");
                }
              });
          e.preventDefault();
        });
});
$(document).ready(function () {
    $("#deleteCars").submit(function (e) {
        let formData = {
            "carID": $(document.activeElement).val()
        };
        $.ajax({
            url: "delete.php",
            type: "post",
            data: formData,
            success: function (result) {
                $("#target").html(result);
            }
        })
        e.preventDefault();
    })
    $("#deleteUsers").submit(function (e) {
        let formData = {
            "memberID": $(document.activeElement).val()
        };
        console.log($(document.activeElement).val())
        $.ajax({
            url: "delete.php",
            type: "post",
            data: formData,
            success: function (result) {
                $("#deleteUsers").html(result);
            }
        })
        e.preventDefault();
    })
});