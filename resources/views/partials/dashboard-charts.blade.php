<div class="bg-white rounded-lg shadow p-4 mt-6 max-w-4xl mx-auto">
  <h3 class="text-lg font-bold mb-3 text-gray-700 flex items-center">
    <i class="fas fa-chart-bar text-blue-500 mr-2"></i>
    Select Data to Display
  </h3>
  <div class="mb-3">
    <select id="chartTypeSelect" class="border rounded px-2 py-1 text-sm focus:outline-none focus:ring w-full md:w-56">
      <option value="visitors">Visitors</option>
      <option value="reservations">Reservations</option>
      <option value="cars">Cars</option>
      <option value="reviews">Reviews</option>
      <option value="contacts">Contact Messages</option>
    </select>
  </div>
  <canvas id="dashboardChart" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const chartData = {
    visitors: {
      labels: {!! json_encode($visitorsLabels ?? ["Jan","Feb","Mar","Apr","May"]) !!},
      data: {!! json_encode($visitorsData ?? [20, 35, 40, 25, 30]) !!},
      label: 'Visitors',
      bgColor: 'rgba(139, 92, 246, 0.7)',
      borderColor: 'rgba(139, 92, 246, 1)'
    },
    reservations: {
      labels: {!! json_encode($reservationsLabels ?? ["Jan","Feb","Mar","Apr","May"]) !!},
      data: {!! json_encode($reservationsData ?? [5, 12, 8, 15, 10]) !!},
      label: 'Reservations',
      bgColor: 'rgba(34, 197, 94, 0.7)',
      borderColor: 'rgba(34, 197, 94, 1)'
    },
    cars: {
      labels: {!! json_encode($carsLabels ?? ["Jan","Feb","Mar","Apr","May"]) !!},
      data: {!! json_encode($carsData ?? [2, 4, 3, 5, 6]) !!},
      label: 'New Cars',
      bgColor: 'rgba(59, 130, 246, 0.7)',
      borderColor: 'rgba(59, 130, 246, 1)'
    },
    reviews: {
      labels: {!! json_encode($reviewsLabels ?? ["Jan","Feb","Mar","Apr","May"]) !!},
      data: {!! json_encode($reviewsData ?? [1, 3, 2, 4, 5]) !!},
      label: 'Reviews',
      bgColor: 'rgba(253, 224, 71, 0.7)',
      borderColor: 'rgba(253, 224, 71, 1)'
    },
    contacts: {
      labels: {!! json_encode($contactsLabels ?? ["Jan","Feb","Mar","Apr","May"]) !!},
      data: {!! json_encode($contactsData ?? [0, 1, 2, 1, 3]) !!},
      label: 'Contact Messages',
      bgColor: 'rgba(239, 68, 68, 0.7)',
      borderColor: 'rgba(239, 68, 68, 1)'
    }
  };

  let chartInstance = null;

  function renderChart(type) {
    const data = chartData[type];
    if (chartInstance) chartInstance.destroy();
    chartInstance = new Chart(document.getElementById('dashboardChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: data.labels,
        datasets: [{
          label: data.label,
          data: data.data,
          backgroundColor: data.bgColor,
          borderColor: data.borderColor,
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1, font: { size: 18 } }
          },
          x: {
            ticks: { font: { size: 18 } }
          }
        }
      }
    });
  }

  document.getElementById('chartTypeSelect').addEventListener('change', function() {
    renderChart(this.value);
  });

  // Initial chart
  renderChart('visitors');
</script>
