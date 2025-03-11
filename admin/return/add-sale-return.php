<?php include('../../include/header.php'); ?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/sale_crud.php" method="POST" enctype="multipart/form-data" id="saleForm">
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
                                <label>Customer Name</label>
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
                                <label>Return Date</label>
                                <div class="input-groupicon">
                                    <input type="text" name="sale_return_date" class="datetimepicker">
                                    <div class="addonset">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Invoice No.</label>
                                <input type="text" class="form-control" name="salereturn_invoice"
                                    value="<?php echo $salereturn_invoice; ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product</label>
                                <div class="input-groupicon">
                                    <input type="text" id="search" placeholder="Please type product code and select...">
                                    <div id="display"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive mb-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Net Unit Price($) </th>
                                        <th>Stock</th>
                                        <th>QTY </th>
                                        <th>Discount($) </th>
                                        <th>Tax % </th>
                                        <th>Subtotal ($) </th>
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
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Shipping</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select">
                                    <option>Choose Status</option>
                                    <option>Completed</option>
                                    <option>Inprogress</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 float-md-right">
                            <div class="total-order mt-0">
                                <ul>
                                    <li>
                                        <h4>Order Tax</h4>
                                        <h5>$ 0.00 (0.00%)</h5>
                                    </li>
                                    <li>
                                        <h4>Discount </h4>
                                        <h5>$ 0.00</h5>
                                    </li>
                                    <li>
                                        <h4>Shipping</h4>
                                        <h5>$ 0.00</h5>
                                    </li>
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5>$ 0.00</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                            <a href="sales-return-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>