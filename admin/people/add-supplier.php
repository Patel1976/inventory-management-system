<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php'); 

$supplier_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$supplier_name = "";
$email = "";
$phone = "";
$country = "";
$city = "";
$address = "";
$supplier_image = "";

if ($supplier_id > 0) {
    $query = "SELECT * FROM suppliers WHERE id = $supplier_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $supplier_name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $country = $row['country'];
        $city = $row['city'];
        $address = $row['address'];
        $supplier_image = $row['image'];
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/people_crud.php" method="POST" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo $supplier_id ? 'Update Supplier' : 'Add Supplier'; ?></h4>
                    <h6>Add/Update Supplier</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <input type="text" name="supplier_name" required value="<?php echo htmlspecialchars($supplier_name); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" required value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" required value="<?php echo htmlspecialchars($phone); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Choose Country</label>
                                <select class="select" name="country" required>
                                    <option>Choose Country</option>
                                    <option value="India" <?php echo ($country == 'India') ? 'selected' : ''; ?>>India</option>
                                    <option value="USA" <?php echo ($country == 'USA') ? 'selected' : ''; ?>>USA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" required value="<?php echo htmlspecialchars($city); ?>">
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" required value="<?php echo htmlspecialchars($address); ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> Supplier Photo</label>
                                <div class="image-upload">
                                    <input type="file" name="supplier_image" id="file" class="form-control"
                                        onchange="previewImage(this, 'imagePreview')">
                                    <div class="image-uploads">
                                        <img id="imagePreview"
                                            src="<?php echo $supplier_image ? SITE_URL . 'uploads/people/' . $supplier_image : SITE_URL . 'assets/img/icons/upload.svg'; ?>"
                                            alt="img" style="max-width: 100px; max-height: 40px;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" name="<?php echo !empty($supplier_id) ? 'update_supplier' : 'add_supplier'; ?>" class="btn btn-submit me-2" value="<?php echo !empty($supplier_id) ? 'Update' : 'Submit'; ?>">
                            <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>">
                            <a href="supplier-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<?php include('../../include/footer.php'); ?>