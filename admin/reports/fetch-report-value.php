<?php
include('../../db_connection.php');
include_once '../../include/config.php';

$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
$customer_id = isset($_POST['customer']) ? $_POST['customer'] : '';
$supplier_id = isset($_POST['supplier']) ? $_POST['supplier'] : '';
$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
$brand_id = isset($_POST['brand_id']) ? $_POST['brand_id'] : '';
$report_type = isset($_POST['report_type']) ? $_POST['report_type'] : '';

if ($report_type === 'sales') {
    $query = "SELECT s.id, s.invoice_number, s.customer_id, c.name, s.order_date, s.total_amount, s.paid_amount, (s.total_amount - s.paid_amount) AS due_amount 
            FROM sales s 
            LEFT JOIN customers c ON s.customer_id = c.id 
            WHERE 1";

    // Get filters
    if (!empty($customer_id)) {
        $customer_id = mysqli_real_escape_string($conn, $customer_id);
        $query .= " AND s.customer_id = '$customer_id'";
    }

    if (!empty($from_date)) {
        $from_date = mysqli_real_escape_string($conn, $from_date);
        $query .= " AND s.order_date >= '$from_date'";
    }

    if (!empty($to_date)) {
        $to_date = mysqli_real_escape_string($conn, $to_date);
        $query .= " AND s.order_date <= '$to_date'";
    }

    $result = mysqli_query($conn, $query);

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $payment_status = ($row['paid_amount'] >= $row['total_amount']) ? 'Paid' : 'Unpaid';
        $status_class = ($row['paid_amount'] >= $row['total_amount']) ? 'bg-lightgreen' : 'bg-lightred';

        $output .= "
            <tr>
                <td>{$row['invoice_number']}</td>
                <td>{$row['order_date']}</td>
                <td>{$row['name']}</td>
                <td>" . number_format($row['total_amount'], 2) . "</td>
                <td><span class='badges $status_class'>$payment_status</span></td>
                <td>" . number_format($row['due_amount'], 2) . "</td>
            </tr>";
    }
    echo $output;
}
elseif ($report_type === 'purchases') {
        $query = "SELECT p.id, p.purchase_invoice, p.supplier_id, s.name, p.purchase_date, p.ptotal_amount, p.ppaid_payment, (p.ptotal_amount - p.ppaid_payment) AS due_amount 
          FROM purchases p LEFT JOIN suppliers s ON p.supplier_id = s.id WHERE 1";

    // Get filters
    if (!empty($customer_id)) {
        $supplier_id = mysqli_real_escape_string($conn, $supplier_id);
        $query .= " AND p.supplier_id = '$supplier_id'";
    }

    if (!empty($from_date)) {
        $from_date = mysqli_real_escape_string($conn, $from_date);
        $query .= " AND p.purchase_date >= '$from_date'";
    }

    if (!empty($to_date)) {
        $to_date = mysqli_real_escape_string($conn, $to_date);
        $query .= " AND p.purchase_date <= '$to_date'";
    }

    $result = mysqli_query($conn, $query);

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $payment_status = ($row['ppaid_payment'] >= $row['ptotal_amount']) ? 'Paid' : 'Unpaid';
        $status_class = ($row['ppaid_payment'] >= $row['ptotal_amount']) ? 'bg-lightgreen' : 'bg-lightred';

        $output .= "
            <tr>
                <td>{$row['purchase_invoice']}</td>
                <td>{$row['purchase_date']}</td>
                <td>{$row['name']}</td>
                <td>" . number_format($row['ptotal_amount'], 2) . "</td>
                <td><span class='badges $status_class'>$payment_status</span></td>
                <td>" . number_format($row['due_amount'], 2) . "</td>
            </tr>";
    }
    echo $output;
}
elseif ($report_type === 'inventory') {
    $query = "SELECT p.*, c.name AS category_name, b.name AS brand_name, u.unit_name AS unit_name FROM products p LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN brands b ON p.brand_id = b.id LEFT JOIN units u ON p.unit_id = u.id";

    $conditions = [];
    // Get filters

    if (!empty($category_id)) {
        $category_id = mysqli_real_escape_string($conn, $category_id);
        $conditions[] = "p.category_id = '$category_id'";
    }
    if (!empty($brand_id)) {
        $brand_id = mysqli_real_escape_string($conn, $brand_id);
        $conditions[] = "p.brand_id = '$brand_id'";
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Final order
    $query .= " ORDER BY p.id ASC";

    $result = mysqli_query($conn, $query);

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $product_code = $row['product_code'];
        $qty = $row['quantity'];
        $image = !empty($row['image']) ? SITE_URL . "uploads/products/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";
        $category_name = $row['category_name'] ?? 'N/A';
        $brand_name = $row['brand_name'] ?? 'N/A';
        $unit_name = $row['unit_name'] ?? 'N/A';

        $output .= "
            <tr>
                <td>{$product_code}</td>
                <td>
                    <a class='align-middle product-img'>
                        <img src='$image' alt='Brand Image' width='40'>
                    </a>
                    <a class='product-name'>$name</a>
                </td>
                <td>{$category_name}</td>
                <td>{$brand_name}</td>
                <td>{$unit_name}</td>
                <td>{$qty}</td>
            </tr>";
    }
    echo $output;
}
elseif ($report_type === 'supplier') {
    $query = "
        SELECT s.id AS supplier_id, s.name AS supplier_name, s.image AS supplier_image,
               COALESCE(SUM(pi.p_qty), 0) AS total_items,
               COALESCE(SUM(p.ptotal_amount), 0) AS total_amount,
               COALESCE(SUM(p.ppaid_payment), 0) AS paid_amount,
               (COALESCE(SUM(p.ptotal_amount), 0) - COALESCE(SUM(p.ppaid_payment), 0)) AS due_amount
        FROM suppliers s
        LEFT JOIN purchases p ON s.id = p.supplier_id
        LEFT JOIN purchase_items pi ON p.id = pi.purchase_id
        WHERE 1=1"; 

    // Add Date Filters
    if (!empty($from_date)) {
        $from_date = mysqli_real_escape_string($conn, $from_date);
        $query .= " AND p.purchase_date >= '$from_date'";
    }

    if (!empty($to_date)) {
        $to_date = mysqli_real_escape_string($conn, $to_date);
        $query .= " AND p.purchase_date <= '$to_date'";
    }

    $query .= " GROUP BY s.id, s.name, s.image ORDER BY s.name ASC";

    $result = mysqli_query($conn, $query);

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $supplier_name = $row['supplier_name'];
        $total_items = $row['total_items'];
        $image_path = !empty($row['supplier_image']) ? SITE_URL . "uploads/people/" . $row['supplier_image'] : SITE_URL . "assets/img/placeholder.png";
        $total_amount = number_format($row['total_amount'], 2);
        $paid_amount = number_format($row['paid_amount'], 2);
        $due_amount = number_format($row['due_amount'], 2);

        $output .= "
            <tr>
                <td>
                    <a class='align-middle product-img'>
                        <img src='$image_path' alt='Brand Image' width='40'>
                    </a>
                    <a class='product-name'>$supplier_name</a>
                </td>
                <td>{$total_items}</td>
                <td>{$total_amount}</td>
                <td>{$paid_amount}</td>
                <td>{$due_amount}</td>
            </tr>";
    }
    echo $output;
}
elseif ($report_type === 'customer') {
    $query = "
        SELECT c.id AS customer_id, c.name AS customer_name, c.image AS customer_image,
               COALESCE(SUM(si.qty), 0) AS total_items,
               COALESCE(SUM(s.total_amount), 0) AS total_amount,
               COALESCE(SUM(s.paid_amount), 0) AS paid_amount,
               (COALESCE(SUM(s.total_amount), 0) - COALESCE(SUM(s.paid_amount), 0)) AS due_amount
        FROM customers c
        LEFT JOIN sales s ON c.id = s.customer_id
        LEFT JOIN sale_items si ON s.id = si.sale_id
        WHERE 1=1"; 

    // Add Date Filters
    if (!empty($from_date)) {
        $from_date = mysqli_real_escape_string($conn, $from_date);
        $query .= " AND s.order_date >= '$from_date'";
    }

    if (!empty($to_date)) {
        $to_date = mysqli_real_escape_string($conn, $to_date);
        $query .= " AND s.order_date <= '$to_date'";
    }

    $query .= " GROUP BY c.id, c.name, c.image ORDER BY c.name ASC";

    $result = mysqli_query($conn, $query);

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $customer_name = $row['customer_name'];
        $total_items = $row['total_items'];
        $image_path = !empty($row['customer_image']) ? SITE_URL . "uploads/people/" . $row['customer_image'] : SITE_URL . "assets/img/placeholder.png";
        $total_amount = number_format($row['total_amount'], 2);
        $paid_amount = number_format($row['paid_amount'], 2);
        $due_amount = number_format($row['due_amount'], 2);

        $output .= "
            <tr>
                <td>
                    <a class='align-middle product-img'>
                        <img src='$image_path' alt='Brand Image' width='40'>
                    </a>
                    <a class='product-name'>$customer_name</a>
                </td>
                <td>{$total_items}</td>
                <td>{$total_amount}</td>
                <td>{$paid_amount}</td>
                <td>{$due_amount}</td>
            </tr>";
    }
    echo $output;
}
elseif ($report_type === 'purchase_tax') {
    $query = "
        SELECT s.id AS supplier_id, s.name AS supplier_name, s.image AS supplier_image,
               COALESCE(SUM(p.ptotal_amount), 0) AS total_amount,
               COALESCE(SUM(p.ptotal_amount * t.tax_rate / 100), 0) AS tax
        FROM suppliers s
        LEFT JOIN purchases p ON s.id = p.supplier_id
        LEFT JOIN tax_rates t ON p.ptax_id = t.id
        WHERE 1=1";

    // Date Filters
    if (!empty($from_date)) {
        $from_date = mysqli_real_escape_string($conn, $from_date);
        $query .= " AND p.purchase_date >= '$from_date'";
    }

    if (!empty($to_date)) {
        $to_date = mysqli_real_escape_string($conn, $to_date);
        $query .= " AND p.purchase_date <= '$to_date'";
    }

    $query .= " GROUP BY s.id, s.name, s.image ORDER BY s.name ASC";

    $result = mysqli_query($conn, $query);

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $supplier_name = $row['supplier_name'];
        $image_path = !empty($row['supplier_image']) ? SITE_URL . "uploads/people/" . $row['supplier_image'] : SITE_URL . "assets/img/placeholder.png";
        $total_amount = number_format($row['total_amount'], 2);
        $tax_amount = number_format($row['tax'], 2);

        $output .= "
            <tr>
                <td>
                    <a class='align-middle product-img'>
                        <img src='$image_path' alt='Brand Image' width='40'>
                    </a>
                    <a class='product-name'>$supplier_name</a>
                </td>
                <td>{$total_amount}</td>
                <td>{$tax_amount}</td>
            </tr>";
    }
    echo $output;
}
elseif ($report_type === 'sale_tax') {
    $query = "
        SELECT c.id AS customer_id, c.name AS customer_name, c.image AS customer_image,
               COALESCE(SUM(s.total_amount), 0) AS total_amount,
            COALESCE(SUM(s.total_amount * t.tax_rate / 100), 0) AS tax
        FROM customers c
        LEFT JOIN sales s ON c.id = s.customer_id
        LEFT JOIN tax_rates t ON s.order_tax_id = t.id
        WHERE 1=1";
    // Date Filters
    if (!empty($from_date)) {
        $from_date = mysqli_real_escape_string($conn, $from_date);
        $query .= " AND s.order_date >= '$from_date'";
    }

    if (!empty($to_date)) {
        $to_date = mysqli_real_escape_string($conn, $to_date);
        $query .= " AND s.order_date <= '$to_date'";
    }

    $query .= " GROUP BY c.id, c.name, c.image ORDER BY c.name ASC";

    $result = mysqli_query($conn, $query);

    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $supplier_name = $row['customer_name'];
        $image_path = !empty($row['customer_image']) ? SITE_URL . "uploads/people/" . $row['customer_image'] : SITE_URL . "assets/img/placeholder.png";
        $total_amount = number_format($row['total_amount'], 2);
        $tax_amount = number_format($row['tax'], 2);

        $output .= "
            <tr>
                <td>
                    <a class='align-middle product-img'>
                        <img src='$image_path' alt='Customer Image' width='40'>
                    </a>
                    <a class='product-name'>$supplier_name</a>
                </td>
                <td>{$total_amount}</td>
                <td>{$tax_amount}</td>
            </tr>";
    }
    echo $output;
}
?>