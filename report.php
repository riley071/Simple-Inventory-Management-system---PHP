<?php include 'db_connect.php' ?>
<?php 
include 'db_connect.php';

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
?>


<div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><b>Report</b></h4>
                            <a href="generate_report.php" class="btn btn-primary">Generate CSV Report</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Stock In</th>
                                    <th class="text-center">Stock Out</th>
                                    <th class="text-center">Expired</th>
                                    <th class="text-center">Stock Available</th>
                                </thead>
                                <tbody>
                                <?php 
                                    $i = 1;
                                    foreach ($report_data as $row):
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class=""><?php echo $row['Product Name'] ?></td>
                                        <td class="text-right"><?php echo $row['Stock In'] ?></td>
                                        <td class="text-right"><?php echo $row['Stock Out'] ?></td>
                                        <td class="text-right"><?php echo $row['Expired'] ?></td>
                                        <td class="text-right"><?php echo $row['Stock Available'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chat">
    <h1>Inventory Report</h1>
    <div id="chart-container"></div>

    <!-- Reference locally hosted ApexCharts library -->
    <script src="assets/js/apexcharts.min.js"></script>

    <script>
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
</div>
