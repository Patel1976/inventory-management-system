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