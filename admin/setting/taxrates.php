<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $query = "DELETE FROM tax_rates WHERE id = $delete_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='taxrates.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting brand: " . mysqli_error($conn);
    }
}
$query = "SELECT * FROM tax_rates";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Tax Rates</h4>
                <h6>Manage Tax Rates</h6>
            </div>
            <div class="page-btn">
                <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addtax"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-1">Add New Tax
                    Rates</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Tax deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Tax added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Tax updated successfully!</div>";
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
                                <th style="width: 30px;">
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Tax name</th>
                                <th>Tax (%)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tax_id = $row['id'];
                                    $name = $row['tax_name'];
                                    $rate = $row['tax_rate'];
                                    $status = (strtolower($row['status']) == "active" || $row['status'] == 1) ? "Active" : "Inactive";
                                    $class = ($status == 'Active') ? 'bg-lightgreen' : 'bg-lightred';
                                    echo "<tr>
                                            <td>
                                                <label class='checkboxs'>
                                                    <input type='checkbox'>
                                                    <span class='checkmarks'></span>
                                                </label>
                                            </td>
                                            <td>$name</td>
                                            <td>$rate</td>
                                            <td><span class='badges $class'>$status</span></td>
                                            <td>
                                                <a class='edit-tax me-3' href='taxrates.php?id=". $tax_id ."' data-bs-toggle='modal' data-bs-target='#editTax'
                                                    data-id='". $tax_id."' 
                                                    data-name='". $name."' 
                                                    data-rate='". $rate."' 
                                                    data-status='". $status."'>
                                                    <img src='" . SITE_URL . "assets/img/icons/edit.svg' alt='Edit'>
                                                </a>
                                                <!-- Delete Button -->
                                                <a class='confirm-text me-3' href='taxrates.php?delete_id=". $tax_id."' onclick='return confirm(\"Are you sure?\")'>
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

<div class="modal fade" id="addtax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tax</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="tax_id" id="tax_id">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Name<span class="manitory">*</span></label>
                                <input type="text" name="tax_name" id="tax_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Rate(%)<span class="manitory">*</span></label>
                                <input type="text" name="tax_rate" id="tax_rate" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select" name="status" id="status" required>
                                    <option value="Active"> Active</option>
                                    <option value="Inactive"> InActive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="add_tax" value="Submit" class="btn btn-submit me-2">
                    <input type="hidden" name="tax_id" value="<?php echo $tax_id; ?>">
                    <a href="taxrates.php" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editTax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tax</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="tax_id" id="edit_tax_id">
                    <div class="form-group">
                        <label>Tax Name<span class="required">*</span></label>
                        <input type="text" name="tax_name" id="edit_tax_name" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Tax Rate (%)<span class="required">*</span></label>
                        <input type="text" name="tax_rate" id="edit_tax_rate" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="select" name="status" id="edit_status">
                            <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active</option>
                            <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_tax" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-tax").forEach(function (editBtn) {
        editBtn.addEventListener("click", function () {
            let taxId = this.getAttribute("data-id").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();
            let taxName = this.getAttribute("data-name").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();
            let taxRate = this.getAttribute("data-rate").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();
            let taxStatus = this.getAttribute("data-status").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();

            document.getElementById("edit_tax_id").value = taxId;
            document.getElementById("edit_tax_name").value = taxName;
            document.getElementById("edit_tax_rate").value = taxRate;
            document.getElementById("edit_status").value = taxStatus;
        });
    });
});
</script>

<?php include('../../include/footer.php'); ?>