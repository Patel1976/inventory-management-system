<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

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
// Fetch categories
$category_query = "SELECT id, name FROM categories WHERE status = 'Active'";
$category_result = mysqli_query($conn, $category_query);
// Fetch brands
$brand_query = "SELECT id, name FROM brands WHERE status = 'Active'";
$brand_result = mysqli_query($conn, $brand_query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Inventory Report</h4>
                <h6>Manage Your Inventory Report</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
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
                <form id="filterInvntoryForm">
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="category_id">
                                            <option value="">Choose Category</option>
                                            <?php while ($row = mysqli_fetch_assoc($category_result)) { ?>
                                                <option value="<?php echo $row['id']; ?>" >
                                                    <?php echo $row['name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Brand Dropdown -->
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="brand_id">
                                            <option value="">Choose Brand</option>
                                            <?php while ($row = mysqli_fetch_assoc($brand_result)) { ?>
                                                <option value="<?php echo $row['id']; ?>" >
                                                    <?php echo $row['name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
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
                                <th>Product Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Unit</th>
                                <th>InStock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { 
                                $name = $row['name'];
                                $product_code = $row['product_code'];
                                $qty = $row['quantity'];
                                $image = !empty($row['image']) ? SITE_URL . "uploads/products/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";
                                $category_name = $row['category_name'] ?? 'N/A';
                                $brand_name = $row['brand_name'] ?? 'N/A';
                                $unit_name = $row['unit_name'] ?? 'N/A';
                                ?>
                            <tr>
                                <td><?php echo $product_code; ?></td>
                                <td>
                                    <a class="align-middle product-img">
                                        <img src='<?php echo $image; ?>' alt="Brand Image" width="40">
                                    </a>
                                    <a class="product-name"><?php echo $name; ?></a>
                                </td>
                                <td><?php echo $category_name; ?></td>
                                <td><?php echo $brand_name; ?></td>
                                <td><?php echo $unit_name; ?></td>
                                <td><?php echo $qty; ?></td>
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