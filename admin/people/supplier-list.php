<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $query = "DELETE FROM suppliers WHERE id = $delete_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='supplier-list.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting supplier: " . mysqli_error($conn);
    }
}
$query = "SELECT * FROM suppliers ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Supplier List</h4>
                <h6>Manage your Suppliers</h6>
            </div>
            <div class="page-btn">
                <a href="add-supplier.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img">Add
                    Supplier</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Supplier deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Supplier added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Supplier updated successfully!</div>";
                }
            }
        ?>
        <div class="card">
            <div class="card-body">
                <?php if (mysqli_num_rows($result) > 0) { ?>
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg" alt="img"></a>
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
                                <th>Image</th>
                                <th>Supplier Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                $supplier_id = $row['id'];
                                $name = $row['name'];
                                $phone = $row['phone'];
                                $email = $row['email'];
                                $country = $row['country'];
                                $image = $row['image'] ? SITE_URL . 'uploads/people/' . $row['image'] : SITE_URL . 'assets/img/icons/user.svg';    

                                echo "<tr>";
                                echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
                                echo "<td><img src='$image' alt='supplier-image' width='40'></td>";
                                echo "<td>$name</td>";
                                echo "<td>$phone</td>";
                                echo "<td>$email</td>";
                                echo "<td>$country</td>";
                                echo "<td>
                                        <div class='action-btn d-flex'>
                                            <a href='supplier-details.php?id=$supplier_id' class='me-3'><img src='" . SITE_URL . "assets/img/icons/eye.svg' alt='view'></a>
                                            <a href='add-supplier.php?id=$supplier_id' class='me-3'><img src='" . SITE_URL . "assets/img/icons/edit.svg' alt='edit'></a>
                                            <a href='supplier-list.php?delete_id=$supplier_id' class='me-3 confirm-text' onclick='return confirm(\"Are you sure?\")'><img src='" . SITE_URL . "assets/img/icons/delete.svg' alt='delete' ></a>
                                        </div>
                                    </td>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
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