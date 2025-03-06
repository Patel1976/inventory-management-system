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

    // Insert sale record
    $query = "INSERT INTO sales (invoice_number, customer_id, order_date, order_tax_id, discount, shipping, total_amount, paid_amount, payment_type, status) 
              VALUES ('$invoice_number', '$customer_id', '$order_date', '$order_tax', '$discount', '$shipping', '$total_amount', '$paid_amount', '$payment_type', '$status')";
    
    if (mysqli_query($conn, $query)) {
        // Redirect to sales list with success message
        header("Location: ../admin/sale/sales-list.php?msg=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}