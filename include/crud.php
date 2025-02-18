<?php include('../db_connection.php'); 

// Add and Update Brand
if (isset($_POST['add_brand'])) {
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Handle Image Upload
    $image_name = "";
    if (isset($_FILES['brand_image']) && $_FILES['brand_image']['error'] == 0) {
        $image_name = time() . "_" . $_FILES['brand_image']['name']; // Unique file name
        $target_dir = "../uploads/brands/"; // Ensure this folder exists
        $target_file = $target_dir . basename($image_name);
        // Create the uploads folder if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // Move file to target directory
        if (move_uploaded_file($_FILES['brand_image']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            exit();
        }
    }
    // Insert Query
    $query = "INSERT INTO brands (name, status, image) VALUES ('$brand_name', '$status', '$image_name')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/product/brand-list.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}
elseif (isset($_POST['update_brand']) && !empty($_POST['brand_id'])) {
    $brand_id = $_POST['brand_id'];
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Handle image upload
    if (!empty($_FILES['brand_image']['name'])) {
        $image_name = time() . "_" . $_FILES['brand_image']['name'];
        move_uploaded_file($_FILES['brand_image']['tmp_name'], "../../uploads/brands/" . $image_name);
        $image_query = ", image='$image_name'";
    } else {
        $image_query = "";
    }
    // Update query
    $query = "UPDATE brands SET name='$brand_name', status='$status' $image_query WHERE id=$brand_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/product/brand-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating brand: " . mysqli_error($conn);
    }
}

// Add and Update Category
if (isset($_POST['add_category'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Handle Image Upload
    $image_name = "";
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == 0) {
        $image_name = time() . "_" . $_FILES['category_image']['name']; // Unique file name
        $target_dir = "../uploads/category/"; // Ensure this folder exists
        $target_file = $target_dir . basename($image_name);
        // Create the uploads folder if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // Move file to target directory
        if (move_uploaded_file($_FILES['category_image']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            exit();
        }
    }
    // Insert Query
    $query = "INSERT INTO categories (name, status, image) VALUES ('$category_name', '$status', '$image_name')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/product/category-list.php?msg=success"); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging error message
    }
}
elseif (isset($_POST['update_category']) && !empty($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Handle image upload
    if (!empty($_FILES['category_image']['name'])) {
        $image_name = time() . "_" . $_FILES['category_image']['name'];
        move_uploaded_file($_FILES['category_image']['tmp_name'], "../../uploads/category/" . $image_name);
        $image_query = ", image='$image_name'";
    } else {
        $image_query = "";
    }
    // Update query
    $query = "UPDATE categories SET name='$category_name', status='$status' $image_query WHERE id=$category_id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin/product/category-list.php?msg=updated");
        exit();
    } else {
        echo "Error updating brand: " . mysqli_error($conn);
    }
}

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
}
elseif (isset($_POST['update_store']) && !empty($_POST['store_id'])) {
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