<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// delete adjustment
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $delete_query = "DELETE FROM stock_adjustments WHERE id = '$delete_id'";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script>window.location.href='stock-adjustment-list.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting adjustment: " . mysqli_error($conn);
    }
}
$query = "SELECT * FROM stock_adjustments ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Stock Adjustment List</h4>
                <h6>Manage your stock adjustment</h6>
            </div>
            <div class="page-btn">
                <a href="add-stock-adjustment.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-2">Add New
                    Adjustment</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Adjustment deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Adjustment added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Adjustment updated successfully!</div>";
                }
            }
        ?>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg" alt="img">
                            </a>
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
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" name="selected_ids[]" value="<?php echo $row['id']; ?>">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><strong><?php echo $row['ad_quantity']; ?></strong></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <a class="me-3" href="add-stock-adjustment.php?id=<?php echo $row['id']; ?>">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="Edit">
                                    </a>
                                    <a class="me-3 confirm-text"
                                        href="stock-adjustment-list.php?delete_id=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this adjustment?');">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="Delete">
                                    </a>
                                </td>
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