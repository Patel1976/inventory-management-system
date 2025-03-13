<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$query = "SELECT s.id, s.invoice_number, s.customer_id, c.name, s.order_date, s.total_amount, s.paid_amount, (s.total_amount - s.paid_amount) AS due_amount 
          FROM sales s LEFT JOIN customers c ON s.customer_id = c.id WHERE 1";
$result = mysqli_query($conn, $query);
$cust_query = "SELECT * FROM customers";
$cust_result = mysqli_query($conn, $cust_query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Report</h4>
                <h6>Manage Your Sales Report</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="<?php echo SITE_URL; ?>assets/img/icons/filter.svg" alt="img">
                                <span><img src="<?php echo SITE_URL; ?>assets/img/icons/closes.svg" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="<?php echo SITE_URL; ?>assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="<?php echo SITE_URL; ?>assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="<?php echo SITE_URL; ?>assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form id="filterSaleForm">
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <div class="input-groupicon">
                                            <input type="text" placeholder="From Date" name="from_date"
                                                value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>"
                                                class="datetimepicker">
                                            <div class="addonset">
                                                <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg"
                                                    alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <div class="input-groupicon">
                                            <input type="text" placeholder="To Date" name="to_date"
                                                value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>"
                                                class="datetimepicker">
                                            <div class="addonset">
                                                <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg"
                                                    alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="customer">
                                            <option value="">Choose Customer</option>
                                            <?php
                                            while ($cust_row = mysqli_fetch_assoc($cust_result)) {
                                                $selected = (isset($_GET['customer']) && $_GET['customer'] == $cust_row['id']) ? 'selected' : '';
                                                echo "<option value='" . $cust_row['id'] . "' $selected>" . $cust_row['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-filters">
                                            <img src="<?php echo SITE_URL; ?>assets/img/icons/search-whites.svg"
                                                alt="img">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table datanew-report">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Sale Date</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                                <th>Due Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['invoice_number']); ?></td>
                                <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo number_format($row['total_amount'], 2); ?></td>
                                <td>
                                    <span class="badges <?php echo ($row['paid_amount'] >= $row['total_amount']) ? 'bg-lightgreen' : 'bg-lightred'; ?>">
                                        <?php echo ($row['paid_amount'] >= $row['total_amount']) ? 'Paid' : 'Unpaid'; ?>
                                    </span>
                                </td>
                                <td><?php echo number_format($row['due_amount'], 2); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>