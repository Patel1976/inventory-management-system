<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $query = "DELETE FROM products WHERE id = $delete_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='product-list.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}
$query = "SELECT p.*, 
       c.name AS category_name, 
       b.name AS brand_name, 
       u.unit_name AS unit_name 
FROM products p
LEFT JOIN categories c ON p.category_id = c.id
LEFT JOIN brands b ON p.brand_id = b.id
LEFT JOIN units u ON p.unit_id = u.id
ORDER BY p.id ASC;";
$result = mysqli_query($conn, $query);

?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product List</h4>
                <h6>Manage your products</h6>
            </div>
            <div class="page-btn">
                <a href="add-product.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-1">Add New
                    Product</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Product deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Product added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Product updated successfully!</div>";
                }
            }
        ?>
        <div class="card">
            <div class="card-body">
                <?php if (mysqli_num_rows($result) > 0) { ?>
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
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Product Name</th>
                                <th>Product code</th>
                                <th>Category </th>
                                <th>Brand</th>
                                <th>price</th>
                                <th>Unit</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = $row['id'];
                                    $name = $row['name'];
                                    $product_code = $row['product_code'];
                                    $price = $row['price'];
                                    $qty = $row['quantity'];
                                    $image = !empty($row['image']) ? SITE_URL . "uploads/products/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";

                                    $category_name = $row['category_name'] ?? 'N/A';
                                    $brand_name = $row['brand_name'] ?? 'N/A';
                                    $unit_name = $row['unit_name'] ?? 'N/A';

                                    echo "<tr>
                                            <td>
                                                <label class='checkboxs'>
                                                    <input type='checkbox'>
                                                    <span class='checkmarks'></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a class='align-middle product-img'>
                                                    <img src='$image' alt='Brand Image' width='40'>
                                                </a>
                                                <a class='product-name'>$name</a>
                                            </td>
                                            <td>$product_code</td>
                                            <td>$category_name</td>
                                            <td>$brand_name</td>
                                            <td>$price</td>
                                            <td>$unit_name</td>
                                            <td>$qty</td>
                                            <td>
                                                <a class='me-3' href
                                                    ='product-details.php?id=$product_id'>
                                                    <img src='" . SITE_URL . "assets/img/icons/eye.svg' alt='View'>
                                                </a>
                                                <a class='me-3' href='add-product.php?id=$product_id'>
                                                    <img src='" . SITE_URL . "assets/img/icons/edit.svg' alt='Edit'>
                                                </a>
                                                <a class='me-3 confirm-text' href='product-list.php?delete_id=$product_id' onclick='return confirm(\"Are you sure?\")'>
                                                    <img src='" . SITE_URL . "assets/img/icons/delete.svg' alt='Delete'>
                                                </a>
                                            </td>
                                        </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                <!-- Show this image when there are no categories -->
                <div class="text-center">
                    <img src="<?php echo SITE_URL; ?>assets/img/no-data-found.png" alt="No Data Found" width="300">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>