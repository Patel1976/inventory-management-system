<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$query = "
    SELECT 
        s.id AS supplier_id, 
        s.name AS supplier_name, 
        s.image AS supplier_image,
        COALESCE(SUM(p.ptotal_amount), 0) AS total_amount,
        COALESCE(SUM(p.ptotal_amount * t.tax_rate / 100), 0) AS tax_amount
    FROM suppliers s
    LEFT JOIN purchases p ON s.id = p.supplier_id
    LEFT JOIN purchase_items pi ON p.id = pi.purchase_id
    LEFT JOIN tax_rates t ON p.ptax_id = t.id
    GROUP BY s.id, s.name, s.image
    ORDER BY s.name ASC;
";

$result = mysqli_query($conn, $query);

$query_cust = "
    SELECT 
        c.id AS customer_id,
        c.name AS customer_name,
        c.image AS customer_image,
        COALESCE(SUM(s.total_amount), 0) AS total_amount,
        COALESCE(SUM(s.total_amount * t.tax_rate / 100), 0) AS tax
    FROM customers c
    LEFT JOIN sales s ON c.id = s.customer_id
    LEFT JOIN tax_rates t ON s.order_tax_id = t.id
    GROUP BY c.id, c.name, c.image
    ORDER BY c.name ASC
";
$result_cust = mysqli_query($conn, $query_cust);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Tax report</h4>
                <h6>Manage your Tax report</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="tabs-set">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab"
                                data-bs-target="#purchase" type="button" role="tab" aria-controls="purchase"
                                aria-selected="true">Purchase Tax</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale"
                                type="button" role="tab" aria-controls="salw" aria-selected="false">Sale Tax</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                            aria-labelledby="purchase-tab">
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
                                                src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg"
                                                alt="img"></a>
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
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/excel.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/printer.svg"
                                                    alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form id="filterPTaxForm">
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
                                            <th>Total Amount</th>
                                            <th>Tax</th>
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
                                                <td><?php echo number_format($row['total_amount'], 2); ?></td>
                                                <td><?php echo number_format($row['tax_amount'], 2); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sale" role="tabpanel">
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
                                                src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg"
                                                alt="img"></a>
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
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/excel.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/printer.svg"
                                                    alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form id="filterCTaxForm">
                                <div class="card" id="filter_inputs1">
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
                                            <th>Customer</th>
                                            <th>Total Amount</th>
                                            <th>Tax</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row_cust = mysqli_fetch_assoc($result_cust)) { 
                                            $image_cust = !empty($row_cust['customer_image']) ? SITE_URL . "uploads/people/" . $row_cust['customer_image'] : SITE_URL . "assets/img/placeholder.png";
                                            ?>
                                            <tr>
                                                <td>
                                                    <a class="align-middle product-img">
                                                        <img src='<?php echo $image_cust; ?>' alt="Customer Image" width="40">
                                                    </a>
                                                    <a><?php echo $row_cust['customer_name']; ?></a>
                                                </td>
                                                <td><?php echo number_format($row_cust['total_amount'], 2); ?></td>
                                                <td><?php echo number_format($row_cust['tax'], 2); ?></td>
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
    </div>
</div>

<div class="searchpart">
    <div class="searchcontent">
        <div class="searchhead">
            <h3>Search </h3>
            <a id="closesearch"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </div>
        <div class="searchcontents">
            <div class="searchparts">
                <input type="text" placeholder="search here">
                <a class="btn btn-searchs">Search</a>
            </div>
            <div class="recentsearch">
                <h2>Recent Search</h2>
                <ul>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Settings</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Report</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Invoice</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Sales</h6>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>