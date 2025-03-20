<?php include('../db_connection.php'); 

// Add or Update purchase
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_purchase'])) {
    
    $purchase_invoice = mysqli_real_escape_string($conn, $_POST['purchase_invoice']);
    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier']);
    $purchase_date = mysqli_real_escape_string($conn, $_POST['purchase_date']);
    $purchase_tax = mysqli_real_escape_string($conn, $_POST['tax_id']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $shipping = mysqli_real_escape_string($conn, $_POST['shipping']);
    $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
    $paid_amount = mysqli_real_escape_string($conn, $_POST['paid-payment']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $payment_type = mysqli_real_escape_string($conn, $_POST['payment-type']);

    // Decode purchase items JSON
    $purchaseItems = json_decode($_POST['purchase_item_data'], true);
    // Insert purchase record into `purchases` table
    $query = "INSERT INTO purchases (purchase_invoice, supplier_id, purchase_date, ptax_id, pdiscount, pshipping, ptotal_amount, ppaid_payment, ppayment_type, status) 
              VALUES ('$purchase_invoice', '$supplier_id', '$purchase_date', '$purchase_tax', '$discount', '$shipping', '$total_amount', '$paid_amount', '$payment_type', '$status')";
    
    if (mysqli_query($conn, $query)) {
        // Get the last inserted purchase ID
        $purchase_id = mysqli_insert_id($conn);
        // Insert purchase items into `purchase_items` table
        foreach ($purchaseItems as $item) {
            $productName = mysqli_real_escape_string($conn, $item['product']);
            $price = mysqli_real_escape_string($conn, $item['price']);
            $qty = mysqli_real_escape_string($conn, $item['qty']);
            $subtotal = mysqli_real_escape_string($conn, $item['subtotal']);
            $purchase_query = "INSERT INTO purchase_items (purchase_id, product_name, p_price, p_qty, p_subtotal) 
                           VALUES ('$purchase_id', '$productName', '$price', '$qty', '$subtotal')";
            if (!mysqli_query($conn, $purchase_query)) {
                echo "Error inserting purchase item: " . mysqli_error($conn);
                exit();
            }
            // Update product quantity (decrease stock)
            $update_stock_query = "UPDATE products SET quantity = quantity + '$qty' WHERE name = '$productName'";
            if (!mysqli_query($conn, $update_stock_query)) {
                echo "Error updating product stock: " . mysqli_error($conn);
                exit();
            }
        }
        // Redirect to purchase list with success message
        header("Location: ../admin/purchase/purchase-list.php?msg=success");
        exit();
    } else {
        echo "Error inserting purchase: " . mysqli_error($conn);
    }
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_purchase'])) {
    $purchase_id = isset($_POST['purchase_id']) ? intval($_POST['purchase_id']) : 0;
    $purchase_invoice = mysqli_real_escape_string($conn, $_POST['purchase_invoice']);
    $supplier_id = intval($_POST['supplier']);
    $purchase_date = mysqli_real_escape_string($conn, $_POST['purchase_date']);
    $purchase_tax = intval($_POST['tax_id']);
    $discount = floatval($_POST['discount']);
    $shipping = floatval($_POST['shipping']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $paid_payment = floatval($_POST['paid-payment']);
    $payment_type = intval($_POST['payment-type']);
    $total_amount = floatval($_POST['total_amount']);
    $purchaseItems = json_decode($_POST['purchase_item_data'], true);

    // Update existing purchase
    $query = "UPDATE purchases SET 
                purchase_invoice = '$purchase_invoice', 
                supplier_id = '$supplier_id', 
                purchase_date = '$purchase_date', 
                ptax_id = '$purchase_tax', 
                pdiscount = '$discount', 
                pshipping = '$shipping', 
                status = '$status', 
                ppaid_payment = '$paid_payment', 
                ppayment_type = '$payment_type',
                ptotal_amount = '$total_amount'
                WHERE id = $purchase_id";

    if (mysqli_query($conn, $query)) {
        // Process purchase items (update existing, insert new)
        foreach ($purchaseItems as $item) {
            $productName = mysqli_real_escape_string($conn, $item['product']);
            $price = floatval($item['price']);
            $qty = intval($item['qty']);
            $subtotal = floatval($item['subtotal']);

            // Check if the item exists for the given purchase_id and product
            $check_query = "SELECT id, p_qty FROM purchase_items WHERE purchase_id = '$purchase_id' AND product_name = '$productName'";
            $result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($result) > 0) {
                // Item exists, fetch previous quantity
                $row = mysqli_fetch_assoc($result);
                $previous_qty = intval($row['p_qty']);

                // Calculate difference
                if ($qty > $previous_qty) {
                    $diff = $qty - $previous_qty;
                    // Increase product stock
                    $update_stock = "UPDATE products SET quantity = quantity + $diff WHERE name = '$productName'";
                    mysqli_query($conn, $update_stock);
                } elseif ($qty < $previous_qty) {
                    $diff = $previous_qty - $qty;
                    // Decrease product stock
                    $update_stock = "UPDATE products SET quantity = quantity - $diff WHERE name = '$productName'";
                    mysqli_query($conn, $update_stock);
                }

                // Update purchase item
                $update_query = "UPDATE purchase_items SET 
                                    p_price = '$price', 
                                    p_qty = '$qty', 
                                    p_subtotal = '$subtotal' 
                                 WHERE purchase_id = '$purchase_id' AND product_name = '$productName'";
                mysqli_query($conn, $update_query);
            } else {
                // New item, insert it and increase stock
                $insert_query = "INSERT INTO purchase_items (purchase_id, product_name, p_price, p_qty, p_subtotal) 
                                VALUES ('$purchase_id', '$productName', '$price', '$qty', '$subtotal')";
                mysqli_query($conn, $insert_query);

                // Increase product stock for new item
                $update_stock = "UPDATE products SET quantity = quantity + $qty WHERE name = '$productName'";
                mysqli_query($conn, $update_stock);
            }
        }

        // Redirect to purchases list with success message
        header("Location: ../admin/purchase/purchase-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating purchase: " . mysqli_error($conn);
    }
}