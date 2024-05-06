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
        'Product Name' => $row['name'],
        'Stock In' => $inn > 0 ? $inn : 0,
        'Stock Out' => $out > 0 ? $out : 0,
        'Expired' => $ex > 0 ? $ex : 0,
        'Stock Available' => $available
    );
}

// Generate CSV file
$filename = 'inventory_report.csv';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='.$filename);
$output = fopen('php://output', 'w');
fputcsv($output, array('Product Name', 'Stock In', 'Stock Out', 'Expired', 'Stock Available'));
foreach ($report_data as $row) {
    fputcsv($output, $row);
}
fclose($output);
?>
