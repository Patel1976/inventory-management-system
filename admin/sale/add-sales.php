<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Fetch active currency symbol from the database
$curr_query = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
$curr_result = mysqli_query($conn, $curr_query);
$curr_row = mysqli_fetch_assoc($curr_result);
$currencySymbol = $curr_row['currency_symbol'] ?? '$';

$sale_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$discount = 0;
$shipping = 0;
$paid_payment = 0;
$payment_type = 0;
$status = 0;
$tax_id = null;
if ($sale_id > 0) {
    $sale_query = "SELECT * FROM sales WHERE id = $sale_id";
    $sale_result = mysqli_query($conn, $sale_query);
    if ($sale_result && mysqli_num_rows($sale_result) > 0) {
        $row = mysqli_fetch_assoc($sale_result);
        $discount = isset($row['discount']) ? $row['discount'] : '';
        $shipping = isset($row['shipping']) ? $row['shipping'] : '';
        $paid_payment = isset($row['paid_amount']) ? $row['paid_amount'] : '';
        $status = isset($row['status']) ? $row['status'] : '';
        $tax_id = isset($row['order_tax_id']) ? $row['order_tax_id'] : '';
        $payment_type = isset($row['payment_type']) ? $row['payment_type'] : '';
    }
}
$saleData = [
    "discount" => $discount,
    "shipping" => $shipping,
    "tax_id" => $tax_id,
    "currencySymbol" => $currencySymbol,
    "items" => []
];

// Fetch sale items from database
$saleItemsQuery = "SELECT * FROM sale_items WHERE sale_id = $sale_id";
$saleItemsResult = mysqli_query($conn, $saleItemsQuery);
while ($item = mysqli_fetch_assoc($saleItemsResult)) {
    $saleData["items"][] = [
        "product_name" => $item["product_name"],
        "price" => $item["price"],
        "qty" => $item["qty"]
    ];
}

// Pass sale data to JavaScript
echo "<script>var saleData = " . json_encode($saleData) . ";</script>";
// Get the latest invoice number from the database
if ($sale_id == 0) {
    $inv_query = "SELECT invoice_number FROM sales ORDER BY id DESC LIMIT 1";
    $inv_result = mysqli_query($conn, $inv_query);
    $inv_row = mysqli_fetch_assoc($inv_result);
    if ($inv_row) {
        // Extract numeric part from the invoice (e.g., INV-0001 -> 0001)
        preg_match('/\d+$/', $inv_row['invoice_number'], $matches);
        $newInvoice = isset($matches[0]) ? intval($matches[0]) + 1 : 1;
        // Generate new invoice number (format: INV-XXXX)
        $invoice_number = 'INV-' . str_pad($newInvoice, 4, '0', STR_PAD_LEFT);
    } else {
        // First invoice case
        $invoice_number = 'INV-0001';
    }
}
else{
    $invoice_number = $row['invoice_number'];
}
$cust_query = "SELECT * FROM customers";
$cust_result = mysqli_query($conn, $cust_query);

// Fetch taxes
$tax_query = "SELECT id, tax_name, tax_rate FROM tax_rates WHERE status = 'Active'";
$tax_result = mysqli_query($conn, $tax_query);
// Fetch payment type
$pay_query = "SELECT id, payment_name FROM payment_types WHERE status = 'Active'";
$pay_result = mysqli_query($conn, $pay_query);
?>
<div class="page-wrapper">
    <div class="content">
        <form action="../../include/sale_crud.php" method="POST" enctype="multipart/form-data" id="saleForm">
        <input type="hidden" name="total_amount" id="total_amount">
        <input type="hidden" name="sale_item_data" id="sale_item_data">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo $sale_id ? 'Update Sale' : 'Add Sale'; ?></h4>
                    <h6><?php echo $sale_id ? 'Update Selected Sale' : 'Add your new sale'; ?></h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" class="form-control" name="invoice_number"
                                    value="<?php echo $invoice_number; ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="select" name="customer" required>
                                    <option value="">Choose Customer</option>
                                    <?php
                                    while ($cust_row = mysqli_fetch_assoc($cust_result)) {
                                        $selected = ($sale_id > 0 && isset($row['customer_id']) && $row['customer_id'] == $cust_row['id']) ? 'selected' : '';
                                        echo "<option value='" . $cust_row['id'] . "' $selected>" . $cust_row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sale Date</label>
                                <div class="input-groupicon">
                                <input type="text" class="datetimepicker" name="order_date" 
                                    value="<?php echo isset($row['order_date']) ? htmlspecialchars($row['order_date']) : ''; ?>" required>
                                    <a class="addonset">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg" alt="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <div class="input-groupicon">
                                    <input type="text" id="search" placeholder="Please type product code and select...">
                                    <div id="display"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive mb-3">
                            <table class="table" id="productTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 400px;">Product Name</th>
                                        <th>Price</th>
                                        <th style="width: 200px;">Quantity</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach ($saleData["items"] as $item) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><span class="productname"><?php echo htmlspecialchars($item['product_name']); ?></span></td>
                                            <td><?php echo $currencySymbol; ?> <span class="price"><?php echo $item['price']; ?></span></td>
                                            <td><input type="number" name="sale-qty[]" class="form-control qty" style="width:100px;" value="<?php echo $item['qty']; ?>" min="1"></td>
                                            <td><?php echo $currencySymbol; ?> <span class="subtotal"><?php echo $item['price'] * $item['qty']; ?></span></td>
                                            <td>
                                                <a href="javascript:void(0);" class="delete-set"><img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="Delete"></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Tax Dropdown -->
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Order Tax</label>
                                <select class="select" name="tax_id" required>
                                    <option value="">Choose Tax</option>
                                    <?php while ($tax_row = mysqli_fetch_assoc($tax_result)) { ?>
                                    <option value="<?php echo $tax_row['id']; ?>"
                                        <?php echo ($tax_row['id'] == $tax_id) ? 'selected' : ''; ?>>
                                        <?php echo $tax_row['tax_name'] . " (" . $tax_row['tax_rate'] . ")"; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo $currencySymbol; ?></span>
                                    <input type="text" name="discount" class="form-control" 
                                        value="<?php echo htmlspecialchars($discount); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Shipping</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo $currencySymbol; ?></span>
                                    <input type="text" name="shipping" class="form-control" 
                                        value="<?php echo htmlspecialchars($shipping); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option>Choose Status</option>
                                    <option value="Completed" <?php echo ($status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                    <option value="Inprogress" <?php echo ($status == 'Inprogress') ? 'selected' : ''; ?>>Inprogress</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group payment-select">
                                <label>Paid Payment</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo $currencySymbol; ?></span>
                                    <input type="text" name="paid-payment" 
                                        value="<?php echo htmlspecialchars($paid_payment); ?>" required>
                                        <select class="select form-control" name="payment-type" style="width:150px;">
                                            <!-- <option value="">Choose Payment Type</option> -->
                                            <?php while ($row = mysqli_fetch_assoc($pay_result)) { ?>
                                            <option value="<?php echo $row['id']; ?>" 
                                                <?php echo ($row['id'] == $payment_type) ? 'selected' : ''; ?>>
                                                <?php echo $row['payment_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 ms-auto">
                                <div class="total-order w-100 max-widthauto m-auto mb-4">
                                    <ul>
                                        <li>
                                            <h4>Order Tax</h4>
                                            <p><span><?php echo $currencySymbol; ?></span><span id="orderTax"> 0.00
                                                    (0.00%)</span></p>
                                        </li>
                                        <li>
                                            <h4>Discount</h4>
                                            <p><span><?php echo $currencySymbol; ?></span><span
                                                    id="discountAmount">0.00</span></p>
                                        </li>
                                        <li>
                                            <h4>Shipping</h4>
                                            <p><span><?php echo $currencySymbol; ?></span><span
                                                    id="shippingAmount">0.00</span></p>
                                        </li>
                                        <li class="total">
                                            <h4>Grand Total</h4>
                                            <p><span><?php echo $currencySymbol; ?></span><span
                                                    id="grandTotal">0.00</span></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-submit me-2" name="<?php echo !empty($sale_id) ? 'update_sale' : 'add_sale'; ?>" value="<?php echo !empty($sale_id) ? 'Update' : 'Submit'; ?>">
                            <input type="hidden" name="sale_id" value="<?php echo $sale_id; ?>">
                            <a href="sales-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>
var siteUrl = "<?php echo SITE_URL; ?>";
$(document).ready(function () {
    $('.datetimepicker').datepicker({
        format: 'dd-mm-yyyy',  // Set format to match database
        autoclose: true,
        todayHighlight: true
    });
});
</script>
<?php include('../../include/footer.php'); ?>