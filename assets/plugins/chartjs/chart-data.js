document.addEventListener("DOMContentLoaded", function () {

    function loadSalesPurchaseChart(year) {
        fetch('fetch_chart_data.php?year=' + year)
            .then(response => response.json())
            .then(data => {
                // ==== Sales & Purchase Chart ====
                var ctx1 = document.getElementById('sales_purchase_charts').getContext('2d');
                if (window.salesPurchaseChart) {
                    window.salesPurchaseChart.destroy();
                }
                window.salesPurchaseChart = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [
                            {
                                label: 'Sales',
                                data: data.sales,
                                backgroundColor: '#28C76F'
                            },
                            {
                                label: 'Purchase',
                                data: data.purchase,
                                backgroundColor: '#EA5455'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                stacked: false
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    padding: 20
                                }
                            }
                        }
                    }
                });
            });
    }

    function loadTopProductChart() {
        fetch('fetch_chart_data.php') // No year param needed if data is static
            .then(response => response.json())
            .then(data => {
                var ctx2 = document.getElementById('top_product').getContext('2d');
                window.topProductChart = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: data.top_products_labels,
                        datasets: [{
                            data: data.top_products_data,
                            backgroundColor: ['#28C76F', '#EA5455', '#FF9F43', '#7367F0', '#1E9FF2'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '60%',
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
    }

    // Load charts on page load
    const currentYear = new Date().getFullYear();
    loadSalesPurchaseChart(currentYear); // Year-wise Sales & Purchase chart
    loadTopProductChart(); // Load Top Product chart only once!

    // Year change event
    document.querySelectorAll('.year-option').forEach(item => {
        item.addEventListener('click', function () {
            let selectedYear = this.getAttribute('data-year');
            document.getElementById('selectedYear').innerText = selectedYear;
            loadSalesPurchaseChart(selectedYear); // Only reload Sales & Purchase chart
        });
    });

});