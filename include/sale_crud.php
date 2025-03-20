<?php include('../db_connection.php'); 

// Add or Update Sale
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_sale'])) {
    
    $invoice_number = mysqli_real_escape_string($conn, $_POST['invoice_number']);
    $customer_id = mysqli_real_escape_string($conn, $_POST['customer']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);
    $order_tax = mysqli_real_escape_string($conn, $_POST['tax_id']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $shipping = mysqli_real_escape_string($conn, $_POST['shipping']);
    $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
    $paid_amount = mysqli_real_escape_string($conn, $_POST['paid-payment']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $payment_type = mysqli_real_escape_string($conn, $_POST['payment-type']);

    // Decode sale items JSON
    $saleItems = json_decode($_POST['sale_item_data'], true);
    
    // Insert sale record into `sales` table
    $query = "INSERT INTO sales (invoice_number, customer_id, order_date, order_tax_id, discount, shipping, total_amount, paid_amount, payment_type, status) 
              VALUES ('$invoice_number', '$customer_id', '$order_date', '$order_tax', '$discount', '$shipping', '$total_amount', '$paid_amount', '$payment_type', '$status')";
    
    if (mysqli_query($conn, $query)) {
        // Get the last inserted sale ID
        $sale_id = mysqli_insert_id($conn);
        
        // Insert sale items into `sale_items` table
        foreach ($saleItems as $item) {
            $productName = mysqli_real_escape_string($conn, $item['product']);
            $price = mysqli_real_escape_string($conn, $item['price']);
            $qty = mysqli_real_escape_string($conn, $item['qty']);
            $subtotal = mysqli_real_escape_string($conn, $item['subtotal']);
            
            // Insert sale item
            $sale_query = "INSERT INTO sale_items (sale_id, product_name, price, qty, subtotal) 
                           VALUES ('$sale_id', '$productName', '$price', '$qty', '$subtotal')";
            if (!mysqli_query($conn, $sale_query)) {
                echo "Error inserting sale item: " . mysqli_error($conn);
                exit();
            }
            
            // Update product quantity (decrease stock)
            $update_stock_query = "UPDATE products SET quantity = quantity - '$qty' WHERE name = '$productName'";
            if (!mysqli_query($conn, $update_stock_query)) {
                echo "Error updating product stock: " . mysqli_error($conn);
                exit();
            }
        }

        // Redirect to sales list with success message
        header("Location: ../admin/sale/sales-list.php?msg=success");
        exit();
    } else {
        echo "Error inserting sale: " . mysqli_error($conn);
    }
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_sale'])) {
    $sale_id = isset($_POST['sale_id']) ? intval($_POST['sale_id']) : 0;
    $invoice_number = mysqli_real_escape_string($conn, $_POST['invoice_number']);
    $customer_id = intval($_POST['customer']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);
    $tax_id = intval($_POST['tax_id']);
    $discount = floatval($_POST['discount']);
    $shipping = floatval($_POST['shipping']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $paid_payment = floatval($_POST['paid-payment']);
    $payment_type = intval($_POST['payment-type']);
    $total_amount = floatval($_POST['total_amount']);
    $saleItems = json_decode($_POST['sale_item_data'], true);

    // Update main sale record
    $query = "UPDATE sales SET 
                invoice_number = '$invoice_number', 
                customer_id = '$customer_id', 
                order_date = '$order_date', 
                order_tax_id = '$tax_id', 
                discount = '$discount', 
                shipping = '$shipping', 
                status = '$status', 
                paid_amount = '$paid_payment', 
                payment_type = '$payment_type',
                total_amount = '$total_amount'
                WHERE id = $sale_id";

    if (mysqli_query($conn, $query)) {
        // Process each sale item
        foreach ($saleItems as $item) {
            $productName = mysqli_real_escape_string($conn, $item['product']);
            $price = floatval($item['price']);
            $qty = intval($item['qty']);
            $subtotal = floatval($item['subtotal']);

            // Check if item exists
            $check_query = "SELECT id, qty FROM sale_items WHERE sale_id = '$sale_id' AND product_name = '$productName'";
            $result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($result) > 0) {
                // Existing item
                $row = mysqli_fetch_assoc($result);
                $original_qty = intval($row['qty']);

                // Compare original vs new quantity
                $difference = $qty - $original_qty;

                if ($difference != 0) {
                    // Update product stock accordingly
                    if ($difference > 0) {
                        // Decrease stock (selling more)
                        $update_stock = "UPDATE products SET quantity = quantity - '$difference' WHERE name = '$productName'";
                    } else {
                        // Increase stock (selling less)
                        $diff_abs = abs($difference);
                        $update_stock = "UPDATE products SET quantity = quantity + '$diff_abs' WHERE name = '$productName'";
                    }
                    mysqli_query($conn, $update_stock);
                }

                // Update sale item
                $update_query = "UPDATE sale_items SET 
                                    price = '$price', 
                                    qty = '$qty', 
                                    subtotal = '$subtotal' 
                                 WHERE id = '{$row['id']}'";
                mysqli_query($conn, $update_query);
            } else {
                // New item
                $insert_query = "INSERT INTO sale_items (sale_id, product_name, price, qty, subtotal) 
                                VALUES ('$sale_id', '$productName', '$price', '$qty', '$subtotal')";
                mysqli_query($conn, $insert_query);

                // Decrease product stock
                $update_stock = "UPDATE products SET quantity = quantity - '$qty' WHERE product_name = '$productName'";
                mysqli_query($conn, $update_stock);
            }
        }

        // Redirect
        header("Location: ../admin/sale/sales-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating sale: " . mysqli_error($conn);
    }
}