window.onload = () => {
    parkingObj = document.getElementsByClassName("parkingObject");
    for (let i = 0; i < parkingObj.length; i++) {
        parkingObj[i].addEventListener("click", () => {
            window.location.href = `objectPage.php?id=${parkingObj[i].id}`;
        })

    }
}