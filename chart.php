<?php
// db_connect.php
$conn = new mysqli('localhost', 'root', '', 'wholesales');
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Fetch inventory data from the database
$product = $conn->query("SELECT * FROM product_list r order by name asc");
$report_data = array();
while($row = $product->fetch_assoc()) {
    $inn = $conn->query("SELECT sum(qty) as inn FROM inventory where type = 1 and product_id = ".$row['id']);
    $inn = $inn && $inn->num_rows > 0 ? $inn->fetch_array()['inn'] : 0;
    $out = $conn->query("SELECT sum(qty) as `out` FROM inventory where type = 2 and product_id = ".$row['id']);
    $out = $out && $out->num_rows > 0 ? $out->fetch_array()['out'] : 0;

    $ex = $conn->query("SELECT sum(qty) as ex FROM expired_product where product_id = ".$row['id']);
    $ex = $ex && $ex->num_rows > 0 ? $ex->fetch_array()['ex'] : 0;

    $available = $inn - $out - $ex;
    
    // Store data for each product
    $report_data[] = array(
        'Product Name' => $row['name'] . ' ' . $row['measurement'],
        'Stock In' => $inn > 0 ? $inn : 0,
        'Stock Out' => $out > 0 ? $out : 0,
        'Expired' => $ex > 0 ? $ex : 0,
        'Stock Available' => $available
    );
}

// Close database connection
$conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <link rel="stylesheet" href="">
    <style>
        Copy code
/* styles.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.chat {
    max-width: 800px;
    margin: 50px auto;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

#chart-container {
    border: 1px solid #ccc;
    padding: 20px;
}
    </style>
</head>
<body>
    <div class="chat">
        <h1>Inventory Report</h1>
        <div id="chart-container"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script >
        // script.js
document.addEventListener("DOMContentLoaded", function() {
    // Data from PHP
    var reportData = <?php echo json_encode($report_data); ?>;

    // Extracting data for chart
    var categories = reportData.map(item => item['Product Name']);
    var stockIn = reportData.map(item => item['Stock In']);
    var stockOut = reportData.map(item => item['Stock Out']);
    var expired = reportData.map(item => item['Expired']);
    var stockAvailable = reportData.map(item => item['Stock Available']);

    // Chart options
    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Stock In',
            data: stockIn
        }, {
            name: 'Stock Out',
            data: stockOut
        }, {
            name: 'Expired',
            data: expired
        }, {
            name: 'Stock Available',
            data: stockAvailable
        }],
        xaxis: {
            categories: categories
        },
        yaxis: {
            title: {
                text: 'Quantity'
            }
        },
        legend: {
            position: 'bottom'
        }
    };

    // Generate chart
    var chart = new ApexCharts(document.querySelector("#chart-container"), options);
    chart.render();
});

    </script>
</body>
</html>
