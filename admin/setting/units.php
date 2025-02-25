<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input
    $query = "DELETE FROM units WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='units.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting brand: " . mysqli_error($conn);
    }
}
$query = "SELECT * FROM units";
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Units</h4>
                <h6>Manage Units</h6>
            </div>
            <div class="page-btn">
                <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addunits"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-1">Add New Units</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Unit deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Unit added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Unit updated successfully!</div>";
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
                                <th>Unit name</th>
                                <th>Short Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $unit_id = $row['id'];
                                $unit_name = $row['unit_name'];
                                $short_name = $row['short_name'];
                                $status = (strtolower($row['status']) == "active" || $row['status'] == 1) ? "Active" : "Inactive";
                                $class = ($status == 'Active') ? 'bg-lightgreen' : 'bg-lightred';
                                echo "<tr>
                                        <td>
                                            <label class='checkboxs'>
                                                <input type='checkbox'>
                                                <span class='checkmarks'></span>
                                            </label>
                                        </td>
                                        <td>$unit_name</td>
                                        <td>$short_name</td>
                                        <td><span class='badges $class'>$status</span></td>
                                        <td>
                                            <a class='edit-unit me-3' href='units.php?id=" . $unit_id . "' data-bs-toggle='modal' data-bs-target='#editunit'
                                                data-id='" . $unit_id . "' 
                                                data-name='" . $unit_name . "' 
                                                data-short-name='" . $short_name . "' 
                                                data-status='" . $status . "'>
                                                <img src='" . SITE_URL . "assets/img/icons/edit.svg' alt='Edit'>
                                            </a>
                                            <!-- Delete Button -->
                                            <a class='confirm-text me-3' href='units.php?delete_id=" . $unit_id . "' onclick='return confirm(\"Are you sure?\")'>
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

<div class="modal fade" id="addunits" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Unit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="unit_id" id="unit_id">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Unit Name<span class="manitory">*</span></label>
                                <input type="text" name="unit_name" id="unit_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Short Name<span class="manitory">*</span></label>
                                <input type="text" name="short_name" id="short_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select" name="status" id="status" required>
                                    <option value="Active"> Active</option>
                                    <option value="Inactive"> Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="submit" name="add_unit" value="Submit" class="btn btn-submit me-2">
                    <input type="hidden" name="unii_id" value="<?php echo $unit_id; ?>">
                    <a href="units.php" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editunit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../../include/setting_crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Unit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="unit_id" id="edit_unit_id">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Unit Name<span class="manitory">*</span></label>
                                <input type="text" name="unit_name" id="edit_unit_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Short Name<span class="manitory">*</span></label>
                                <input type="text" name="short_name" id="edit_short_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select" name="status" id="edit_status" required>
                                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>> Active</option>
                                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>> Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_unit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-unit").forEach(function (editBtn) {
        editBtn.addEventListener("click", function () {
            let unitId = this.getAttribute("data-id").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();
            let unitName = this.getAttribute("data-name").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();
            let unitShortname = this.getAttribute("data-short-name").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();
            let unitStatus = this.getAttribute("data-status").replace(/<\?php echo /g, "").replace(/; \?>/g, "").trim();

            document.getElementById("edit_unit_id").value = unitId;
            document.getElementById("edit_unit_name").value = unitName;
            document.getElementById("edit_short_name").value = unitShortname;
            document.getElementById("edit_status").value = unitStatus;
        });
    });
});
</script>

<?php include('../../include/footer.php'); ?>