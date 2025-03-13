<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$query = "SELECT p.id, p.purchase_invoice, p.supplier_id, s.name, p.purchase_date, p.ptotal_amount, p.ppaid_payment, (p.ptotal_amount - p.ppaid_payment) AS due_amount 
          FROM purchases p LEFT JOIN suppliers s ON p.supplier_id = s.id WHERE 1";
$result = mysqli_query($conn, $query);
$supp_query = "SELECT * FROM suppliers";
$supp_result = mysqli_query($conn, $supp_query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Purchase Report</h4>
                <h6>Manage Your Purchase Report</h6>
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
                <form id="filterPurchaseForm">
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
                                        <select class="select" name="supplier">
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
                                <th>Purchase Date</th>
                                <th>Supplier</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                                <th>Due Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['purchase_invoice']); ?></td>
                                <td><?php echo htmlspecialchars($row['purchase_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo number_format($row['ptotal_amount'], 2); ?></td>
                                <td>
                                    <span class="badges <?php echo ($row['ppaid_payment'] >= $row['ptotal_amount']) ? 'bg-lightgreen' : 'bg-lightred'; ?>">
                                        <?php echo ($row['ppaid_payment'] >= $row['ptotal_amount']) ? 'Paid' : 'Unpaid'; ?>
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