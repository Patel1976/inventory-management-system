<?php
include('../db_connection.php'); 

if (isset($_POST['add_sale_return'])) {
    $return_invoice = $_POST['return_invoice'];
    $customer_id = $_POST['customer'];
    $return_date = $_POST['sale_return_date'];
    $sale_return_item_data = json_decode($_POST['sale_return_item_data'], true);
    $paid_payment = $_POST['sale-paid-payment'];
    $payment_type = $_POST['payment-type'];

    // Insert sale return record
    $insertReturnQuery = "INSERT INTO sale_return (return_invoice, customer_id, return_date, paid_payment, payment_type) 
                          VALUES ('$return_invoice', '$customer_id', '$return_date', '$paid_payment', '$payment_type')";
    
    if (mysqli_query($conn, $insertReturnQuery)) {
        $sale_return_id = mysqli_insert_id($conn);

        // Insert return items
        foreach ($sale_return_item_data as $item) {
            $product_name = $item['product_name']; 
            $quantity = $item['quantity']; 
            $unit_price = $item['unit_price']; 
            $discount = $item['discount'];  
            $tax = $item['tax']; 
            $subtotal = $item['subtotal']; 

            // Insert item into sale_return_items table
            $insertItemQuery = "INSERT INTO sale_return_items (sale_return_id, product_name, price, qty, discount, tax, subtotal) 
                                VALUES ('$sale_return_id', '$product_name', '$unit_price', '$quantity', '$discount', '$tax', '$subtotal')";
            mysqli_query($conn, $insertItemQuery);

            // Update stock in the products table (optional)
            $updateStockQuery = "UPDATE products SET quantity = quantity + '$quantity' WHERE name = '$product_name'";
            mysqli_query($conn, $updateStockQuery);
        }

        header("Location: ../admin/return/sale-return-list.php?msg=success");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error adding sale return.";
    }
}
elseif (isset($_POST['update_sale_return'])) {
    $sale_return_id = intval($_POST['sale_return_id']);
    $return_invoice = $_POST['return_invoice'];
    $customer_id = $_POST['customer'];
    $return_date = $_POST['sale_return_date'];
    $sale_return_item_data = json_decode($_POST['sale_return_item_data'], true);
    $paid_payment = $_POST['sale-paid-payment'];
    $payment_type = $_POST['payment-type'];

    // Update sale return record
    $updateReturnQuery = "UPDATE sale_return 
                          SET return_invoice = '$return_invoice', 
                              customer_id = '$customer_id', 
                              return_date = '$return_date', 
                              paid_payment = '$paid_payment', 
                              payment_type = '$payment_type' 
                          WHERE id = '$sale_return_id'";

    if (mysqli_query($conn, $updateReturnQuery)) {
        // Delete old sale return items
        $deleteItemsQuery = "DELETE FROM sale_return_items WHERE sale_return_id = '$sale_return_id'";
        mysqli_query($conn, $deleteItemsQuery);

        // Insert updated sale return items
        foreach ($sale_return_item_data as $item) {
            $product_name = $item['product_name'];
            $quantity = $item['quantity'];
            $unit_price = $item['unit_price'];
            $discount = $item['discount'];
            $tax = $item['tax'];
            $subtotal = $item['subtotal'];

            // Insert new item into sale_return_items table
            $insertItemQuery = "INSERT INTO sale_return_items (sale_return_id, product_name, price, qty, discount, tax, subtotal) 
                                VALUES ('$sale_return_id', '$product_name', '$unit_price', '$quantity', '$discount', '$tax', '$subtotal')";
            mysqli_query($conn, $insertItemQuery);
        }

        // Redirect to sale return list with success message
        header("Location: ../admin/return/sale-return-list.php?msg=updated");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error updating sale return.";
    }
}

// purchase return
if (isset($_POST['add_purchase_return'])) {
    $return_invoice = mysqli_real_escape_string($conn, $_POST['return_invoice']);
    $supplier_id = intval($_POST['customer']);
    $purchase_return_date = date('Y-m-d', strtotime($_POST['purchase_return_date']));
    $shipping = floatval($_POST['shipping']);
    $paid_payment = floatval($_POST['purchase-paid-payment']);
    $payment_type = intval($_POST['payment-type']);
    
    // Insert into purchase_returns table
    $query = "INSERT INTO purchase_returns (return_invoice, supplier_id, purchase_return_date, shipping, paid_payment, payment_type) 
              VALUES ('$return_invoice', '$supplier_id', '$purchase_return_date', '$shipping', '$paid_payment', '$payment_type')";

    if (mysqli_query($conn, $query)) {
        $purchase_return_id = mysqli_insert_id($conn);

        // Insert multiple items into purchase_return_items
        if (!empty($_POST['purchase_return_item_data'])) {
            $items = json_decode($_POST['purchase_return_item_data'], true);
            
            foreach ($items as $item) {
                $product_name = mysqli_real_escape_string($conn, $item['product_name']);  // Use product name
                $quantity = intval($item['quantity']);
                $unit_price = floatval($item['unit_price']);
                $discount = floatval($item['discount']);
                $tax = floatval($item['tax']);
                $subtotal = floatval($item['subtotal']);
        
                // Insert into purchase_return_items
                $item_query = "INSERT INTO purchase_return_items (purchase_return_id, product_name, quantity, unit_price, discount, tax, subtotal) 
                               VALUES ('$purchase_return_id', '$product_name', '$quantity', '$unit_price', '$discount', '$tax', '$subtotal')";
        
                mysqli_query($conn, $item_query);

                // Update stock in the products table
                $stock_update_query = "UPDATE products SET quantity = quantity - $quantity WHERE name = '$product_name'";
                mysqli_query($conn, $stock_update_query);
            }
        }
        header("Location: ../admin/return/purchase-return-list.php?msg=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

