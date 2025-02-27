<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Fetch Currency Data
$currency_query = "SELECT * FROM currencies WHERE status = 'Active'";
$currency_result = mysqli_query($conn, $currency_query);

// Fetch General Setting Data
$general_setting_query = "SELECT * FROM general_settings";
$general_setting_result = mysqli_query($conn, $general_setting_query);
$general_setting_data = mysqli_fetch_assoc($general_setting_result);

$company_image = !empty($general_setting_data['company_logo']) ? SITE_URL . 'uploads/logo/' . $general_setting_data['company_logo'] : '';
$company_favicon = !empty($general_setting_data['favicon_icon']) ? SITE_URL . 'uploads/logo/' . $general_setting_data['favicon_icon'] : '';
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>General Setting</h4>
                <h6>Manage General Setting</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" placeholder="Enter Title" name="company-name" required value="<?php echo $general_setting_data['company_name']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Company Email</label>
                                <input type="text" placeholder="Enter email" required name="company-email" value="<?php echo $general_setting_data['company_email']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" placeholder="Enter Phone" required name="phone-number" value="<?php echo $general_setting_data['phone_number']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Currency</label>
                                <select class="select form-control" required name="currency">
                                    <option value="">Choose Currency</option>
                                    <?php
                                    while ($currency = mysqli_fetch_assoc($currency_result)) {
                                        $selected = ($currency['id'] == $general_setting_data['currency']) ? 'selected' : '';
                                        echo "<option value=\"$currency[id]\" $selected>$currency[currency_name] ($currency[currency_symbol])</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Time Zone</label>
                                <select class="select form-control" id="timezone-select" required name="time-zone">
                                    <option value="">Choose Time Zone</option>
                                    <?php
                                    $timezones = DateTimeZone::listIdentifiers();
                                    foreach ($timezones as $timezone) {
                                        $dateTime = new DateTime("now", new DateTimeZone($timezone));
                                        $offset = $dateTime->getOffset();
                                        $hours = floor($offset / 3600);
                                        $minutes = abs(($offset % 3600) / 60);
                                        $formattedOffset = sprintf("UTC%+d:%02d", $hours, $minutes);
                                        // Check if the stored timezone matches the current option
                                        $selected = ($timezone == $general_setting_data['time_zone']) ? 'selected' : '';
                                        
                                        echo "<option value=\"$timezone\" $selected>$timezone ($formattedOffset)</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date Format</label>
                                <select class="select form-control" required name="date-format">
                                    <option value="">Choose Date Format</option>
                                    <option value="d-m-Y" <?php echo ($general_setting_data['date_format'] == 'd-m-Y') ? 'selected' : ''; ?>>DD-MM-YYYY</option>
                                    <option value="m-d-Y" <?php echo ($general_setting_data['date_format'] == 'm-d-Y') ? 'selected' : ''; ?>>MM-DD-YYYY</option>
                                    <option value="Y-m-d" <?php echo ($general_setting_data['date_format'] == 'Y-m-d') ? 'selected' : ''; ?>>YYYY-MM-DD</option>
                                </select>                              
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company Logo</label>
                                <div class="image-upload">
                                    <input type="file" name="company_logo" id="file" class="form-control"
                                        onchange="previewImage(this, 'imagePreview')">
                                    <div class="image-uploads">
                                        <img id="imagePreview" src="<?php echo !empty($company_image) ? $company_image : SITE_URL . 'assets/img/icons/upload.svg'; ?>"
                                            alt="img" style="max-width: 180px; height: 45px;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Favicon Icon</label>
                                <div class="image-upload">
                                    <input type="file" name="favicon_icon" id="file" class="form-control"
                                        onchange="previewImage(this, 'imagePreview1')">
                                    <div class="image-uploads">
                                        <img id="imagePreview1" src="<?php echo !empty($company_favicon) ? $company_favicon : SITE_URL . 'assets/img/icons/upload.svg'; ?>"
                                            alt="img" style="max-width: 180px; height: 45px;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" placeholder="Enter Address" required
                                    name="address"><?php echo $general_setting_data['address']; ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-submit" name="update_general" value="Save Changes">
                                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>