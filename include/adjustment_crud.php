<?php
include('../db_connection.php'); 

if (isset($_POST['add_adjustment'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['stock_search']);
    $quantity = (int)$_POST['quantity'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $notes = mysqli_real_escape_string($conn, $_POST['adjustment-notes']);

    // Fetch product ID and current stock
    $product_query = "SELECT id, quantity FROM products WHERE name = '$product_name'";
    $product_result = mysqli_query($conn, $product_query);
    
    if (mysqli_num_rows($product_result) > 0) {
        $product = mysqli_fetch_assoc($product_result);
        $product_id = $product['id'];
        $current_stock = $product['quantity'];

        // Adjust stock based on status (Add or Subtract)
        if ($status == "Add") {
            $new_stock = $current_stock + $quantity;
        } else {
            $new_stock = max(0, $current_stock - $quantity); // Prevent negative stock
        }

        // Insert into stock_adjustments table
        $insert_query = "INSERT INTO stock_adjustments (product_id, product_name, current_stock, ad_quantity, status, notes)
                         VALUES ('$product_id', '$product_name', '$current_stock', '$quantity', '$status', '$notes')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            // Update the stock in the products table
            $update_product_query = "UPDATE products SET quantity = '$new_stock' WHERE id = '$product_id'";
            mysqli_query($conn, $update_product_query);

            header("Location: ../admin/adjustment/stock-adjustment-list.php?msg=success");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Product not found!";
    }
}
elseif (isset($_POST['update_adjustment'])) {
    $adjustment_id = isset($_POST['adjustment_id']) ? (int)$_POST['adjustment_id'] : null;
    $product_name = mysqli_real_escape_string($conn, $_POST['stock_search']);
    $quantity = (int)$_POST['quantity'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $notes = mysqli_real_escape_string($conn, $_POST['adjustment-notes']);
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;

    // Check if product ID is valid
    if (!$product_id) {
        echo "Error: Invalid product selection.";
        exit();
    }

    // Fetch product quantity
    $product_query = "SELECT id, quantity FROM products WHERE id = '$product_id'";
    $product_result = mysqli_query($conn, $product_query);

    if ($product_result && mysqli_num_rows($product_result) > 0) {
        $product = mysqli_fetch_assoc($product_result);
        $current_stock = (int)$product['quantity'];

        // Adjust stock based on status (Add or Subtract)
        $new_stock = ($status == "Add") ? ($current_stock + $quantity) : max(0, $current_stock - $quantity);

        // Insert adjustment record
        $insert_query = "INSERT INTO stock_adjustments (product_id, product_name, current_stock, ad_quantity, status, notes)
                         VALUES ('$product_id', '$product_name', '$current_stock', '$quantity', '$status', '$notes')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            // Update stock in products table
            $update_product_query = "UPDATE products SET quantity = '$new_stock' WHERE id = '$product_id'";
            mysqli_query($conn, $update_product_query);
            header("Location: ../admin/adjustment/stock-adjustment-list.php?msg=updated");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Product not found!";
    }
}