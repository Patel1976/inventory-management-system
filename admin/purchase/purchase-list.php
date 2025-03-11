<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Delete purchase Data
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input

    // Delete related items from purchase_items first
    $delete_items_query = "DELETE FROM purchase_items WHERE purchase_id = $delete_id";
    mysqli_query($conn, $delete_items_query);

    // Delete purchase record from purchases table
    $delete_purchase_query = "DELETE FROM purchases WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_purchase_query)) {
        echo "<script>window.location.href='purchase-list.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting purchase: " . mysqli_error($conn);
    }
}
// Fetch purchases data
$query = "SELECT p.id, p.purchase_invoice, s.name AS supplier_name, p.purchase_date, p.ptax_id, p.pdiscount, 
                 p.pshipping, p.ptotal_amount, p.ppaid_payment, p.ppayment_type, p.status
          FROM purchases p
          LEFT JOIN suppliers s ON p.supplier_id = s.id ORDER BY p.id DESC" ; 

$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Purchase List</h4>
                <h6>Manage Your Purchase</h6>
            </div>
            <div class="page-btn">
                <a href="add-purchase.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-1">Add Purchase</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Purchase deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Purchase added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Purchase updated successfully!</div>";
                }
            }
        ?>
        <div class="card">
            <div class="card-body">
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
                                <th>Supplier Name</th>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['supplier_name'] ?? 'Walk-in Customer'); ?></td>
                                    <td><?php echo date('d M Y', strtotime($row['purchase_date'])); ?></td>
                                    <td><?php echo htmlspecialchars($row['purchase_invoice']); ?></td>
                                    <td>
                                        <span class="badges <?php echo ($row['status'] == 'Received') ? 'bg-lightgreen' : 'bg-lightred'; ?>">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badges <?php echo ($row['ppaid_payment'] >= $row['ptotal_amount']) ? 'bg-lightgreen' : 'bg-lightred'; ?>">
                                            <?php echo ($row['ppaid_payment'] >= $row['ptotal_amount']) ? 'Paid' : 'Unpaid'; ?>
                                        </span>
                                    </td>
                                    <td><?php echo number_format($row['ptotal_amount'], 2); ?></td>
                                    <td><?php echo number_format($row['ppaid_payment'], 2); ?></td>
                                    <td class="text-red"><?php echo number_format($row['ptotal_amount'] - $row['ppaid_payment'], 2); ?></td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="purchase-details.php?id=<?php echo $row['id']; ?>" class="dropdown-item">
                                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/eye1.svg" class="me-2" alt="img">Purchase Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a href="add-purchase.php?id=<?php echo $row['id']; ?>" class="dropdown-item">
                                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" class="me-2" alt="img">Edit Purchase
                                                </a>
                                            </li>
                                            <li>
                                                <a href="purchase-list.php?delete_id=<?php echo $row['id']; ?>" class="dropdown-item confirm-text">
                                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/delete1.svg" class="me-2" alt="img">Delete Purchase
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>