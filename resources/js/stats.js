import Chart from 'chart.js/auto';
const ctx = document.getElementById('myChart');

console.log(labels)
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Votes',
            data: views,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

console.log(window.sessionStorage)