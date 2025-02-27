<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$first_name = "";
$last_name = "";
$user_name = "";
$password = "";
$phone = "";
$email = "";
$role = "";
$image = "";

if ($user_id > 0) {
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $user_name = $row['user_name'];
        $password = $row['password'];
        $phone = $row['phone'];
        $email = $row['email'];
        $role = $row['role'];
        $image = !empty($row['image']) ? SITE_URL . "uploads/people/" . $row['image'] : SITE_URL . "assets/img/placeholder.png";
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
                                <input type="text" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="user_name" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class=" pass-input" name="password" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select" name="role" required>
                                    <option>Select</option>
                                    <option value="admin">Admin</option>
                                    <option Value="user">User</option>
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
                                        <img id="imagePreview" src="<?php echo SITE_URL; ?>assets/img/icons/upload.svg"
                                            alt="img" style="max-width: 100px; max-height: 40px;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" name="add_user" value="Submit" class="btn btn-submit me-2">
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