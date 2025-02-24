<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$store_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$store_name = "";
$user_name = "";
$password = "";
$phone = "";
$email = "";
$status = "";

if ($store_id > 0) {
    $query = "SELECT * FROM stores WHERE id = $store_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $store_name = $row['store_name'];
        $user_name = $row['user_name'];
        $password = $row['password'];
        $phone = $row['phone'];
        $email = $row['email'];
        $status = $row['status'];
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/people_crud.php" method="POST" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h4><?php echo $store_id ? 'Update Store' : 'Add Store'; ?></h4>
                    <h6>Add/Update Store</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Store Name</label>
                                <input type="text" class="form-control" name="store_name" value="<?php echo htmlspecialchars($store_name); ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="user_name" required value="<?php echo htmlspecialchars($user_name); ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" name="password" required value="<?php echo htmlspecialchars($password); ?>">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" required value="<?php echo htmlspecialchars($phone); ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" required value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" name="<?php echo !empty($store_id) ? 'update_store' : 'add_store'; ?>" class="btn btn-submit me-2" value="<?php echo !empty($store_id) ? 'Update' : 'Submit'; ?>">
                            <input type="hidden" name="store_id" value="<?php echo $store_id; ?>">
                            <a href="store-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>