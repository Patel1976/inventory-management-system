<?php include('../../db_connection.php');

if (isset($_POST['search'])) {
    // Fetch active currency symbol from the database
    $currency = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
    $currency_result = mysqli_query($conn, $currency);
    $row_currency = mysqli_fetch_assoc($currency_result);
    $currencySymbol = $row_currency['currency_symbol'] ?? '$';
    $search = trim($_POST['search']);
    $query = "SELECT name, price
        FROM products
        WHERE name LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $price = $row['price'];

            echo "<li onclick='fillProduct(\"$name\", \"$price\", \"$currencySymbol\")'>$name - $currencySymbol$price</li>";
        }
    } else {
        echo "<li>No products found</li>";
    }
}

?>