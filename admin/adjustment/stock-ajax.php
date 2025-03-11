<?php include('../../db_connection.php');

if (isset($_POST['search'])) {
    $search = trim($_POST['search']);
    $query = "SELECT name, quantity
        FROM products
        WHERE name LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $quantity = $row['quantity'];

            echo "<li onclick='fill(\"$name\" , \"$quantity\")'>$name</li>";
        }
    } else {
        echo "<li>No products found</li>";
    }
}

?>