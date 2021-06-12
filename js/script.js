let userList = [];
let carsList = [];
window.onload = () => {
    document.getElementById("addUserButton").addEventListener("click", () => {
        let userName = document.getElementById("username").value;
        let selectedPermission = document.getElementById("sel1").value;
        let selectedCategory = document.getElementById("selectedCategory").value;
        var myHash = {}; // New object
        myHash['user_name'] = userName;
        myHash['permission'] = selectedPermission;
        myHash['category'] = selectedCategory;
        userList.push(myHash);
        let table = [userName, selectedPermission, selectedCategory];
        list(table, "addedUsers");
        // console.log(userList);
        saveFile(userList, "userData");
    }
    );
    document.getElementById("addCarButton").addEventListener("click", () => {
        let carBrand = document.getElementById("carBrand").value;
        let plateNum = document.getElementById("plateNum").value;
        let myHash = {}; // New object
        myHash['car_brand'] = carBrand;
        myHash['plate_number'] = plateNum;
        carsList.push(myHash);
        let table = [carBrand, plateNum];
        list(table, "addedCars");
        saveFile(carsList, "carData");
    }
    );
    document.getElementById("clearCarsInput").addEventListener("click", () => {
        document.getElementById("carBrand").value = "";
        document.getElementById("plateNum").value = "";
    }
    );
}

let deleteTr = (toDelete) => {
    let elem = document.getElementById(toDelete);
    return elem.parentNode.removeChild(elem);
}

let list = (readyList, addTo) => {
    let td = "";
    for (let data of readyList) {
        td += `<td>${data}</td>`;
    }
    document.getElementById(addTo).innerHTML += `<tr id="${readyList[1]}">
        ${td}
        <td>
        <button onclick="deleteTr('${readyList[1]}')" style="border:0px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>

</button>
</td>
        </tr>`
};
let saveFile = (proj, id) => {
    document.getElementById(id).value = JSON.stringify(proj);
}