<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Fetch sales return data before HTML
$query = "SELECT pr.id, pr.return_invoice, pr.supplier_id, pr.purchase_return_date, pr.paid_payment, 
                 pr.shipping, pr.payment_type, s.name as supplier_name
          FROM purchase_returns pr
          LEFT JOIN suppliers s ON pr.supplier_id = s.id";

$result = mysqli_query($conn, $query);

$purchasesReturns = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch total amount calculation from purchase_return_items
        $itemsQuery = "SELECT SUM(subtotal + tax - discount) AS total_amount FROM purchase_return_items WHERE purchase_return_id = " . $row['id'];
        $itemsResult = mysqli_query($conn, $itemsQuery);
        $itemsData = mysqli_fetch_assoc($itemsResult);
        
        $row['total_amount'] = $itemsData['total_amount'] ?? 0;
        $row['due_amount'] = $row['total_amount'] - $row['paid_payment'];

        // Store return date as text format
        $row['purchase_return_date'] = date("Y-m-d", strtotime($row['purchase_return_date']));
        $purchasesReturns[] = $row;
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Purchases Return List</h4>
                <h6>Manage your Returns</h6>
            </div>
            <div class="page-btn">
                <a href="add-purchase-return.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-2">Add New Purchases
                    Return</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>purchase Return deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>purchase Return added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>purchase Return updated successfully!</div>";
                }
            }
        ?>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
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

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Product Name</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Shipping</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($purchasesReturns)) {
                                foreach ($purchasesReturns as $row) { ?>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td class="productimgname">
                                            <?php
                                            // Fetch product details for this return
                                            $productQuery = "SELECT product_name FROM purchase_return_items WHERE purchase_return_id = " . $row['id'] . " LIMIT 1";
                                            $productResult = mysqli_query($conn, $productQuery);
                                            $product = mysqli_fetch_assoc($productResult);
                                            ?>
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="<?php echo SITE_URL; ?>assets/img/product/product6.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);"><?php echo $product['product_name']; ?></a>
                                        </td>
                                        <td><?php echo $row['purchase_return_date']; ?></td> <!-- Date stored as text format -->
                                        <td><?php echo $row['supplier_name']; ?></td>
                                        <td><?php echo number_format($row['total_amount'], 2); ?></td>
                                        <td><?php echo number_format($row['paid_payment'], 2); ?></td>
                                        <td><?php echo number_format($row['due_amount'], 2); ?></td>
                                        <td><?php echo number_format($row['shipping'], 2); ?></td>
                                        <td>
                                            <a class="me-3" href="add-purchase-return.php?id=<?php echo $row['id']; ?>">
                                                <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="img">
                                            </a>
                                            <a class="me-3 confirm-text" href="purchase-return-list.php?delete_id=<?php echo $row['id']; ?>">
                                                <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </td>
                                    </tr>
                            <?php } 
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No purchases Returns Found</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>