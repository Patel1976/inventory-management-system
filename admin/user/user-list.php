<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $query = "DELETE FROM user WHERE user_id = $delete_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='user-list.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM user ORDER BY user_id ASC";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>User List</h4>
                <h6>Manage your User</h6>
            </div>
            <div class="page-btn">
                <a href="add-user.php" class="btn btn-added"><img src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg"
                        alt="img" class="me-2">Add User</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>User deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>User added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>User updated successfully!</div>";
                }
            }
        ?>
        <div class="card">
            <div class="card-body">
                <?php if (mysqli_num_rows($result) > 0) { ?>
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="<?php echo SITE_URL; ?>assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="<?php echo SITE_URL; ?>assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="<?php echo SITE_URL; ?>assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Profile</th>
                                <th>First name </th>
                                <th>Last name </th>
                                <th>User name </th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $user_id = htmlspecialchars($row['user_id']);
                                $full_name = explode(" ", htmlspecialchars($row['name']), 2);
                                $first_name = !empty($full_name[0]) ? htmlspecialchars($full_name[0]) : 'N/A';
                                $last_name = !empty($full_name[1]) ? htmlspecialchars($full_name[1]) : 'N/A';
                                $username = !empty($row['username']) ? htmlspecialchars($row['username']) : 'N/A';
                                $email = !empty($row['email_id']) ? htmlspecialchars($row['email_id']) : 'N/A';
                                $phone = !empty($row['phone']) ? htmlspecialchars($row['phone']) : 'N/A';
                                $role = !empty($row['role']) ? htmlspecialchars($row['role']) : 'N/A';
                                $image = !empty($row['image']) ? SITE_URL . 'uploads/profile/' . htmlspecialchars($row['image']) : SITE_URL . 'uploads/profile/user.png';
                                echo "<tr>
                                    <td>
                                        <label class='checkboxs'>
                                            <input type='checkbox'>
                                            <span class='checkmarks
                                            '></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class='profile-content'>
                                            <div class='profile-contentimg'>
                                                <img src='$image' alt='img' width='50'>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$first_name</td>
                                    <td>$last_name</td>
                                    <td>$username</td>
                                    <td>$email</td>
                                    <td>$phone</td>
                                    <td>$role</td>
                                    <td>
                                        <div class='table-action'>
                                            <a href='add-user.php?id=$user_id' class='me-3'><img src='" . SITE_URL . "assets/img/icons/edit.svg' alt='img'></a>
                                            <a href='add-user.php?id=$user_id' class='me-3 confirm-text' onclick='return confirm(\"Are you sure?\")'><img src='" . SITE_URL . "assets/img/icons/delete.svg' alt='img'></a>
                                        </div>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                <!-- Show this image when there are no categories -->
                <div class="text-center">
                    <img src="<?php echo SITE_URL; ?>assets/img/no-data-found.png" alt="No Data Found" width="300">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>