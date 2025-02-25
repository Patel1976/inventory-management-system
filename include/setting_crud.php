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