<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Get sale_id from URL
$sale_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// Fetch sale details from `sales` table
$sale_query = "SELECT * FROM sales WHERE id = $sale_id";
$sale_result = mysqli_query($conn, $sale_query);
$sale = mysqli_fetch_assoc($sale_result);
// Fetch sale items from `sale_items` table
$items_query = "SELECT * FROM sale_items WHERE sale_id = $sale_id";
$items_result = mysqli_query($conn, $items_query);
// Store sale items in an array
$sale_items = [];
$product_names = [];
$subtotal = 0;
while ($row = mysqli_fetch_assoc($items_result)) {
    $sale_items[] = $row;
    $subtotal += $row['subtotal']; // Calculate subtotal
    $product_names[] = $row['product_name'];
}
// Fetch Customer Deails
$cust_id = $sale['customer_id'];
$cust_query = "SELECT * FROM customers WHERE id = $cust_id";
$cust_result = mysqli_query($conn, $cust_query);
$customer = mysqli_fetch_assoc($cust_result);
// Fetch Tax Value
$tax_id = $sale['order_tax_id'];
$tax_query = "SELECT * FROM tax_rates WHERE id = $tax_id";
$tax_result = mysqli_query($conn, $tax_query);
$tax = mysqli_fetch_assoc($tax_result);
$tax_rate = isset($tax['tax_rate']) ? floatval($tax['tax_rate']) : 0;
$tax_price = ($subtotal * $tax_rate) / 100;
// Fetch active currency symbol from the database
$curr_query = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
$curr_result = mysqli_query($conn, $curr_query);
$curr_row = mysqli_fetch_assoc($curr_result);
$currencySymbol = $curr_row['currency_symbol'] ?? '$';
// // Fetch Product Image
// $product_images = [];
// foreach ($product_names as $product_name) {
//     $product_name_safe = mysqli_real_escape_string($conn, $product_name);
//     $product_query = "SELECT image FROM products WHERE name = '$product_name_safe'";
//     $product_result = mysqli_query($conn, $product_query);

//     if ($product_result) {
//         $product_image = mysqli_fetch_assoc($product_result);
//         $image_name = $product_image['image'] ?? 'default.jpg'; // Handle missing images
//         $product_images[$product_name] = SITE_URL . "uploads/products/" . $image_name;
//     }
// }
// echo "<script>console.log(" . json_encode($cust_result['name']) . ");</script>";
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sale Details</h4>
                <h6>View sale details</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <div class="card-sales-split p-4 wordset">
                    <h4>Sale Detail : <?php echo $sale['invoice_number'];?></h4>
                </div>
                <div class="invoice-box table-height p-3">
                    <div class="row sales-details-items d-flex mb-3">
                        <div class="col-md-5 details-item">
                            <h6>Customer Info</h6>
                            <h4 class="mb-1"><?php echo $customer['name'];?></h4>
                            <p class="mb-0"><?php echo $customer['address'] . ", " . $customer['city'] . ", " . $customer['country']; ?></p>
                            <p class="mb-0">Email: <span><?php echo $customer['email'];?></span></p>
                            <p class="mb-0">Phone: <span><?php echo $customer['phone'];?></span></p>
                        </div>
                        <div class="col-md-5 details-item">
                            <h6>Invoice Info</h6>
                            <p class="mb-0">Invoice Number: <span style="color: #1890ff;"><?php echo $sale['invoice_number'];?></span></p>
                            <p class="mb-0">Order Date: <span style="color: #212B36;"><?php echo $sale['order_date'];?></span></p>
                            <p class="mb-0">Status: <span class="<?php echo ($sale['status'] == 'Completed') ? 'text-green' : 'text-red'; ?>"><?php echo $sale['status']; ?></span></p>
                            <p class="mb-0">Payment Status: <span class="<?php echo ($sale['paid_amount'] >= $sale['total_amount']) ? 'text-green' : 'text-red'; ?>">
                                                                <?php echo ($sale['paid_amount'] >= $sale['total_amount']) ? 'Paid' : 'Unpaid'; ?>
                                                            </span>
                            </p>
                        </div>
                    </div>
                    <h5 class="order-text">Order Summary</h5>
                    <div class="sale-item-box table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 400px;">Product Name</th>
                                    <th>Price</th>
                                    <th style="width: 200px;">Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sale_items as $sale_item) { 
                                    $product_name_safe = mysqli_real_escape_string($conn, $sale_item['product_name']);
                                    $product_query = "SELECT image FROM products WHERE name = '$product_name_safe'";
                                    $product_result = mysqli_query($conn, $product_query);
                                    $product_image = mysqli_fetch_assoc($product_result);
                                    // Set image path
                                    $image_name = $product_image['image'] ?? 'default.jpg'; // Default image if not found
                                    $image_path = SITE_URL . "uploads/products/" . $image_name;
                                    ?>
                                    <tr class="details">
                                        <td>
                                            <img src="<?php echo $image_path; ?>" alt="img"
                                                class="me-2" style="width:40px;height:auto;">
                                                <?php echo $sale_item['product_name'];?>
                                        </td>
                                        <td><?php echo $currencySymbol . "" . $sale_item['price'];?></td>
                                        <td><?php echo $sale_item['qty'];?></td>
                                        <td><?php echo $currencySymbol . "" . $sale_item['subtotal'];?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Order Tax</h4>
                                        <h5><?php echo $currencySymbol . "" . $tax_price . " (" . $tax['tax_rate'] . ")";?></h5>
                                    </li>
                                    <li>
                                        <h4>Discount </h4>
                                        <h5><?php echo $currencySymbol . "" . $sale['discount'];?></h5>
                                    </li>
                                    <li>
                                        <h4>Paid </h4>
                                        <h5><?php echo $currencySymbol . "" . $sale['paid_amount'];?></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Shipping</h4>
                                        <h5><?php echo $currencySymbol . "" . $sale['shipping'];?></h5>
                                    </li>
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5><?php echo $currencySymbol . "" . $sale['total_amount'];?></h5>
                                    </li>
                                    <li class="total">
                                        <h4>Due</h4>
                                        <h5><?php echo $currencySymbol . "" . ($sale['total_amount'] - $sale['paid_amount']);?></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>