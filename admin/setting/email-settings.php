<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php'); 
$query = "SELECT * FROM email_settings";
$result = mysqli_query($conn, $query);
$settings = mysqli_fetch_assoc($result);

?>

<div class="page-wrapper">
    <div class="content">
        <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h4>Email Setting</h4>
                    <h6>Manage Email Setting</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Mail Host</label>
                                <input type="text" name="mail_host" required value="<?php echo !empty($settings) ? $settings['mail_host'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Mail Address</label>
                                <input type="text" name="mail_address" required value="<?php echo !empty($settings) ? $settings['mail_address'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Mail From Name</label>
                                <input type="text" name="mail_from_name" required value="<?php echo !empty($settings) ? $settings['mail_from_name'] : ''; ?>">
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
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Encryption</label>
                                <select class="select" name="encryption" required>
                                    <option value="tls">TLS</option>
                                    <option value="ssl">SSL</option>
                                    <option value="none">None</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-submit" value="<?php echo !empty($settings) ? 'Update' : 'Submit'; ?>" name="<?php echo !empty($settings) ? 'update_email' : 'add_email'; ?>">
                                <input type="hidden" name="email_id" value="<?php echo !empty($settings) ? $settings['id'] : ''; ?>">
                                <a href="email-settings.php" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>