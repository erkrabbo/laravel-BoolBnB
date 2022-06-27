import Chart from 'chart.js/auto';
const ctx = document.getElementById('myChart');

console.log(labels)
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '#Numero visualizzazioni',
            data: views,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: false,
                }
            },
            x: {
                grid: {
                    display: false,
                }
            }
        }
    }
});
