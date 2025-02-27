<?php include('../db_connection.php'); 

// Add and Update Tax
if (isset($_POST['add_tax'])) {
    $tax_name = mysqli_real_escape_string($conn, $_POST['tax_name']);
    $tax_rate = mysqli_real_escape_string($conn, $_POST['tax_rate']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Append % sign before storing
    $formatted_tax_rate = $tax_rate . '%';
    // Insert Query
    $query = "INSERT INTO tax_rates (tax_name, tax_rate, status) VALUES ('$tax_name', '$formatted_tax_rate', '$status')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/taxrates.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}
elseif (isset($_POST['update_tax']) && !empty($_POST['tax_id'])) {
    $tax_id = $_POST['tax_id'];
    $tax_name = mysqli_real_escape_string($conn, $_POST['tax_name']);
    $tax_rate = mysqli_real_escape_string($conn, $_POST['tax_rate']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Update query
    $query = "UPDATE tax_rates SET tax_name='$tax_name', tax_rate='$tax_rate', status='$status' WHERE id=$tax_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/taxrates.php?msg=updated");
        exit();
    } else {
        echo "Error updating tax: " . mysqli_error($conn);
    }
}

// Add and Update Unit
if (isset($_POST['add_unit'])) {
    $unit_name = mysqli_real_escape_string($conn, $_POST['unit_name']);
    $short_name = mysqli_real_escape_string($conn, $_POST['short_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Insert Query
    $query = "INSERT INTO units (unit_name, short_name, status) VALUES ('$unit_name', '$short_name', '$status')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/units.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}
elseif (isset($_POST['update_unit']) && !empty($_POST['unit_id'])) {
    $unit_id = $_POST['unit_id'];
    $unit_name = mysqli_real_escape_string($conn, $_POST['unit_name']);
    $short_name = mysqli_real_escape_string($conn, $_POST['short_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Update query
    $query = "UPDATE units SET unit_name='$unit_name', short_name='$short_name', status='$status' WHERE id=$unit_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/units.php?msg=updated");
        exit();
    } else {
        echo "Error updating tax: " . mysqli_error($conn);
    }
}

// Add and Update Currency
if (isset($_POST['add_currency'])) {
    $currency_name = mysqli_real_escape_string($conn, $_POST['curr_name']);
    $currency_code = mysqli_real_escape_string($conn, $_POST['curr_code']);
    $currency_symbol = mysqli_real_escape_string($conn, $_POST['curr_symbol']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Insert Query
    $query = "INSERT INTO currencies (currency_name, currency_code, currency_symbol, status) VALUES ('$currency_name', '$currency_code', '$currency_symbol', '$status')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/currency-settings.php?msg=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST['update_currency']) && !empty($_POST['currency_id'])) {
    $currency_id = $_POST['currency_id'];
    $currency_name = mysqli_real_escape_string($conn, $_POST['curr_name']);
    $currency_code = mysqli_real_escape_string($conn, $_POST['curr_code']);
    $currency_symbol = mysqli_real_escape_string($conn, $_POST['curr_symbol']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Update query
    $query = "UPDATE currencies SET currency_name='$currency_name', currency_code='$currency_code', currency_symbol='$currency_symbol', status='$status' WHERE id=$currency_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/currency-settings.php?msg=updated");
        exit();
    } else {
        echo "Error updating tax: " . mysqli_error($conn);
    }
}

// Add and Update Payment Method
if (isset($_POST['add_payment'])) {
    $payment_name = mysqli_real_escape_string($conn, $_POST['payment_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Insert Query
    $query = "INSERT INTO payment_types (payment_name, status) VALUES ('$payment_name', '$status')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/payment-settings.php?msg=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST['update_payment']) && !empty($_POST['payment_id'])) {
    $payment_id = $_POST['payment_id'];
    $payment_name = mysqli_real_escape_string($conn, $_POST['payment_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Update query
    $query = "UPDATE payment_types SET payment_name='$payment_name', status='$status' WHERE id=$payment_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/payment-settings.php?msg=updated");
        exit();
    } else {
        echo "Error updating tax: " . mysqli_error($conn);
    }
}

// Add and Update Email Setting
if (isset($_POST['add_email'])) {
    $mail_host = mysqli_real_escape_string($conn, $_POST['mail_host']);
    $mail_address = mysqli_real_escape_string($conn, $_POST['mail_address']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $mail_from_name = mysqli_real_escape_string($conn, $_POST['mail_from_name']);
    $encryption = mysqli_real_escape_string($conn, $_POST['encryption']);
    // Set mail port based on encryption type
    if ($encryption === "tls") {
        $mail_port = 587;
    } elseif ($encryption === "ssl") {
        $mail_port = 465;
    } else {
        $mail_port = 25; // Default for non-secure connections
    }
    // Insert Query
    $query = "INSERT INTO email_settings (mail_host, mail_port, mail_address, mail_password, mail_from_name, encryption) VALUES ('$mail_host', '$mail_port', '$mail_address', '$password', '$mail_from_name', '$encryption')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/email-settings.php?msg=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST['update_email']) && !empty($_POST['email_id'])) {
    $email_id = $_POST['email_id'];
    $mail_host = mysqli_real_escape_string($conn, $_POST['mail_host']);
    $mail_address = mysqli_real_escape_string($conn, $_POST['mail_address']);
    $mail_from_name = mysqli_real_escape_string($conn, $_POST['mail_from_name']);
    $encryption = mysqli_real_escape_string($conn, $_POST['encryption']);
    // Set mail port based on encryption type
    if ($encryption === "tls") {
        $mail_port = 587;
    } elseif ($encryption === "ssl") {
        $mail_port = 465;
    } else {
        $mail_port = 25; // Default for non-secure connections
    }
    // Get the existing password from DB
    $query = "SELECT mail_password FROM email_settings WHERE id=$email_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $existing_password = $row['mail_password'];
    // Check if a new password is entered
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    } else {
        $password = $existing_password; // Keep the old password
    }
    // Update query
    $query = "UPDATE email_settings SET mail_host='$mail_host', mail_port='$mail_port', mail_address='$mail_address', mail_password='$password', mail_from_name='$mail_from_name', encryption='$encryption' WHERE id=$email_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/email-settings.php?msg=updated");
        exit();
    } else {
        echo "Error updating tax: " . mysqli_error($conn);
    }
}

if (isset($_POST['update_profile'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $name = trim($first_name . ' ' . $last_name); // Store full name in single field
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // Handle password update only if provided
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $update_password = ", password='$password'";
    } else {
        $update_password = "";
    }
    // Handle profile image upload (if provided)
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/profile/" . $image_name);
        $image_query = ", image='$image_name'";
    } else {
        $image_query = "";
    }
    // Update query
    $query = "UPDATE user SET name='$name', email_id='$email', phone='$phone', username='$username' $update_password $image_query WHERE user_id='$user_id'";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/profile.php?msg=updated");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

// Add and Update General Settings
if (isset($_POST['update_general'])) {
    $company_name = mysqli_real_escape_string($conn, $_POST['company-name']);
    $company_email = mysqli_real_escape_string($conn, $_POST['company-email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone-number']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $time_zone = mysqli_real_escape_string($conn, $_POST['time-zone']);
    $date_format = mysqli_real_escape_string($conn, $_POST['date-format']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    // Handle company logo upload (if provided)
    if (!empty($_FILES['company_logo']['name'])) {
        $logo_name = time() . "_" . $_FILES['company_logo']['name'];
        move_uploaded_file($_FILES['company_logo']['tmp_name'], "../uploads/logo/" . $logo_name);
        $logo_query = ", company_logo='$logo_name'";
    } else {
        $logo_query = "";
    }
    // Handle favicon logo upload (if provided)
    if (!empty($_FILES['favicon_icon']['name'])) {
        $favicon_name = time() . "_" . $_FILES['favicon_icon']['name'];
        move_uploaded_file($_FILES['favicon_icon']['tmp_name'], "../uploads/logo/" . $favicon_name);
        $favicon_query = ", favicon_icon='$favicon_name'";
    } else {
        $favicon_query = "";
    }
    // Update query
    $query = "UPDATE general_settings SET company_name='$company_name', company_email='$company_email', phone_number='$phone_number', currency='$currency', time_zone='$time_zone', date_format='$date_format', address='$address' $logo_query $favicon_query";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/setting/general-settings.php?msg=updated");
        exit();
    } else {
        echo "Error updating general settings: " . mysqli_error($conn);
    }
}