var deleteBtn;
var areYouSureBtn;
var backBtn;

function areYouSure() {
    // This function is for 2 separate buttons on different pages so we need to check which one is being used
    if (document.getElementById("delete")) {

        deleteBtn = document.getElementById("delete");
        deleteBtn.classList.add("d-none");

        areYouSureBtn = document.createElement("button");
        areYouSureBtn.innerHTML = "Delete";
        areYouSureBtn.setAttribute("id", "areYouSure");
        areYouSureBtn.setAttribute("class", "btn btn-danger mx-1 mt-3");
        areYouSureBtn.setAttribute("type", "submit");
        areYouSureBtn.setAttribute("name", "delete");
        areYouSureBtn.setAttribute("form", "campaignForm");

        deleteBtn.parentNode.insertBefore(areYouSureBtn, deleteBtn.nextSibling);

        backBtn = document.createElement("button");
        backBtn.innerHTML = "Back";
        backBtn.setAttribute("id", "back");
        backBtn.setAttribute("class", "btn  btn-outline-light mx-1 mt-3");
        backBtn.setAttribute("type", "button");
        backBtn.addEventListener("click", back);
        backBtn.setAttribute("name", "back");
        deleteBtn.parentNode.insertBefore(backBtn, deleteBtn.nextSibling);
    }
    else if (document.getElementById("leave")) {
        deleteBtn = document.getElementById("leave");
        deleteBtn.classList.add("d-none");

        areYouSureBtn = document.createElement("button");
        areYouSureBtn.innerHTML = "Leave";
        areYouSureBtn.setAttribute("id", "areYouSure");
        areYouSureBtn.setAttribute("class", "btn btn-danger mx-1 mt-3");
        areYouSureBtn.setAttribute("type", "submit");
        areYouSureBtn.setAttribute("name", "leave");
        areYouSureBtn.setAttribute("form", "campaignForm");

        deleteBtn.parentNode.insertBefore(areYouSureBtn, deleteBtn.nextSibling);

        backBtn = document.createElement("button");
        backBtn.innerHTML = "Back";
        backBtn.setAttribute("id", "back");
        backBtn.setAttribute("class", "btn  btn-outline-light mx-1 mt-3");
        backBtn.setAttribute("type", "button");
        backBtn.addEventListener("click", back);
        backBtn.setAttribute("name", "back");
        deleteBtn.parentNode.insertBefore(backBtn, deleteBtn.nextSibling);
    }
}

function back() {
    if (document.getElementById("delete")) {
        deleteBtn = document.getElementById("delete");
        deleteBtn.classList.remove("d-none");
        areYouSureBtn = document.getElementById("areYouSure");
        areYouSureBtn.parentNode.removeChild(areYouSureBtn);
        backBtn = document.getElementById("back");
        backBtn.parentNode.removeChild(backBtn);
    }
    else if (document.getElementById("leave")) {
        deleteBtn = document.getElementById("leave");
        deleteBtn.classList.remove("d-none");
        areYouSureBtn = document.getElementById("areYouSure");
        areYouSureBtn.parentNode.removeChild(areYouSureBtn);
        backBtn = document.getElementById("back");
        backBtn.parentNode.removeChild(backBtn);
    }
}

