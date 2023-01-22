// Get the calendar table element
var calendar = document.getElementById("calendar");
calendar.style.padding = "3px";

// Create table headers
var headerRow = document.createElement("tr");
var timeHeader = document.createElement("th");
timeHeader.innerHTML = "Time";
timeHeader.style.width = "100px";
headerRow.appendChild(timeHeader);

//get current date
var today = new Date();
var currentWeek = [];
//get the start of the week
var start = today.getDate() - today.getDay();

//get the end of the week
var end = start + 6;

//create a new date object for each day of the week
for (var i = start; i <= end; i++) {
    currentWeek.push(new Date(today.setDate(i)));
}

for (var i = 0; i < currentWeek.length; i++) {
    var dayHeader = document.createElement("th");
    var day = currentWeek[i].getDate();
    var month = currentWeek[i].getMonth() + 1;
    var year = currentWeek[i].getFullYear();
    dayHeader.innerHTML = day + "/" + month;
    dayHeader.style.textAlign = "center";
    headerRow.appendChild(dayHeader);
}
calendar.appendChild(headerRow);

// Create table rows for each hour
for (var hour = 9; hour <= 24; hour++) {
    var row = document.createElement("tr");
    var timeCell = document.createElement("td");
    timeCell.innerHTML = hour + ":00";
    timeCell.style.padding = "4px";
    row.appendChild(timeCell);
    for (var i = 0; i < currentWeek.length; i++) {
        var dayCell = document.createElement("td");
        dayCell.style.border = "1px solid white";
        dayCell.style.width = "100px";
        dayCell.style.padding = "5px";
        dayCell.onclick = function () {
            var cells = getCells(this);
            if (cells.every(cell => cell.style.backgroundColor !== "lightblue")) {
                cells.forEach(cell => cell.style.backgroundColor = "lightblue");
                cells[0].setAttribute("rowspan", "4");
                for (var j = 1; j < cells.length; j++) {
                    cells[j].style.display = "none";
                }
            } else {
                cells.forEach(cell => cell.style.backgroundColor = "");
                cells[0].removeAttribute("rowspan");
                for (var j = 1; j < cells.length; j++) {
                    cells[j].style.display = "";
                }
            }
        }
        row.appendChild(dayCell);
    }
    calendar.appendChild(row);
}

function getCells(cell) {
    var cells = [];
    var row = cell.parentNode;
    var rowIndex = row.rowIndex;
    var colIndex = cell.cellIndex;
    for (var i = 0; i < 4; i++) {
        var currentRow = calendar.rows[rowIndex + i];
        if (currentRow) {
            var currentCell = currentRow.cells[colIndex];
            cells.push(currentCell);
        }
    }
    return cells;
}