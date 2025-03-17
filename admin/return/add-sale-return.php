<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Fetch active currency symbol from the database
$curr_query = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
$curr_result = mysqli_query($conn, $curr_query);
$curr_row = mysqli_fetch_assoc($curr_result);
$currencySymbol = $curr_row['currency_symbol'] ?? '$';

// Initialize variables
$sale_return_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$return_invoice = "";
$customer_id = "";
$return_date = date('d-m-Y');
$paid_payment = 0;
$payment_type = "";

// Fetch sale return data if editing
if ($sale_return_id > 0) {
    $query = "SELECT * FROM sale_return WHERE id = $sale_return_id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $return_invoice = $row['return_invoice'];
        $customer_id = $row['customer_id'];
        $return_date = date('d-m-Y', strtotime($row['return_date']));
        $paid_payment = $row['paid_payment'];
        $payment_type = $row['payment_type'];
    }
    // Fetch all items properly
    $items_query = "SELECT * FROM sale_return_items WHERE sale_return_id = $sale_return_id";
    $items_result = mysqli_query($conn, $items_query);
    $items = [];
    while ($row = mysqli_fetch_assoc($items_result)) {
        $items[] = $row;
    }
}

// Get the list of invoices
$inv_query = "SELECT invoice_number FROM sales ORDER BY id DESC";
$inv_result = mysqli_query($conn, $inv_query);

// Get the list of customers
$cust_query = "SELECT * FROM customers";
$cust_result = mysqli_query($conn, $cust_query);

// Fetch payment types
$pay_query = "SELECT id, payment_name FROM payment_types WHERE status = 'Active'";
$pay_result = mysqli_query($conn, $pay_query);
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/return_crud.php" method="POST" enctype="multipart/form-data" id="salereturnForm">
        <input type="hidden" name="sale_return_id" value="<?php echo $sale_return_id; ?>">
        <input type="hidden" name="sale_return_item_data" id="sale_return_item_data">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo $sale_return_id > 0 ? 'Edit' : 'Create'; ?> Sales Return</h4>
                    <h6><?php echo $sale_return_id > 0 ? 'Update' : 'Add'; ?> Sales Return Details</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Invoice No.</label>
                                <select id="invoiceSelect" class="select" name="return_invoice" required>
                                    <option value="">Choose Invoice</option>
                                    <?php while ($inv_row = mysqli_fetch_assoc($inv_result)) { ?>
                                        <option value="<?php echo $inv_row['invoice_number']; ?>"
                                            <?php echo ($inv_row['invoice_number'] == $return_invoice) ? 'selected' : ''; ?>>
                                            <?php echo $inv_row['invoice_number']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <select class="select" name="customer" required>
                                    <option value="">Choose Customer</option>
                                    <?php while ($cust_row = mysqli_fetch_assoc($cust_result)) { ?>
                                        <option value="<?php echo $cust_row['id']; ?>"
                                            <?php echo ($cust_row['id'] == $customer_id) ? 'selected' : ''; ?>>
                                            <?php echo $cust_row['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Return Date</label>
                                <div class="input-groupicon">
                                    <input type="text" name="sale_return_date" class="datetimepicker" value="<?php echo $return_date; ?>">
                                    <div class="addonset">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product</label>
                                <div class="input-groupicon">
                                    <select id="salereturnsearch" class="select form-control">
                                        <option value="">Select Product</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive mb-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th style="width: 200px;">Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="saleReturnTable">
                                    <?php if (!empty($items)) { ?>
                                        <?php foreach ($items as $row) { ?>
                                            <tr>
                                                <td><span class="productname"><?php echo htmlspecialchars($row['product_name']); ?></span></td>
                                                <td><input type="number" name="sale-qty[]" class="form-control return-qty" style="width:100px;" value="1" min="1"></td>
                                                <td><?php echo $currencySymbol; ?> <span class="price"><?php echo htmlspecialchars($row['price']); ?></span></td>
                                                <td>
                                                    <?php echo $currencySymbol; ?> 
                                                    <span class="discount" data-discount-per-unit="<?php echo htmlspecialchars($row['discount']) * htmlspecialchars($row['qty']); ?>">
                                                        <?php echo htmlspecialchars($row['discount']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php echo $currencySymbol; ?> 
                                                    <span class="tax" data-tax-per-unit="<?php echo htmlspecialchars($row['tax']) * htmlspecialchars($row['qty']); ?>">
                                                        <?php echo htmlspecialchars($row['tax']); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo $currencySymbol; ?> <span class="subtotal"><?php echo htmlspecialchars($row['subtotal']); ?></span></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="delete-set"><img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="Delete"></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group payment-select-return">
                                <label>Paid Payment</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo $currencySymbol; ?></span>
                                    <input type="text" name="sale-paid-payment" 
                                        value="<?php echo htmlspecialchars($paid_payment); ?>" required>
                                        <select class="select form-control" name="payment-type" style="width:200px;">
                                            <!-- <option value="">Choose Payment Type</option> -->
                                            <?php while ($pay_row = mysqli_fetch_assoc($pay_result)) { ?>
                                                <option value="<?php echo $pay_row['payment_name']; ?>" <?php echo ($pay_row['payment_name'] == $payment_type) ? 'selected' : ''; ?>>
                                                    <?php echo $pay_row['payment_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-submit me-2" name="<?php echo $sale_return_id > 0 ? 'update_sale_return' : 'add_sale_return'; ?>" value="<?php echo $sale_return_id > 0 ? 'Update' : 'Submit'; ?>">
                            <input type="hidden" name="sale_return_id" value="<?php echo $sale_return_id; ?>">
                            <a href="sales-return-list.php" class="btn btn-cancel">Cancel</a>
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
var deleteIconUrl = siteUrl + "assets/img/icons/delete.svg";
$(document).ready(function () {
    $('.datetimepicker').datepicker({
        format: 'dd-mm-yyyy',  // Set format to match database
        autoclose: true,
        todayHighlight: true
    });
});
</script>

<?php include('../../include/footer.php'); ?>