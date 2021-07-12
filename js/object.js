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
        return false;
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
        return false;
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
                alert(result);
            }
        })
        return false;
    })
});