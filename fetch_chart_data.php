<?php
include('db_connection.php');

$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// ===== SALES =====
$sales_sql = "SELECT MONTH(STR_TO_DATE(order_date, '%d-%m-%Y')) AS month, SUM(total_amount) AS total_sales 
              FROM sales 
              WHERE YEAR(STR_TO_DATE(order_date, '%d-%m-%Y')) = '$year'
              GROUP BY MONTH(STR_TO_DATE(order_date, '%d-%m-%Y'))";
$sales_result = $conn->query($sales_sql);
$sales_data = array_fill(1, 12, 0);
while ($row = $sales_result->fetch_assoc()) {
    $sales_data[(int)$row['month']] = (float)$row['total_sales'];
}

// ===== PURCHASE =====
$purchase_sql = "SELECT MONTH(STR_TO_DATE(purchase_date, '%d-%m-%Y')) AS month, SUM(ptotal_amount) AS total_purchases 
                 FROM purchases 
                 WHERE YEAR(STR_TO_DATE(purchase_date, '%d-%m-%Y')) = '$year'
                 GROUP BY MONTH(STR_TO_DATE(purchase_date, '%d-%m-%Y'))";
$purchase_result = $conn->query($purchase_sql);
$purchase_data = array_fill(1, 12, 0);
while ($row = $purchase_result->fetch_assoc()) {
    $purchase_data[(int)$row['month']] = (float)$row['total_purchases'];
}

// ===== TOP PRODUCTS (Optional, can be by year if needed) =====
$top_products_sql = "SELECT product_name, SUM(qty) AS total_sold 
                     FROM sale_items 
                     GROUP BY product_name 
                     ORDER BY total_sold DESC 
                     LIMIT 5";
$top_products_result = $conn->query($top_products_sql);
$top_products_labels = [];
$top_products_data = [];
while ($row = $top_products_result->fetch_assoc()) {
    $top_products_labels[] = $row['product_name'];
    $top_products_data[] = (int)$row['total_sold'];
}

// ===== Return JSON =====
$data = [
    'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    'sales' => array_values($sales_data),
    'purchase' => array_values($purchase_data),
    'top_products_labels' => $top_products_labels,
    'top_products_data' => $top_products_data
];

header('Content-Type: application/json');
echo json_encode($data);
?>