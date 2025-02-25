<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $query = "DELETE FROM payment_types WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='payment-settings.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting brand: " . mysqli_error($conn);
    }
}
$query = "SELECT * FROM payment_types";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Payment Settings</h4>
                <h6>Manage Payment Settings</h6>
            </div>
            <div class="page-btn">
                <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addpayment"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-2">Add Payment
                    Settings</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Payment Type deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Payment Type added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Payment Type updated successfully!</div>";
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
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Payment Type Name</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { 
                                $payment_id = $row['id'];
                                $payment_name = $row['payment_name'];
                                $status = $row['status'];
                                $class = ($status == 'Active') ? 'bg-lightgreen' : 'bg-lightred';
                                echo "<tr>
                                    <td>
                                        <label class='checkboxs'>
                                            <input type='checkbox' id='select-all'>
                                            <span class='checkmarks
                                            '></span>
                                        </label>
                                    </td>
                                    <td>$payment_name</td>
                                    <td><span class='badges $class'>$status</span></td>
                                    <td class='text-end'>
                                        <div class='d-flex justify-content-end'>
                                            <a href='#' class='me-3 edit-payment' data-bs-toggle='modal' data-bs-target='#editpayment'
                                                data-id='$payment_id' data-name='$payment_name' data-status='$status'>
                                                <img src='".SITE_URL."assets/img/icons/edit.svg' alt='img'>
                                            </a>
                                            <a href='?delete_id=$payment_id' class='me-3 confirm-text' onclick='return confirm(\"Are you sure?\")'>
                                                <img src='".SITE_URL."assets/img/icons/delete.svg' alt='img'>
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
                            } ?>
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

<div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add payment type</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Payment Name</label>
                                <input type="text" name="payment_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">InActive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <input type="submit" name="add_payment" class="btn btn-submit" value="Submit">
                    <a href="payment-settings.php" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editpayment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit payment type</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="payment_id">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Payment Name</label>
                                <input type="text" name="payment_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active
                                    </option>
                                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_payment" class="btn btn-submit" value="Update">
                    <a href="payment-settings.php" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.edit-payment').forEach(item => {
        item.addEventListener('click', event => {
            let payment_id = item.getAttribute('data-id');
            let payment_name = item.getAttribute('data-name');
            let status = item.getAttribute('data-status');
            document.querySelector('#editpayment input[name="payment_id"]').value = payment_id;
            document.querySelector('#editpayment input[name="payment_name"]').value =
                payment_name;
            document.querySelector('#editpayment select[name="status"]').value = status;
        });
    });
});
</script>

<?php include('../../include/footer.php'); ?>