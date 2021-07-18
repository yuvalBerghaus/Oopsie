$(document).ready(function () {
    $("#deleteCars").submit(function () {
        let formData = {
            "cTpID": $(document.activeElement).val()
        };
        $.ajax({
            url: "delete.php",
            type: "post",
            data: formData,
            success: function (result) {
                $("#carsTableList").html(result);
            }
        })
        return false;
    })
    // $(".blah:eq(i)")
    // for (let i = 0; i < $(".blah")) { }
    $("#deleteUser").submit(function () {
        let formData = {
            "userstoparking_id": $(document.activeElement).val()
        };
        $.ajax({
            url: "./delete.php",
            type: "post",
            data: formData,
            success: function (result) {
                $("#userTableList").html(result);
            }
        })
        return false;
    })
    $("#updateUser").submit(function () {
        let uTpID = $(document.activeElement).val();
        let formData = {
            "u2pID": $(document.activeElement).val(),
            "selectedPermission": $(`#${uTpID}Permission`).val(),
            "selectedCategory": $(`#${uTpID}Category`).val(),
        };
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