<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
// Check if editing an existing adjustment
$adjustment_id = isset($_GET['id']) ? $_GET['id'] : '';
$product_name = $quantity = $status = $notes = '';
$current_stock = '-'; // Default current stock

if (!empty($adjustment_id)) {
    // Fetch adjustment details
    $query = "SELECT sa.*, p.quantity FROM stock_adjustments sa JOIN products p ON sa.product_id = p.id WHERE sa.id = '$adjustment_id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $quantity = $row['ad_quantity'];
        $status = $row['status'];
        $notes = $row['notes'];
        $current_stock = $row['quantity'];
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/adjustment_crud.php" method="POST" enctype="multipart/form-data" id="adjustmentForm">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="current_stock" class="current_stock" value="<?php echo $current_stock; ?>">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo empty($adjustment_id) ? 'ADD' : 'EDIT'; ?> Stock Adjustment</h4>
                    <h6><?php echo empty($adjustment_id) ? 'Create New' : 'Modify Existing'; ?> Stock Adjustment</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <div class="input-groupicon">
                                    <input type="text" id="stock_search" name="stock_search" class="form-control"
                                        placeholder="Please type product code and select..."
                                        value="<?php echo $product_name; ?>" required>
                                    <div id="display"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Current Stock</label>
                                <p class="current_stock"><?php echo $current_stock; ?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control"
                                    value="<?php echo $quantity; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-control" name="status" required>
                                    <option value="Add" <?php echo ($status == 'Add') ? 'selected' : ''; ?>>Add</option>
                                    <option value="Subtract" <?php echo ($status == 'Subtract') ? 'selected' : ''; ?>>
                                        Subtract</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="adjustment-notes"><?php echo $notes; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-submit me-2"
                                name="<?php echo empty($adjustment_id) ? 'add_adjustment' : 'update_adjustment'; ?>"
                                value="<?php echo empty($adjustment_id) ? 'Submit' : 'Update'; ?>">
                            <input type="hidden" name="adjustment_id" value="<?php echo $adjustment_id; ?>">
                            <a href="stock-adjustment-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>