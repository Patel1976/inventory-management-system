<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Get the latest invoice number from the database
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

$cust_query = "SELECT * FROM customers";
$cust_result = mysqli_query($conn, $cust_query);
// Fetch taxes
$tax_id = "";
$tax_query = "SELECT id, tax_name, tax_rate FROM tax_rates WHERE status = 'Active'";
$tax_result = mysqli_query($conn, $tax_query);
// Fetch payment type
$pay_id = "";
$pay_query = "SELECT id, payment_name FROM payment_types WHERE status = 'Active'";
$pay_result = mysqli_query($conn, $pay_query);
// Fetch active currency symbol from the database
$query = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$currencySymbol = $row['currency_symbol'] ?? '$';
?>
<div class="page-wrapper">
    <div class="content">
        <form action="../../include/sale_crud.php" method="POST" enctype="multipart/form-data" id="saleForm">
        <input type="hidden" name="total_amount" id="total_amount">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Sale</h4>
                    <h6>Add your new sale</h6>
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
                                    <option>Choose Customer</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($cust_result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sale Date</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="Choose Date" class="datetimepicker"
                                        name="order_date" required>
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
                                    <input type="text" id="search" placeholder="Please type product code and select..." required>
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
                                    <?php while ($row = mysqli_fetch_assoc($tax_result)) { ?>
                                    <option value="<?php echo $row['id']; ?>"
                                        <?php echo ($row['id'] == $tax_id) ? 'selected' : ''; ?>>
                                        <?php echo $row['tax_name'] . " (" . $row['tax_rate'] . ")"; ?>
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
                                    <input type="text" name="discount" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Shipping</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo $currencySymbol; ?></span>
                                    <input type="text" name="shipping" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option>Choose Status</option>
                                    <option>Completed</option>
                                    <option>Inprogress</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group payment-select">
                                <label>Paid Payment</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo $currencySymbol; ?></span>
                                    <input type="text" name="paid-payment" required>
                                    <select class="select form-control" name="payment-type" style="width:150px;">
                                        <?php while ($row = mysqli_fetch_assoc($pay_result)) { ?>
                                        <option value="<?php echo $row['id']; ?>"
                                            <?php echo ($row['id'] == $pay_id) ? 'selected' : ''; ?>>
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
                            <input type="submit" class="btn btn-submit me-2" name="add_sale" value="Submit">
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
</script>
<?php include('../../include/footer.php'); ?>