<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $query = "DELETE FROM categories WHERE id = $delete_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='category-list.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting brand: " . mysqli_error($conn);
    }
}
$query = "SELECT * FROM categories ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Category list</h4>
                <h6>View/Search product Category</h6>
            </div>
            <div class="page-btn">
                <a href="add-category.php" class="btn btn-added">
                    <img src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
                </a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Category deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Category added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Category updated successfully!</div>";
                }
            }
        ?>
        <div class="card">
            <div class="card-body">
                <?php if (mysqli_num_rows($result) > 0) { ?>
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
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf">
                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/pdf.svg" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/excel.svg" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print">
                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/printer.svg" alt="img">
                                </a>
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
                                <th>Image</th>
                                <th>Category name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category_id = $row['id'];
                                    $name = $row['name'];
                                    $status = (strtolower($row['status']) == "active" || $row['status'] == 1) ? "Active" : "Inactive";
                                    $image = !empty($row['image']) ? SITE_URL . "uploads/category/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";
                                    $class = ($status == 'Active') ? 'bg-lightgreen' : 'bg-lightred';
                                    echo "<tr>
                                            <td>
                                                <label class='checkboxs'>
                                                    <input type='checkbox'>
                                                    <span class='checkmarks'></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a class='product-img'>
                                                    <img src='$image' alt='Category Image' width='50'>
                                                </a>
                                            </td>
                                            <td>$name</td>
                                            <td><span class='badges $class'>$status</span></td>
                                            <td>
                                                <a class='me-3' href='add-category.php?id=$category_id'>
                                                    <img src='" . SITE_URL . "assets/img/icons/edit.svg' alt='Edit'>
                                                </a>
                                                <a class='me-3 confirm-text' href='category-list.php?delete_id=$category_id' onclick='return confirm(\"Are you sure?\")'>
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