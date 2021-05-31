let memArr = [];
window.onload = function () {
    document.getElementById("addUserButton").addEventListener("click", function () {
        console.log("fdsfsdf");
        let userName = document.getElementById("username").value;
        let selectedPermission = document.getElementById("sel1").value;
        let selectedCategory = document.getElementById("selectedCategory").value;
        // document.getElementById("userList").innerHTML += `Permission: ${selectedPermission}<br>Category: ${selectedCategory}<br>Username: ${userName}`
        document.getElementById("addedUsers").innerHTML += `
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">${userName} was added to the list!</div>
        <div class="card-body">
            <p class="card-text">Permission: ${selectedPermission}</p>
            <p class="card-text">Category: ${selectedCategory}</p>
        </div>
    </div>
        `
    });
    document.getElementById("clearAddUser").addEventListener("click", function () {
        console.log("fdsfsdf");
        document.getElementById("username") = "";
    });

}