<?php include('../../include/header.php');
include('../../db_connection.php');
include('../../login_check.php');
$user_id = $_SESSION['user_id'];
// Fetch user details
$query = "SELECT * FROM user WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
// Split name into first and last name (if applicable)
$full_name = explode(" ", $user['name'], 2);
$first_name = $full_name[0] ?? '';
$last_name = $full_name[1] ?? '';
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Profile</h4>
                <h6>User Profile</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                    <div class="profile-set">
                        <div class="profile-head">
                        </div>
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    <img src="<?php echo SITE_URL . 'uploads/profile/' . ($user['image'] ?? 'user.png'); ?>"
                                        alt="img" id="blah" name="image">
                                    <div class="profileupload">
                                        <input type="file" id="imgInp" name="image">
                                        <a href="javascript:void(0);"><img
                                                src="<?php echo SITE_URL; ?>assets/img/icons/edit-set.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                                <div class="profile-contentname">
                                    <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                                    <h4>Updates Your Photo and Personal Details.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name"
                                    value="<?php echo htmlspecialchars($first_name); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email"
                                    value="<?php echo htmlspecialchars($user['email_id']); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username"
                                    value="<?php echo htmlspecialchars($user['username']); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class=" pass-input" name="password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="update_profile" class="btn btn-submit" value="Save Changes">
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>