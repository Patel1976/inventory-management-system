<?php 
include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php'); 

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    echo "<script>console.error('Invalid Product ID');</script>";
    echo "<script>window.location.href='product-list.php';</script>";
    exit();
}

// Fetch product details
$query = "SELECT p.*, 
       c.name AS category_name, 
       b.name AS brand_name, 
       t.tax_name AS tax_name, 
       u.unit_name AS unit_name, 
       s.store_name AS store_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.id
LEFT JOIN brands b ON p.brand_id = b.id
LEFT JOIN tax_rates t ON p.tax_id = t.id
LEFT JOIN units u ON p.unit_id = u.id
LEFT JOIN stores s ON p.store_id = s.id
WHERE p.id = $product_id";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>console.error('Product Not Found');</script>";
    echo "<script>window.location.href='product-list.php';</script>";
    exit();
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Details</h4>
                <h6>Full details of a product</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="productdetails">
                            <ul class="product-bar">
                                <li>
                                    <h4>Product</h4>
                                    <h6><?php echo htmlspecialchars($row['name']); ?></h6>
                                </li>
                                <li>
                                    <h4>Product Code</h4>
                                    <h6><?php echo htmlspecialchars($row['product_code']); ?></h6>
                                </li>
                                <li>
                                    <h4>Category</h4>
                                    <h6><?php echo htmlspecialchars($row['category_name']); ?></h6>
                                </li>
                                <li>
                                    <h4>Brand</h4>
                                    <h6><?php echo htmlspecialchars($row['brand_name'] ?: 'None'); ?></h6>
                                </li>
                                <li>
                                    <h4>Store</h4>
                                    <h6><?php echo htmlspecialchars($row['store_name']); ?></h6>
                                </li>
                                <li>
                                    <h4>Unit</h4>
                                    <h6><?php echo htmlspecialchars($row['unit_name']); ?></h6>
                                </li>
                                <li>
                                    <h4>Quantity</h4>
                                    <h6><?php echo htmlspecialchars($row['quantity']); ?></h6>
                                </li>
                                <li>
                                    <h4>Minimum Qty</h4>
                                    <h6><?php echo htmlspecialchars($row['quantity_alert']); ?></h6>
                                </li>
                                <li>
                                    <h4>Tax</h4>
                                    <h6><?php echo htmlspecialchars($row['tax_name'] . " %"); ?></h6>
                                </li>
                                <li>
                                    <h4>Discount Type</h4>
                                    <h6><?php echo htmlspecialchars($row['discount_type']); ?></h6>
                                </li>
                                <li>
                                    <h4>Discount Value</h4>
                                    <h6><?php echo htmlspecialchars($row['discount_value']); ?></h6>
                                </li>
                                <li>
                                    <h4>Price</h4>
                                    <h6><?php echo htmlspecialchars($row['price']); ?></h6>
                                </li>
                                <li>
                                    <h4>Description</h4>
                                    <h6><?php echo nl2br(htmlspecialchars($row['description'])); ?></h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="slider-product-details">
                            <div class="owl-carousel owl-theme product-slide">
                                <?php 
                                // Fetch product images
                                $imageQuery = "SELECT image FROM products WHERE id = $product_id";
                                $imageResult = mysqli_query($conn, $imageQuery);

                                if (mysqli_num_rows($imageResult) > 0) {
                                    while ($imageRow = mysqli_fetch_assoc($imageResult)) {
                                        echo '<div class="slider-product">
                                                <img src="' . SITE_URL . 'uploads/products/' . htmlspecialchars($imageRow['image']) . '" alt="Product Image">
                                              </div>';
                                    }
                                } else {
                                    echo '<div class="slider-product">
                                            <img src="' . SITE_URL . 'assets/img/no-image.png" alt="No Image Available">
                                          </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('../../include/footer.php'); ?>