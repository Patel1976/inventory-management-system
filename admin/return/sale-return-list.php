<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Fetch sales return data before HTML
$query = "SELECT sr.id, sr.return_invoice, sr.customer_id, sr.return_date, sr.paid_payment, 
                 sr.updated_at, c.name as customer_name
          FROM sale_return sr
          LEFT JOIN customers c ON sr.customer_id = c.id";

$result = mysqli_query($conn, $query);

$salesReturns = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch total amount calculation from sale_return_items
        $itemsQuery = "SELECT SUM(subtotal + tax - discount) AS total_amount FROM sale_return_items WHERE sale_return_id = " . $row['id'];
        $itemsResult = mysqli_query($conn, $itemsQuery);
        $itemsData = mysqli_fetch_assoc($itemsResult);
        
        $row['total_amount'] = $itemsData['total_amount'] ?? 0;
        $row['due_amount'] = $row['total_amount'] - $row['paid_payment'];

        // Store return date as text format
        $row['return_date'] = date("Y-m-d", strtotime($row['return_date']));
        $salesReturns[] = $row;
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Return List</h4>
                <h6>Manage your Returns</h6>
            </div>
            <div class="page-btn">
                <a href="add-sale-return.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-2">Add New Sales
                    Return</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Sale Return deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Sale Return added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Sale Return updated successfully!</div>";
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
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($salesReturns)) {
                                foreach ($salesReturns as $row) { ?>
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
                                            $productQuery = "SELECT product_name FROM sale_return_items WHERE sale_return_id = " . $row['id'] . " LIMIT 1";
                                            $productResult = mysqli_query($conn, $productQuery);
                                            $product = mysqli_fetch_assoc($productResult);
                                            // Set default product image
                                            $productImage = SITE_URL . "assets/img/product/default.png";
                                            if ($product) {
                                                $productName = mysqli_real_escape_string($conn, $product['product_name']);
                                                $imageQuery = "SELECT image FROM products WHERE name = '$productName' LIMIT 1";
                                                $imageResult = mysqli_query($conn, $imageQuery);
                                                if ($imageRow = mysqli_fetch_assoc($imageResult)) {
                                                    $productImage = SITE_URL . "uploads/products/" . $imageRow['image'];
                                                }
                                            }
                                            ?>
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="<?php echo $productImage; ?>" alt="product" style="width:40px;">
                                            </a>
                                            <a href="javascript:void(0);">
                                                <?php echo isset($product['product_name']) ? $product['product_name'] : 'N/A'; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $row['return_date']; ?></td> <!-- Date stored as text format -->
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td><?php echo number_format($row['total_amount'], 2); ?></td>
                                        <td><?php echo number_format($row['paid_payment'], 2); ?></td>
                                        <td><?php echo number_format($row['due_amount'], 2); ?></td>
                                        <td>
                                            <a class="me-3" href="add-sale-return.php?id=<?php echo $row['id']; ?>">
                                                <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="img">
                                            </a>
                                            <a class="me-3 confirm-text" href="sale-return-list.php?delete_id=<?php echo $row['id']; ?>">
                                                <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </td>
                                    </tr>
                            <?php } 
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No Sales Returns Found</td></tr>";
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