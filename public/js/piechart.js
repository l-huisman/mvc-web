var ctx = document.getElementById('payingCustomerChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Sheduled players', 'Non-scheduled players'],
        datasets: [{
            label: ' number of players',
            data: [2, 3],
            backgroundColor: [
                'rgba(127, 57, 251, 1)',
                'rgba(207, 102, 121, 1)'
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom',
            labels: {
                fontColor: 'white',
                fontSize: 12,
                boxWidth: 12
            }
        }
    }
});