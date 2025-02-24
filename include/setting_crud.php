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