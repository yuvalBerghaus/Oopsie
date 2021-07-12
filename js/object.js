// $(function () {
//     $('#myFormName').on('submit', function (e) {

//         $.ajax({
//             type: 'post',
//             url: 'myPageName.php',
//             data: $('#myFormName').serialize(),
//             success: function () {
//                 alert("Email has been sent!");
//             }
//         });
//         e.preventDefault();
//     });
// });
$(document).ready(function () {
    $("#deleteCars").submit(function () {
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
    })
    $("#deleteUsers").submit(function () {
        let formData = {
            "memberID": $(document.activeElement).val()
        };
        console.log($(document.activeElement).val())
        $.ajax({
            url: "./delete.php",
            type: "post",
            data: formData,
            success: function (result) {
                $("#deleteUsers").html(result);
            }
        })
    })
    $("#updateUser").submit(function () {
        let formData = {
            "u2pID": $(document.activeElement).val(),
            "selectedPermission": $('#selectedPermission').val(),
            "selectedCategory": $('#selectedCategory').val()
        };
        console.log(formData);
        $.ajax({
            url: "./update.php",
            type: "post",
            data: formData,
            success: function (result) {
            }
        })
    })
});