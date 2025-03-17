<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$query = "
    SELECT s.id AS supplier_id, s.name AS supplier_name, s.image AS supplier_image,
           COALESCE(SUM(pi.p_qty), 0) AS total_items,
           COALESCE(SUM(p.ptotal_amount), 0) AS total_amount,
           COALESCE(SUM(p.ppaid_payment), 0) AS paid_amount,
           (COALESCE(SUM(p.ptotal_amount), 0) - COALESCE(SUM(p.ppaid_payment), 0)) AS due_amount
    FROM suppliers s
    LEFT JOIN purchases p ON s.id = p.supplier_id
    LEFT JOIN purchase_items pi ON p.id = pi.purchase_id
    GROUP BY s.id, s.name, s.image
    ORDER BY s.name ASC;
";

$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Supplier Report</h4>
                <h6>Manage Your Supplier Report</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search1">
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
                <form id="filterSupplierForm">
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
                                <th>Supplier</th>
                                <th>Total Items</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { 
                                $image_path = !empty($row['supplier_image']) ? SITE_URL . "uploads/people/" . $row['supplier_image'] : SITE_URL . "assets/img/placeholder.png";
                                ?>
                                <tr>
                                    <td>
                                        <a class="align-middle product-img">
                                            <img src='<?php echo $image_path; ?>' alt="Brand Image" width="40">
                                        </a>
                                        <a><?php echo $row['supplier_name']; ?></a>
                                    </td>
                                    <td><?php echo $row['total_items']; ?></td>
                                    <td><?php echo number_format($row['total_amount'], 2); ?></td>
                                    <td><?php echo number_format($row['paid_amount'], 2); ?></td>
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