let userList = [];
let carsList = [];
window.onload = () => {
    let pName = document.getElementById("pName"); // Parking name var
    document.getElementById("addUserButton").addEventListener("click", () => { // For each add User to list click
        let userName = document.getElementById("username").value;
        let selectedPermissions = document.getElementById("selectedPermissions").value;
        let selectedCategories = document.getElementById("selectedCategories").value;
        let myHash = {}; // New object
        userName.toLowerCase();
        selectedPermissions.toLowerCase();
        myHash['user_name'] = userName;
        myHash['permission'] = selectedPermissions;
        myHash['category'] = selectedCategories;
        userList.push(myHash);
        let table = [userName, selectedPermissions, selectedCategories];
        list(table, "addedUsers");
    }
    );
    //Auto complete From JSON
    let search = document.getElementById('carBrand');
    let matchList = document.getElementById('match-list');
    let searchStates = async searchText => {
        let res = await fetch('./json/cars.json');
        let states = await res.json();
        //Get matches to current text input
        let matches = states.filter(state => {
            let regex = new RegExp(`^${searchText}`, 'gi');
            return state.name.match(regex);
        });
        console.log(matches);
        outputHTML(matches);
        if (searchText.length === 0) {
            matches = []
            matchList.innerHTML = '';
            document.getElementById("match-list").style = "display:block;"
        }
    }
    let outputHTML = matches => {
        if (matches.length > 0) {
            let html = matches.map(match => `
                    <div onclick="autoCompleteClick('${match.name}')">${match.name}
                    <input type="hidden" value="${match.name}">
                    </div>
            `).join('');
            matchList.innerHTML = `${html}`;

        }
    }
    search.addEventListener('input', () => searchStates(search.value));
    //End of auto complete
    document.getElementById("addCarButton").addEventListener("click", () => {
        let carBrand = document.getElementById("carBrand").value;
        let plateNum = document.getElementById("plateNum").value;
        let myHash = {}; // New object
        myHash['carBrand'] = carBrand;
        myHash['plateNum'] = plateNum;
        carsList.push(myHash);
        let table = [carBrand, plateNum];
        list(table, "addedCars");
    }
    );
    document.getElementById("clearCarsInput").addEventListener("click", () => {
        document.getElementById("carBrand").value = "";
        document.getElementById("plateNum").value = "";
    }
    );
    document.getElementById("clearUserInput").addEventListener("click", () => {
        document.getElementById("username").value = "";
        console.log("read");
    }
    );
    if (pName != null) {
        pName.addEventListener('input', () => {
            let x = document.getElementsByClassName("displayParkingName");
            for (let i = 0; i < x.length; i++) {
                x[i].innerHTML = pName.value;
            }
        });
    }
}

let addMySelf = (mySelf) => {
    let myHash = {}; // New object
    myHash['user_name'] = mySelf;
    myHash['permission'] = "main";
    myHash['category'] = "me";
    userList.push(myHash);
}

let deleteFromList = (toDelete, addTo) => {
    let elem = document.getElementById(toDelete);
    if (addTo == "addedUsers") {
        for (let i in userList) {
            console.log(toDelete);
            if (userList[i]["user_name"] == toDelete) {
                userList.splice(i, 1);
            }
        }

    }
    else if (addTo == "addedCars") {
        for (let i in carsList) {
            console.log(toDelete);
            if (userList[i]["plateNum"] == toDelete) {
                carsList.splice(i, 1);
            }
        }
    }
    return elem.parentNode.removeChild(elem);
}

let list = (readyList, addTo) => {
    let td = "";
    let idPresent;
    for (let data of readyList) {
        td += `<td>${data}</td>`;
    }
    (addTo == "addedUsers") ? idPresent = readyList[0] : idPresent = readyList[1];
    document.getElementById(addTo).innerHTML += `<tr id="${idPresent}">
        ${td}
        <td>
        <button onclick="deleteFromList('${idPresent}', '${addTo}')" style="border:0px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
</button>
</td>
        </tr>`
};
saveFile = () => { // Put json data of the userList and carList to hidden input
    document.getElementById("userData").value = JSON.stringify(userList); // jsonize userList object
    document.getElementById("carData").value = JSON.stringify(carsList); // jsonize userL object
    console.log(document.getElementById("userData").value);
    console.log(document.getElementById("carData").value);
}

function autoCompleteClick(carBrand) {
    document.getElementById("carBrand").value = carBrand;
    document.getElementById("match-list").style = "display:none;"
}