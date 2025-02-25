<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $query = "DELETE FROM currencies WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='currency-settings.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting brand: " . mysqli_error($conn);
    }
}
$query = "SELECT * FROM currencies";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Currency Settings</h4>
                <h6>Manage Currency Settings</h6>
            </div>
            <div class="page-btn">
                <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addcurrencies">
                    <img src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-1">
                    Add New Currency</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Currency deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Currency added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Currency updated successfully!</div>";
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
                                <th>Currency name</th>
                                <th>Currency code</th>
                                <th>Currency symbol</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $currency_id = $row['id'];
                                $currency_name = $row['currency_name'];
                                $currency_code = $row['currency_code'];
                                $currency_symbol = $row['currency_symbol'];
                                $status = $row['status'];
                                $class = ($status == 'Active') ? 'bg-lightgreen' : 'bg-lightred';
                                echo "<tr>
                                    <td>
                                        <label class='checkboxs'>
                                            <input type='checkbox'>
                                            <span class='checkmarks
                                            '></span>
                                        </label>
                                    </td>
                                    <td>$currency_name</td>
                                    <td>$currency_code</td>
                                    <td>$currency_symbol</td>
                                    <td><span class='badges $class'>$status</span></td>
                                    <td>
                                        <a href='#' class='edit-currency me-3' data-bs-toggle='modal' data-bs-target='#editcurrencies'
                                            data-id='$currency_id'
                                            data-name='$currency_name'
                                            data-code='$currency_code'
                                            data-symbol='$currency_symbol'
                                            data-status='$status'>
                                            <img src='" . SITE_URL . "assets/img/icons/edit.svg' alt='Edit'>
                                        </a>
                                        <a href='currency-settings.php?delete_id=" . $currency_id . "' class='confirm-text me-3' onclick='return confirm(\"Are you sure?\")'>
                                            <img src='" . SITE_URL . "assets/img/icons/delete.svg' alt='Delete'>
                                        </a>
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

<div class="modal fade" id="addcurrencies" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Currency</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Currency Name</label>
                                <input type="text" name="curr_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Currency Code</label>
                                <input type="text" name="curr_code" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Currency Symbol</label>
                                <input type="text" name="curr_symbol" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="add_currency" class="btn btn-submit" value="Submit">
                    <a href="units.php" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editcurrencies" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Currency</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="currency_id" id="edit_currency_id">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Currency Name</label>
                                <input type="text" name="curr_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Currency Code</label>
                                <input type="text" name="curr_code" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Currency Symbol</label>
                                <input type="text" name="curr_symbol" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select" name="status" required>
                                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_currency" class="btn btn-submit" value="Submit">
                    <a href="currency-settings.php" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-currency").forEach(function (editBtn) {
            editBtn.addEventListener("click", function () {
                let currencyId = this.getAttribute("data-id").trim();
                let currencyName = this.getAttribute("data-name").trim();
                let currencyCode = this.getAttribute("data-code").trim();
                let currencySymbol = this.getAttribute("data-symbol").trim();
                let currencyStatus = this.getAttribute("data-status").trim();

                document.getElementById("edit_currency_id").value = currencyId;
                document.getElementById("edit_currency_name").value = currencyName;
                document.getElementById("edit_currency_code").value = currencyCode;
                document.getElementById("edit_currency_symbol").value = currencySymbol;
                document.getElementById("edit_currency_status").value = currencyStatus;
            });
        });
    });
</script>

<?php include('../../include/footer.php'); ?>