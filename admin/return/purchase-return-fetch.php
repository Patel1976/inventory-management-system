<?php
include('../../db_connection.php');

if (isset($_POST['purchase_invoice'])) {
    $purchase_invoice = $_POST['purchase_invoice'];
    
    // Debugging step: Check if purchase_invoice is received correctly
    error_log("Invoice Number Received: " . $purchase_invoice);

    // Fetch purchase ID, discount, and order tax ID
    $purchase_query = "SELECT id, pdiscount, pshipping, ptax_id FROM purchases WHERE purchase_invoice = ?";
    $stmt = $conn->prepare($purchase_query);
    $stmt->bind_param("s", $purchase_invoice); // Fix: Use "s" for string binding
    $stmt->execute();
    $purchase_result = $stmt->get_result();

    if ($purchase_result && $purchase_result->num_rows > 0) {
        $purchase_row = $purchase_result->fetch_assoc();
        $purchase_id = $purchase_row['id'];
        $order_discount = $purchase_row['pdiscount'] ?? 0; // Fix: Handle NULL values safely
        $ptax_id = $purchase_row['ptax_id'] ?? 0;

        $stmt->close(); // Fix: Close the previous statement before reusing

        // Fetch tax rate from tax_rates table
        $tax_rate = 0;
        if ($ptax_id > 0) {
            $tax_rate_query = "SELECT tax_rate FROM tax_rates WHERE id = ?";
            $stmt = $conn->prepare($tax_rate_query);
            $stmt->bind_param("i", $ptax_id);
            $stmt->execute();
            $tax_result = $stmt->get_result();
            if ($tax_result && $tax_result->num_rows > 0) {
                $tax_row = $tax_result->fetch_assoc();
                $tax_rate = $tax_row['tax_rate'];
            }
            $stmt->close(); // Fix: Close statement
        }

        // Fetch purchase items
        $purchase_item_query = "SELECT id, product_name, p_price, p_qty, p_subtotal FROM purchase_items WHERE purchase_id = ?";
        $stmt = $conn->prepare($purchase_item_query);
        $stmt->bind_param("i", $purchase_id);
        $stmt->execute();
        $purchase_item_result = $stmt->get_result();    

        $purchase_items = [];
        while ($row = $purchase_item_result->fetch_assoc()) {
            if (!isset($row['product_name'])) {
                error_log("Product name is missing for purchase_id: " . $purchase_id);
                continue;
            }

            $row['product_name'] = htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8');
            $row['tax'] = round(((float) $row['p_subtotal'] * (float) $tax_rate) / 100, 2);
            $row['discount'] = ($purchase_item_result->num_rows > 0) ? round($order_discount / $purchase_item_result->num_rows, 2) : 0;
            $purchase_items[] = $row;
        }

        $stmt->close(); // Fix: Close the last statement

        // Debugging output
        error_log("purchase Items: " . print_r($purchase_items, true));

        // Set JSON response
        header('Content-Type: application/json');
        echo json_encode($purchase_items);
    } else {
        error_log("No purchase found for purchase_invoice: " . $purchase_invoice);
        echo json_encode([]);
    }
}
?>