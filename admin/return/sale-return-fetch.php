<?php
include('../../db_connection.php');

if (isset($_POST['invoice_number'])) {
    $invoice_number = $_POST['invoice_number'];
    
    // Debugging step: Check if invoice_number is received correctly
    error_log("Invoice Number Received: " . $invoice_number);

    // Fetch sale ID, discount, and order tax ID
    $sale_query = "SELECT id, discount, order_tax_id FROM sales WHERE invoice_number = ?";
    $stmt = $conn->prepare($sale_query);
    $stmt->bind_param("s", $invoice_number); // Fix: Use "s" for string binding
    $stmt->execute();
    $sale_result = $stmt->get_result();

    if ($sale_result && $sale_result->num_rows > 0) {
        $sale_row = $sale_result->fetch_assoc();
        $sale_id = $sale_row['id'];
        $order_discount = $sale_row['discount'] ?? 0; // Fix: Handle NULL values safely
        $order_tax_id = $sale_row['order_tax_id'] ?? 0;

        $stmt->close(); // Fix: Close the previous statement before reusing

        // Fetch tax rate from tax_rates table
        $tax_rate = 0;
        if ($order_tax_id > 0) {
            $tax_rate_query = "SELECT tax_rate FROM tax_rates WHERE id = ?";
            $stmt = $conn->prepare($tax_rate_query);
            $stmt->bind_param("i", $order_tax_id);
            $stmt->execute();
            $tax_result = $stmt->get_result();
            if ($tax_result && $tax_result->num_rows > 0) {
                $tax_row = $tax_result->fetch_assoc();
                $tax_rate = $tax_row['tax_rate'];
            }
            $stmt->close(); // Fix: Close statement
        }

        // Fetch sale items
        $sale_item_query = "SELECT id, product_name, price, qty, subtotal FROM sale_items WHERE sale_id = ?";
        $stmt = $conn->prepare($sale_item_query);
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $sale_item_result = $stmt->get_result();

        $sale_items = [];
        while ($row = $sale_item_result->fetch_assoc()) {
            if (!isset($row['product_name'])) {
                error_log("Product name is missing for sale_id: " . $sale_id);
                continue;
            }

            $row['product_name'] = htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8');
            $row['tax'] = round(((float) $row['subtotal'] * (float) $tax_rate) / 100, 2);
            $row['discount'] = ($sale_item_result->num_rows > 0) ? round($order_discount / $sale_item_result->num_rows, 2) : 0;
            $sale_items[] = $row;
        }

        $stmt->close(); // Fix: Close the last statement

        // Debugging output
        error_log("Sale Items: " . print_r($sale_items, true));

        // Set JSON response
        header('Content-Type: application/json');
        echo json_encode($sale_items);
    } else {
        error_log("No sale found for invoice_number: " . $invoice_number);
        echo json_encode([]);
    }
}
?>