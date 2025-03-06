<?php include('../../db_connection.php');

if (isset($_POST['search'])) {
    $search = trim($_POST['search']);
    $query = "SELECT p.name, p.price, t.tax_rate 
        FROM products p LEFT JOIN tax_rates t ON p.tax_id = t.id 
        WHERE p.name LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $price = $row['price'];
            $tax = isset($row['tax_rate']) ? $row['tax_rate'] : 0; 

            echo "<li onclick='fill(\"$name\", \"$price\", \"$tax\")'>$name - $$price</li>";
        }
    } else {
        echo "<li>No products found</li>";
    }
}

?>