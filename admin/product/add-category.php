<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
$category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category_name = "";
$status = "";
$image = "";

if ($category_id > 0) {
    $query = "SELECT * FROM categories WHERE id = $category_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $category_name = $row['name'];
        $status = $row['status'];
        $image = !empty($row['image']) ? SITE_URL . "uploads/category/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/crud.php" method="POST" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo $category_id ? 'Update Category' : 'Add Category'; ?></h4>
                    <h6><?php echo $category_id ? 'Update Selected Category' : 'Create new product Category'; ?></h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="category_name" required 
                                    value="<?php echo htmlspecialchars($category_name); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active
                                    </option>
                                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> Category Image</label>
                                <div class="image-upload">
                                    <input type="file" name="category_image" id="file" class="form-control"
                                        onchange="previewImage(event)">
                                    <div class="image-uploads">
                                        <img id="imagePreview"
                                            src="<?php echo !empty($image) ? $image : SITE_URL . 'assets/img/icons/upload.svg'; ?>"
                                            alt="img" style="max-width: 100px; max-height: 40px;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" name="<?php echo !empty($category_id) ? 'update_category' : 'add_category'; ?>"
                                value="<?php echo !empty($category_id) ? 'Update' : 'Submit'; ?>"
                                class="btn btn-submit me-2">
                            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                            <a href="category-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>