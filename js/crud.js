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
                $("#carsTableList").html(result);
                console.log(result);
            }
        })
        return false;
    })
    // $(".blah:eq(i)")
    // for (let i = 0; i < $(".blah")) { }
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
                $("#userTableList").html(result);
                console.log(result);
            }
        })
        return false;
    })
    $("#updateUser").submit(function () {
        let formData = {
            "u2pID": $(document.activeElement).val(),
            "selectedPermission": $('#selectedPermission').val(),
            "selectedCategory": $('#selectedCategory').val(),
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
    $("#updateExistingParking").submit(function () {
        let formData = {
            "parkingID": $(document.activeElement).val(),
            // "selectedPermission": $('#selectedPermission').val(),
            // "selectedCategory": $('#selectedCategory').val(),
            "userData": $('#userData').val(),
            "carData": $('#carData').val(),
        };
        console.log(formData);
        $.ajax({
            url: "./addToExisting.php",
            type: "post",
            data: formData,
            success: function (result) {
            }
        })
    })
});