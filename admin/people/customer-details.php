<?php 
include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php'); 

// Get the customer ID from the URL
$customer_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch customer details
$query = "SELECT * FROM customers WHERE id = $customer_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
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
                                    <h4>Customer Name</h4>
                                    <h6><?php echo htmlspecialchars($row['name']); ?></h6>
                                </li>
                                <li>
                                    <h4>Email</h4>
                                    <h6><?php echo htmlspecialchars($row['email']); ?></h6>
                                </li>
                                <li>
                                    <h4>Phone</h4>
                                    <h6><?php echo htmlspecialchars($row['phone']); ?></h6>
                                </li>
                                <li>
                                    <h4>Address</h4>
                                    <h6><?php echo htmlspecialchars($row['address']); ?></h6>
                                </li>
                                <li>
                                    <h4>City</h4>
                                    <h6><?php echo htmlspecialchars($row['city']); ?></h6>
                                </li>
                                <li>
                                    <h4>Country</h4>
                                    <h6><?php echo htmlspecialchars($row['country']); ?></h6>
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
                                // Fetch customer images
                                $imageQuery = "SELECT image FROM customers WHERE id = $customer_id";
                                $imageResult = mysqli_query($conn, $imageQuery);

                                if (mysqli_num_rows($imageResult) > 0) {
                                    while ($imageRow = mysqli_fetch_assoc($imageResult)) {
                                        echo '<div class="slider-product">
                                                <img src="' . SITE_URL . 'uploads/people/' . htmlspecialchars($imageRow['image']) . '" alt="Customer Image">
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