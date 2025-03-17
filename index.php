<?php include('login_check.php');
include('include/header.php'); 
include('db_connection.php'); 

// Total Sales
$salesResult = $conn->query("SELECT SUM(total_amount) AS total_sales, SUM(total_amount - paid_amount) AS total_sales_due FROM sales");
// Total Purchases
$purchasesResult = $conn->query("SELECT SUM(ptotal_amount) AS total_purchases, SUM(ptotal_amount - ppaid_payment) AS total_purchases_due FROM purchases");
// Fetch values
$salesData = $salesResult->fetch_assoc();
$purchasesData = $purchasesResult->fetch_assoc();
// Fetch active currency symbol from the database
$curr_query = "SELECT currency_symbol FROM currencies WHERE status = 'Active' LIMIT 1";
$curr_result = mysqli_query($conn, $curr_query);
$curr_row = mysqli_fetch_assoc($curr_result);
$currencySymbol = $curr_row['currency_symbol'] ?? '$';

// Fetch Stock Alert Products
$stock_alert_sql = "SELECT product_code, name, image, quantity, quantity_alert FROM products WHERE quantity <= quantity_alert";
$stock_alert_result = $conn->query($stock_alert_sql);

// Fetch Top Customers
$top_customers_sql = "
SELECT c.id AS customer_id, c.name AS customer_name, c.image AS customer_image, SUM(s.total_amount) AS total_spent, SUM(si.qty) AS total_quantity
FROM customers c LEFT JOIN sales s ON c.id = s.customer_id LEFT JOIN sale_items si ON s.id = si.sale_id GROUP BY c.id ORDER BY total_spent DESC LIMIT 5";
$top_customers_result = $conn->query($top_customers_sql);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash1.svg" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><?php echo $currencySymbol; ?><span class="counters"
                                data-count="<?php echo $salesData['total_sales']; ?>"><?php echo number_format($salesData['total_sales'], 2); ?></span>
                        </h5>
                        <h6>Total Sales</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash3.svg" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><?php echo $currencySymbol; ?><span class="counters"
                                data-count="<?php echo $salesData['total_sales_due']; ?>"><?php echo number_format($salesData['total_sales_due'], 2); ?></span>
                        </h5>
                        <h6>Total Sales Due</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash2.svg" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><?php echo $currencySymbol; ?><span class="counters"
                                data-count="<?php echo $purchasesData['total_purchases']; ?>"><?php echo number_format($purchasesData['total_purchases'], 2); ?></span>
                        </h5>
                        <h6>Total Purchases</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash4.svg" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><?php echo $currencySymbol; ?><span class="counters"
                                data-count="<?php echo $purchasesData['total_purchases_due']; ?>"><?php echo number_format($purchasesData['total_purchases_due'], 2); ?></span>
                        </h5>
                        <h6>Total Purchases Due</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Purchase & Sales</h5>
                        <div class="graph-sets">
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-sm btn-white" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-calendar me-1"></i>
                                    <span id="selectedYear"><?php echo date('Y'); ?></span>
                                    <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                    $currentYear = date('Y');
                                    for ($i = 0; $i < 10; $i++) {
                                        $year = $currentYear - $i;
                                        echo '<li><a href="javascript:void(0);" class="dropdown-item year-option" data-year="' . $year . '">' . $year . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="sales_purchase_charts"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 col-12 d-flex">
                <div class="card w-100">
                    <div class="card-header">
                        <div class="card-title mb-0">Top Selling Product</div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-wrapper-demo">
                            <canvas id="top_product"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-12 col-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Stock Alert</h4>
                        <div class="table-responsive dataview">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>InStock</th>
                                        <th>Alert Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                if ($stock_alert_result->num_rows >= 0) {
                                    while ($row = $stock_alert_result->fetch_assoc()) {
                                        $image = !empty($row['image']) ? SITE_URL . "uploads/products/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['product_code']) . "</td>";
                                        echo "<td><a class='align-middle product-img'><img src='" . $image . "' alt='Product Image' width='40'></a>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td class='text-red'>" . htmlspecialchars($row['quantity']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['quantity_alert']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No stock alert products found</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 col-12">
                <div class="card w-100">
                    <div class="card-header pb-0">
                        <div class="card-title mb-0">Top Customers</div>
                    </div>
                    <div class="card-body">
                    <?php
                        if ($top_customers_result && $top_customers_result->num_rows > 0) {
                            while ($row = $top_customers_result->fetch_assoc()) {
                                $image = !empty($row['customer_image']) ? SITE_URL . "uploads/people/" . $row['customer_image'] : SITE_URL . "assets/img/placeholder.png";
                                ?>
                                <div class="d-flex align-items-center justify-content-between border-bottom mb-3 pb-3 flex-wrap gap-2">
                                    <div class="d-flex align-items-center">
                                        <a class="avatar">
                                            <img src="<?php echo $image ?>" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <p class="fw-bold"><?php echo htmlspecialchars($row['customer_name']); ?></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h5><?php echo $currencySymbol . number_format($row['total_spent'], 2); ?></h5>
                                        <p>Total Sales: <?php echo htmlspecialchars($row['total_quantity']); ?></p>
                                    </div>									
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p>No top customers found.</p>";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('include/footer.php'); ?>