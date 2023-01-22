// Get the form element
var form = document.getElementById("availability-form");
// Add a submit event listener to the form
form.addEventListener("submit", function (event) {
    event.preventDefault(); // prevent the form from submitting
    // Get the selected timeblocks
    // Get the selected timeblocks
    var selectedTimeblocks = [];
    var rows = calendar.rows;
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].cells;
        for (var j = 1; j < cells.length; j++) {
            if (cells[j].style.backgroundColor === "lightblue") {
                var date = currentWeek[j - 1].toJSON().slice(0, 10);
                selectedTimeblocks.push({
                    date: date,
                    time: cells[0].innerHTML
                });
            }
        }
    }
    // Convert the selected timeblocks to a JSON object
    var data = JSON.stringify({
        timeblocks: selectedTimeblocks
    });
    // Get the selected-data div
    var selectedData = document.getElementById("selected-data");
    // update it's innerHTML
    selectedData.innerHTML = data;
    // Send a POST request to the server with the selected data
    fetch("SessionService.php", {
        method: "POST",
        body: data,
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(response => response.text())
        .then(result => {
            console.log(result);
        })
        .catch(error => {
            console.error("Error:", error);
        });
});
