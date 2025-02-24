<?php 
include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product_name = "";
$category_id = "";
$brand_id = "";
$store_id = "";
$product_code = "";
$unit_id = "";
$quantity = "";
$quantity_alert = "";
$description = "";
$tax_id = "";
$discount_type = "";
$discount_value = "";
$price = "";
$image = "";

if ($product_id > 0) {
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_name = $row['name'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $store_id = $row['store_id'];
        $product_code = $row['product_code'];
        $unit_id = $row['unit_id'];
        $quantity = $row['quantity'];
        $quantity_alert = $row['quantity_alert'];
        $description = $row['description'];
        $tax_id = $row['tax_id'];
        $discount_type = $row['discount_type'];
        $discount_value = $row['discount_value'];
        $price = $row['price'];
        $image = !empty($row['image']) ? SITE_URL . "uploads/products/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";
    }
}
// Fetch categories
$category_query = "SELECT id, name FROM categories WHERE status = 'Active'";
$category_result = mysqli_query($conn, $category_query);
// Fetch brands
$brand_query = "SELECT id, name FROM brands WHERE status = 'Active'";
$brand_result = mysqli_query($conn, $brand_query);
// Fetch stores
$store_query = "SELECT id, store_name FROM stores WHERE status = 'Active'";
$store_result = mysqli_query($conn, $store_query);
// Fetch units
$unit_query = "SELECT id, unit_name, short_name FROM units WHERE status = 'Active'";
$unit_result = mysqli_query($conn, $unit_query);
// Fetch taxes
$tax_query = "SELECT id, tax_name, tax_rate FROM tax_rates WHERE status = 'Active'";
$tax_result = mysqli_query($conn, $tax_query);
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/product_crud.php" method="POST" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo $product_id ? 'Update Product' : 'Product Add'; ?></h4>
                    <h6><?php echo $product_id ? 'Update Selected Product' : 'Create new product'; ?></h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="product_name" required value="<?php echo htmlspecialchars($product_name); ?>">
                            </div>
                        </div>
                        <!-- Category Dropdown -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="category_id" required>
                                    <option value="">Choose Category</option>
                                    <?php while ($row = mysqli_fetch_assoc($category_result)) { ?>
                                        <option value="<?php echo $row['id']; ?>" 
                                            <?php echo ($row['id'] == $category_id) ? 'selected' : ''; ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Brand Dropdown -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="select" name="brand_id" required>
                                    <option value="">Choose Brand</option>
                                    <?php while ($row = mysqli_fetch_assoc($brand_result)) { ?>
                                        <option value="<?php echo $row['id']; ?>" 
                                            <?php echo ($row['id'] == $brand_id) ? 'selected' : ''; ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Store Dropdown -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Store</label>
                                <select class="select" name="store_id" required>
                                    <option value="">Choose Store</option>
                                    <?php while ($row = mysqli_fetch_assoc($store_result)) { ?>
                                        <option value="<?php echo $row['id']; ?>" 
                                            <?php echo ($row['id'] == $store_id) ? 'selected' : ''; ?>>
                                            <?php echo $row['store_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Code</label>
                                <input type="text" class="form-control" name="product_code" required value="<?php echo $product_code; ?>">
                            </div>
                        </div>
                        <!-- Unit Dropdown -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Unit</label>
                                <select class="select" name="unit_id" required>
                                    <option value="">Choose Unit</option>
                                    <?php while ($row = mysqli_fetch_assoc($unit_result)) { ?>
                                        <option value="<?php echo $row['id']; ?>" 
                                            <?php echo ($row['id'] == $unit_id) ? 'selected' : ''; ?>>
                                            <?php echo $row['unit_name']. " (" . $row['short_name'] . ")"; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control" name="quantity" required value="<?php echo $quantity; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity Alert</label>
                                <input type="text" class="form-control" name="quantity_alert" required value="<?php echo $quantity_alert; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"><?php echo htmlspecialchars($description); ?></textarea>
                            </div>
                        </div>
                        <!-- Tax Dropdown -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tax</label>
                                <select class="select" name="tax_id" required>
                                    <option value="">Choose Tax</option>
                                    <?php while ($row = mysqli_fetch_assoc($tax_result)) { ?>
                                        <option value="<?php echo $row['id']; ?>" 
                                            <?php echo ($row['id'] == $tax_id) ? 'selected' : ''; ?>>
                                            <?php echo $row['tax_name'] . " (" . $row['tax_rate'] . ")"; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Type</label>
                                <select class="select" name="discount_type" required>
                                    <option value="">Choose Type</option>
                                    <option value="Percentage" <?php echo ($discount_type == 'Percentage') ? 'selected' : ''; ?>>Percentage</option>
                                    <option value="Cash" <?php echo ($discount_type == 'Cash') ? 'selected' : ''; ?>>Cash</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Value</label>
                                <input type="text" class="form-control" name="discount_value" required value="<?php echo $discount_value; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" name="price" required value="<?php echo $price; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="product_image" id="file" class="form-control"
                                        onchange="previewImage(event)">
                                    <div class="image-uploads">
                                        <img id="imagePreview" src="<?php echo !empty($image) ? $image : SITE_URL . 'assets/img/icons/upload.svg'; ?>" alt="img" style="max-width: 100px; max-height: 40px;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" name="<?php echo !empty($product_id) ? 'update_product' : 'add_product'; ?>"
                                value="<?php echo !empty($product_id) ? 'Update' : 'Submit'; ?>"
                                class="btn btn-submit me-2">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <a href="product-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('../../include/footer.php'); ?>