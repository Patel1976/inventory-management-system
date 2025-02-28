<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$first_name = "";
$last_name = "";
$user_name = "";
$password = "";
$phone = "";
$email = "";
$role = "";
$image = "";

if ($user_id > 0) {
    $query = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $full_name = explode(" ", $row['name'], 2);
        $first_name = $full_name[0] ?? '';
        $last_name = $full_name[1] ?? '';
        $user_name = $row['username'];
        $password = $row['password'];
        $phone = $row['phone'];
        $email = $row['email_id'];
        $role = $row['role'];
        $image = !empty($row['image']) ? SITE_URL . "uploads/profile/" . $row['image'] : SITE_URL . "assets/img/icons/upload.svg";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>User Management</h4>
                <h6>Add/Update User</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="../../include/people_crud.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" required value="<?php echo $first_name; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" required value="<?php echo $last_name; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="user_name" required value="<?php echo $user_name; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class=" pass-input" name="password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" required value="<?php echo $phone; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" required value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select" name="role" required>
                                    <option>Select</option>
                                    <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option Value="user" <?php echo ($role == 'user') ? 'selected' : ''; ?>>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> User Image</label>
                                <div class="image-upload">
                                    <input type="file" name="user_image" id="file" class="form-control"
                                        onchange="previewImage(this, 'imagePreview')">
                                    <div class="image-uploads">
                                        <img id="imagePreview" src="<?php echo !empty($image) ? $image : SITE_URL . 'assets/img/icons/upload.svg'; ?>"
                                            alt="img" style="max-width: 100px; max-height: 40px;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" name="<?php echo !empty($user_id) ? 'update_user' : 'add_user'; ?>"
                                value="<?php echo !empty($user_id) ? 'Update' : 'Submit'; ?>"
                                class="btn btn-submit me-2">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            <a href="user-list.php" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>