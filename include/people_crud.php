<?php include('../db_connection.php'); 

// Add and Update Store
if (isset($_POST['add_store'])) {
    $store_name = mysqli_real_escape_string($conn, $_POST['store_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Insert Query
    $query = "INSERT INTO stores (store_name, user_name, password, phone, email, status) VALUES ('$store_name', '$user_name', '$password', '$phone', '$email', '$status')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/people/store-list.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}elseif (isset($_POST['update_store']) && !empty($_POST['store_id'])) {
    $store_id = $_POST['store_id'];
    $store_name = mysqli_real_escape_string($conn, $_POST['store_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Update query
    $query = "UPDATE stores SET store_name='$store_name', user_name='$user_name', password='$password', phone='$phone', email='$email', status='$status' WHERE id=$store_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/people/store-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating store: " . mysqli_error($conn);
    }
}

// Add and Update Customer 
if (isset($_POST['add_customer'])) {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    // Handle Image Upload
    $image_name = "";
    if (isset($_FILES['customer_image']) && $_FILES['customer_image']['error'] == 0) {
        $image_name = time() . "_" . $_FILES['customer_image']['name']; // Unique file name
        $target_dir = "../uploads/people/"; // Ensure this folder exists
        $target_file = $target_dir . basename($image_name);
        // Create the uploads folder if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // Move file to target directory
        if (move_uploaded_file($_FILES['customer_image']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            exit();
        }
    }
    // Insert Query
    $query = "INSERT INTO customers (name, email, phone, country, city, address, image) VALUES ('$customer_name', '$email', '$phone', '$country', '$city', '$address', '$image_name')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/people/customer-list.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}elseif (isset($_POST['update_customer']) && !empty($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    // Handle image upload
    if (!empty($_FILES['customer_image']['name'])) {
        $image_name = time() . "_" . $_FILES['customer_image']['name'];
        move_uploaded_file($_FILES['customer_image']['tmp_name'], "../uploads/people/" . $image_name);
        $image_query = ", image='$image_name'";
    } else {
        $image_query = "";
    }
    // Update query
    $query = "UPDATE customers SET name='$customer_name', email='$email', phone='$phone', country='$country', city='$city', address='$address' $image_query WHERE id=$customer_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/people/customer-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating customer: " . mysqli_error($conn);
    }
}

// Add and Update Supplier
if (isset($_POST['add_supplier'])) {
    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    // Handle Image Upload
    $image_name = "";
    if (isset($_FILES['supplier_image']) && $_FILES['supplier_image']['error'] == 0) {
        $image_name = time() . "_" . $_FILES['supplier_image']['name']; // Unique file name
        $target_dir = "../uploads/people/"; // Ensure this folder exists
        $target_file = $target_dir . basename($image_name);
        // Create the uploads folder if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // Move file to target directory
        if (move_uploaded_file($_FILES['supplier_image']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            exit();
        }
    }
    // Insert Query
    $query = "INSERT INTO suppliers (name, email, phone, country, city, address, image) VALUES ('$supplier_name', '$email', '$phone', '$country', '$city', '$address', '$image_name')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/people/supplier-list.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}elseif (isset($_POST['update_supplier']) && !empty($_POST['supplier_id'])) {
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    // Handle image upload
    if (!empty($_FILES['supplier_image']['name'])) {
        $image_name = time() . "_" . $_FILES['supplier_image']['name'];
        move_uploaded_file($_FILES['supplier_image']['tmp_name'], "../uploads/people/" . $image_name);
        $image_query = ", image='$image_name'";
    } else {
        $image_query = "";
    }
    // Update query
    $query = "UPDATE suppliers SET name='$supplier_name', email='$email', phone='$phone', country='$country', city='$city', address='$address' $image_query WHERE id=$supplier_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/people/supplier-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating supplier: " . mysqli_error($conn);
    }
}

// Add and Update User
if (isset($_POST['add_user'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $name = trim($first_name . ' ' . $last_name);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    // Handle Image Upload
    $image_name = "";
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
        $image_name = time() . "_" . $_FILES['user_image']['name']; // Unique file name
        $target_dir = "../uploads/profile/"; // Ensure this folder exists
        $target_file = $target_dir . basename($image_name);
        // Create the uploads folder if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // Move file to target directory
        if (move_uploaded_file($_FILES['user_image']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            exit();
        }
    }
    // Insert Query
    $query = "INSERT INTO user (name, username, password, phone, email_id, role, image) VALUES ('$name', '$user_name', '$hashedpassword', '$phone', '$email', '$role', '$image_name')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/user/user-list.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}elseif (isset($_POST['update_user']) && !empty($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $name = trim($first_name . ' ' . $last_name);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    // Handle password update only if a new password is provided
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $password_query = ", password='$hashedpassword'";
    } else {
        $password_query = ""; // Keep the old password
    }
    // Handle image upload
    if (!empty($_FILES['user_image']['name'])) {
        $image_name = time() . "_" . $_FILES['user_image']['name'];
        move_uploaded_file($_FILES['user_image']['tmp_name'], "../uploads/profile/" . $image_name);
        $image_query = ", image='$image_name'";
    } else {
        // Keep the old image if no new image is uploaded
        $image_query = "";
    }
    // Update query
    $query = "UPDATE user SET name='$name', username='$user_name', phone='$phone', email_id='$email', role='$role' $password_query $image_query WHERE user_id=$user_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/user/user-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}