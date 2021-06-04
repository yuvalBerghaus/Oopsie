let userList = [];
let carsList = [];
window.onload = () => {
    document.getElementById("addUserButton").addEventListener("click", () => {
        let userName = document.getElementById("username").value;
        let selectedPermission = document.getElementById("sel1").value;
        let selectedCategory = document.getElementById("selectedCategory").value;
        var myHash = {}; // New object
        myHash['user_name'] = userName;
        myHash['Permission'] = selectedPermission;
        myHash['category'] = selectedCategory;
        userList.push(myHash);
        let table = [userName, selectedPermission, selectedCategory];
        list(table, "addedUsers");
        // console.log(userList);
        console.log(JSON.stringify(userList));
    }
    );
    document.getElementById("addCarButton").addEventListener("click", () => {
        let carModel = document.getElementById("carModel").value;
        let plateNum = document.getElementById("plateNum").value;
        var myHash = {}; // New object
        myHash['car_model'] = carModel;
        myHash['plate_number'] = plateNum;
        carsList.push(myHash);
        let table = [carModel, plateNum];
        list(table, "addedCars");
        console.log(JSON.stringify(carsList));
        // console.log(carsList);
    }
    );
}
let list = (readyList, addTo) => {
    let td = "";
    for (let data of readyList)
        td += `<td>${data}</td>`;
    document.getElementById(addTo).innerHTML += `<tr>
        ${td}
    </tr>`;
}

let addToSubmit = (table, type) => {
    (type == "user") ? userList.push(table) : carsList.push(table);
}



/* <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
<div class="card-header">${userName} was added to the list!</div>
<div class="card-body">
    <p class="card-text">Permission: ${selectedPermission}</p>
    <p class="card-text">Category: ${selectedCategory}</p>
</div>
</div> */