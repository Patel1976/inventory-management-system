<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$query = "SELECT * FROM sales";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row) {
    $newInvoice = $row['last_invoice'] + 1;
    $invoice_number = 'INV-' . str_pad($newInvoice, 4, '0', STR_PAD_LEFT);
} else {
    $invoice_number = 'INV-0001';
}

// customer
$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);

?>
<div class="page-wrapper">
    <div class="content">
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
                            <input type="text" class="form-control" name="invoice_number" value="<?php echo $invoice_number; ?>" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Customer</label>
                            <select class="select">
                                <option>Choose Customer</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
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
                                <input type="text" placeholder="Choose Date" class="datetimepicker" name="order_date"
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
                                    <th>Product Name</th>
                                    <th style="width: 100px;">QTY</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
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
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Order Tax</label>
                            <input type="text" name="order-tax">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="text" name="discount">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Shipping</label>
                            <input type="text" name="shipping">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="select" name="status">
                                <option>Choose Status</option>
                                <option>Completed</option>
                                <option>Inprogress</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ms-auto">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Order Tax</h4>
                                        <h5 id="orderTax">$ 0.00 (0.00%)</h5>
                                    </li>
                                    <li>
                                        <h4>Discount</h4>
                                        <h5 id="discountAmount">$ 0.00</h5>
                                    </li>
                                    <li>
                                        <h4>Shipping</h4>
                                        <h5 id="shippingAmount">$ 0.00</h5>
                                    </li>
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5 id="grandTotal">$ 0.00</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                        <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    var siteUrl = "<?php echo SITE_URL; ?>";
</script>
<?php include('../../include/footer.php'); ?>