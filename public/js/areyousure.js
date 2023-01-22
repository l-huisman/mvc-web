var deleteBtn;
var areYouSureBtn;
var backBtn;

function areYouSure() {
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

function back() {
    //remove the two added buttons
    deleteBtn.classList.remove("d-none");
    areYouSureBtn.remove();
    backBtn.remove();
}
