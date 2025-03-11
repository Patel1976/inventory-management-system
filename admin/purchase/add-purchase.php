<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Fetch active currency symbol from the database
$curr_query = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
$curr_result = mysqli_query($conn, $curr_query);
$curr_row = mysqli_fetch_assoc($curr_result);
$currencySymbol = $curr_row['currency_symbol'] ?? '$';

$purchase_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$discount = 0;
$shipping = 0;
$paid_payment = 0;
$payment_type = 0;
$status = 0;
$tax_id = null;
if ($purchase_id > 0) {
    $purchase_query = "SELECT * FROM purchases WHERE id = $purchase_id";
    $purchase_result = mysqli_query($conn, $purchase_query);
    if ($purchase_result && mysqli_num_rows($purchase_result) > 0) {
        $row = mysqli_fetch_assoc($purchase_result);
        $discount = isset($row['pdiscount']) ? $row['pdiscount'] : '';
        $shipping = isset($row['pshipping']) ? $row['pshipping'] : '';
        $paid_payment = isset($row['ppaid_payment']) ? $row['ppaid_payment'] : '';
        $status = isset($row['status']) ? $row['status'] : '';
        $tax_id = isset($row['ptax_id']) ? $row['ptax_id'] : '';
        $payment_type = isset($row['ppayment_type']) ? $row['ppayment_type'] : '';
    }
}
$purchaseData = [
    "discount" => $discount,
    "shipping" => $shipping,
    "tax_id" => $tax_id,
    "currencySymbol" => $currencySymbol,
    "items" => []
];
// Fetch purchase items from database
$purchaseItemsQuery = "SELECT * FROM purchase_items WHERE purchase_id = $purchase_id";
$purchaseItemsResult = mysqli_query($conn, $purchaseItemsQuery);
while ($item = mysqli_fetch_assoc($purchaseItemsResult)) {
    $purchaseData["items"][] = [
        "product_name" => $item["product_name"],
        "price" => $item["p_price"],
        "qty" => $item["p_qty"]
    ];
}
// Pass purchase data to JavaScript
echo "<script>var purchaseData = " . json_encode($purchaseData) . ";</script>";
// Get the latest invoice number from the database
if ($purchase_id == 0) {
    $inv_query = "SELECT purchase_invoice FROM purchases ORDER BY id DESC LIMIT 1";
    $inv_result = mysqli_query($conn, $inv_query);
    $inv_row = mysqli_fetch_assoc($inv_result);
    if ($inv_row) {
        // Extract numeric part from the invoice (e.g., INV-0001 -> 0001)
        preg_match('/\d+$/', $inv_row['purchase_invoice'], $matches);
        $newInvoice = isset($matches[0]) ? intval($matches[0]) + 1 : 1;
        // Generate new invoice number (format: INV-XXXX)
        $purchase_invoice = 'IMS-' . str_pad($newInvoice, 4, '0', STR_PAD_LEFT);
    } else {
        // First invoice case
        $purchase_invoice = 'IMS-0001';
    }
}
else{
    $purchase_invoice = $row['purchase_invoice'];
}
$supp_query = "SELECT * FROM suppliers";
$supp_result = mysqli_query($conn, $supp_query);
// Fetch taxes
$tax_query = "SELECT id, tax_name, tax_rate FROM tax_rates WHERE status = 'Active'";
$tax_result = mysqli_query($conn, $tax_query);
// Fetch payment type
$pay_query = "SELECT id, payment_name FROM payment_types WHERE status = 'Active'";
$pay_result = mysqli_query($conn, $pay_query);
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/purchase_crud.php" method="POST" enctype="multipart/form-data" id="purchaseForm">
            <input type="hidden" name="total_amount" id="total_amount">
            <input type="hidden" name="purchase_item_data" id="purchase_item_data">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo $purchase_id ? 'Update Purchase' : 'Add Purchase'; ?></h4>
                    <h6><?php echo $purchase_id ? 'Update Selected Purchase' : 'Add your new Purchase'; ?></h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Purchase Invoice</label>
                                <input type="text" class="form-control" name="purchase_invoice"
                                    value="<?php echo $purchase_invoice; ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="select" name="supplier" required>
                                    <option value="">Choose Supplier</option>
                                    <?php
                                    while ($supp_row = mysqli_fetch_assoc($supp_result)) {
                                        $selected = ($purchase_id > 0 && isset($row['supplier_id']) && $row['supplier_id'] == $supp_row['id']) ? 'selected' : '';
                                        echo "<option value='" . $supp_row['id'] . "' $selected>" . $supp_row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Purchase Date</label>
                                <div class="input-groupicon">
                                    <input type="text" class="datetimepicker" name="purchase_date"
                                        value="<?php echo isset($row['purchase_date']) ? htmlspecialchars($row['purchase_date']) : ''; ?>"
                                        required>
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
                                    <?php foreach ($purchaseData["items"] as $item) { ?>
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
                                    <option value="Received" <?php echo ($status == 'Received') ? 'selected' : ''; ?>>
                                        Received</option>
                                    <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>
                                        Pending</option>
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
                            <input type="submit" class="btn btn-submit me-2"
                                name="<?php echo !empty($purchase_id) ? 'update_purchase' : 'add_purchase'; ?>"
                                value="<?php echo !empty($purchase_id) ? 'Update' : 'Submit'; ?>">
                            <input type="hidden" name="purchase_id" value="<?php echo $purchase_id; ?>">
                            <a href="purchase-list.php" class="btn btn-cancel">Cancel</a>
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
$(document).ready(function() {
    $('.datetimepicker').datepicker({
        format: 'dd-mm-yyyy', // Set format to match database
        autoclose: true,
        todayHighlight: true
    });
});
</script>

<?php include('../../include/footer.php'); ?>