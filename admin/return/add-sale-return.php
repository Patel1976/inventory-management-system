<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Fetch active currency symbol from the database
$curr_query = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
$curr_result = mysqli_query($conn, $curr_query);
$curr_row = mysqli_fetch_assoc($curr_result);
$currencySymbol = $curr_row['currency_symbol'] ?? '$';

$sale_return_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$invoice_number = "";
$paid_payment = 0;
$payment_type = 0;

// Get the latest invoice number from the database
$inv_query = "SELECT invoice_number FROM sales ORDER BY id DESC";
$inv_result = mysqli_query($conn, $inv_query);

$cust_query = "SELECT * FROM customers";
$cust_result = mysqli_query($conn, $cust_query);

// Fetch payment type
$pay_query = "SELECT id, payment_name FROM payment_types WHERE status = 'Active'";
$pay_result = mysqli_query($conn, $pay_query);
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/sale_return_crud.php" method="POST" enctype="multipart/form-data" id="salereturnForm">
            <div class="page-header">
                <div class="page-title">
                    <h4>Create Sales Return</h4>
                    <h6>Add/Update Sales Return</h6>
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
                                            <?php echo ($inv_row['invoice_number'] == $invoice_number) ? 'selected' : ''; ?>>
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
                                    <?php
                                    while ($cust_row = mysqli_fetch_assoc($cust_result)) {
                                        $selected = ($sale_return_id > 0 && isset($row['customer_id']) && $row['customer_id'] == $cust_row['id']) ? 'selected' : '';
                                        echo "<option value='" . $cust_row['id'] . "' $selected>" . $cust_row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Return Date</label>
                                <div class="input-groupicon">
                                    <input type="text" name="sale_return_date" class="datetimepicker">
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
                                    <input type="text" name="paid-payment" 
                                        value="<?php echo htmlspecialchars($paid_payment); ?>" required>
                                        <select class="select form-control" name="payment-type" style="width:200px;">
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
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-submit me-2" name="add_sale_return" value="Submit">
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