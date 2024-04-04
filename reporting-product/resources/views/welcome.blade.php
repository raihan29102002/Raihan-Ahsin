<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporting Product</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Tambahkan script DateRangePicker -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- Tambahkan script Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://pivottable.js.org/dist/pivot.css">
    <script type="text/javascript" src="https://pivottable.js.org/dist/pivot.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Reporting Product</h1>
        <form>
            <div class="form-group">
                <label for="date-range">Date Range:</label>
                <input type="text" id="date-range" name="date_range" class="form-control">
            </div>

            <div class="form-group">
                <label for="product-select">Select Product:</label>
                <select id="product-select" class="form-control product-select" multiple>
                    <option value="product1">Product 1</option>
                    <option value="product2">Product 2</option>
                    <option value="product3">Product 3</option>
                </select>
            </div>

            <button type="button" id="filter-button" class="btn btn-primary">Filter</button>
        </form>

        <!-- Tambahkan bagian untuk menampilkan statistik executive summary -->
        <div class="mt-5">
            <h2>Executive Summary</h2>
            <!-- Tambahkan elemen untuk menampilkan statistik -->
            <canvas id="executive-summary-chart"></canvas>
        </div>

        <!-- Tambahkan bagian untuk menampilkan pivot table -->
        <div class="mt-5">
            <h2>What-if Analysis</h2>
            <div id="output"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
    $(document).ready(function() {
        // Inisialisasi DateRangePicker
        $('#date-range').daterangepicker();

        // Inisialisasi Select2
        $('.product-select').select2();

        // Tombol Filter Click Event
        $('#filter-button').click(function(event) {
            event.preventDefault();
            console.log('Date Range:', $('#date-range').val());
            console.log('Selected Products:', $('#product-select').val());
            // Lakukan pemrosesan data berdasarkan tanggal dan produk yang dipilih
        });
        // Data contoh untuk Executive Summary Chart
        var executiveSummaryData = {
            labels: ['Product 1', 'Product 2', 'Product 3'],
            datasets: [{
                label: 'Sales',
                data: [100, 200, 300],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Inisialisasi dan tampilkan grafik Executive Summary
        var executiveSummaryChart = new Chart(document.getElementById('executive-summary-chart'), {
            type: 'bar',
            data: executiveSummaryData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // Data contoh untuk Chart.js
        var salesData = [{
                date: '2024-01-01',
                product: 'Product 1',
                sales: 100
            },
            {
                date: '2024-01-02',
                product: 'Product 2',
                sales: 150
            },
            {
                date: '2024-01-03',
                product: 'Product 3',
                sales: 200
            },
            {
                date: '2024-01-04',
                product: 'Product 1',
                sales: 120
            },
            {
                date: '2024-01-05',
                product: 'Product 2',
                sales: 180
            },
            {
                date: '2024-01-06',
                product: 'Product 3',
                sales: 220
            },
        ];

        $(document).ready(function() {
            var salesData = [{
                    date: '2024-01-01',
                    product: 'Product 1',
                    sales: 100
                },
                {
                    date: '2024-01-02',
                    product: 'Product 2',
                    sales: 150
                },
                {
                    date: '2024-01-03',
                    product: 'Product 3',
                    sales: 200
                },
                {
                    date: '2024-01-04',
                    product: 'Product 1',
                    sales: 120
                },
                {
                    date: '2024-01-05',
                    product: 'Product 2',
                    sales: 180
                },
                {
                    date: '2024-01-06',
                    product: 'Product 3',
                    sales: 220
                }
            ];

            // Konversi data ke dalam format yang diterima oleh Pivot.js
            var pivotData = [];
            salesData.forEach(function(entry) {
                pivotData.push([entry.date, entry.product, entry.sales]);
            });

            // Inisialisasi pivot table dengan data yang telah diubah
            $("#output").pivot(pivotData, {
                rows: ["date"],
                cols: ["product"],
                aggregatorName: "Sum",
                vals: ["sales"]
            });
        });


        var pivotTable = new PivotTable({
            target: '#pivot-table',
            data: pivotData
        });

        // Data untuk filter tanggal
        var dates = salesData.map(function(entry) {
            return entry.date;
        });

        // Data contoh untuk Chart.js
        var chartLabels = dates.filter(function(date, index, self) {
            return self.indexOf(date) === index;
        });

        var productSalesData = [];
        chartLabels.forEach(function(label) {
            var sales = 0;
            salesData.forEach(function(entry) {
                if (entry.date === label) {
                    sales += entry.sales;
                }
            });
            productSalesData.push(sales);
        });

        var executiveSummaryChart = new Chart(document.getElementById('executive-summary-chart'), {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Sales',
                    data: productSalesData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
    });
    </script>
</body>

</html>