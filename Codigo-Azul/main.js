const pieCtx = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Urgencias', 'Cirugía', 'Pediatría', 'Maternidad', 'Terapia Intensiva'],
        datasets: [{
            data: [7, 15, 18, 8, 12],
            backgroundColor: [
                '#e74c3c',
                '#3498db',
                '#2ecc71',
                '#9b59b6',
                '#f39c12'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right'
            }
        }
    }
});

const barCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
        datasets: [{
            label: 'Ingresos',
            data: [12, 19, 8, 15, 10, 22, 18],
            backgroundColor: '#3498db',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

document.querySelector('.alarm-btn').addEventListener('click', function(e) {
    e.preventDefault();
    alert('¡Alerta activada! El personal ha sido notificado.');
});