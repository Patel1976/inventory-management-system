<?php include('../../login_check.php');
include('../../include/header.php');
include('../../db_connection.php');

// Delete Sale Data
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input

    // Delete related items from sale_items first
    $delete_items_query = "DELETE FROM sale_items WHERE sale_id = $delete_id";
    mysqli_query($conn, $delete_items_query);

    // Delete sale record from sales table
    $delete_sale_query = "DELETE FROM sales WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_sale_query)) {
        echo "<script>window.location.href='sales-list.php?msg=deleted';</script>";
        exit();
    } else {
        echo "Error deleting sale: " . mysqli_error($conn);
    }
}
// Fetch sales data
$query = "SELECT s.id, s.invoice_number, c.name AS customer_name, s.order_date, s.order_tax_id, s.discount, 
                 s.shipping, s.total_amount, s.paid_amount, s.payment_type, s.status, s.updated_at 
          FROM sales s
          LEFT JOIN customers c ON s.customer_id = c.id ORDER BY s.id DESC" ; 

$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales List</h4>
                <h6>Manage your sales</h6>
            </div>
            <div class="page-btn">
                <a href="add-sales.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-1">Add Sales</a>
            </div>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo "<div class='alert alert-danger'>Sale deleted successfully!</div>";
                } elseif ($_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Sale added successfully!</div>";
                } elseif ($_GET['msg'] == 'updated') {
                    echo "<div class='alert alert-success'>Sale updated successfully!</div>";
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
                                <th>Customer Name</th>
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
                                    <td><?php echo htmlspecialchars($row['customer_name'] ?? 'Walk-in Customer'); ?></td>
                                    <td><?php echo date('d M Y', strtotime($row['order_date'])); ?></td>
                                    <td><?php echo htmlspecialchars($row['invoice_number']); ?></td>
                                    <td>
                                        <span class="badges <?php echo ($row['status'] == 'Completed') ? 'bg-lightgreen' : 'bg-lightred'; ?>">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badges <?php echo ($row['paid_amount'] >= $row['total_amount']) ? 'bg-lightgreen' : 'bg-lightred'; ?>">
                                            <?php echo ($row['paid_amount'] >= $row['total_amount']) ? 'Paid' : 'Unpaid'; ?>
                                        </span>
                                    </td>
                                    <td><?php echo number_format($row['total_amount'], 2); ?></td>
                                    <td><?php echo number_format($row['paid_amount'], 2); ?></td>
                                    <td class="text-red"><?php echo number_format($row['total_amount'] - $row['paid_amount'], 2); ?></td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="sales-details.php?id=<?php echo $row['id']; ?>" class="dropdown-item">
                                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/eye1.svg" class="me-2" alt="img">Sale Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a href="add-sales.php?id=<?php echo $row['id']; ?>" class="dropdown-item">
                                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" class="me-2" alt="img">Edit Sale
                                                </a>
                                            </li>
                                            <li>
                                                <a href="sales-list.php?delete_id=<?php echo $row['id']; ?>" class="dropdown-item confirm-text">
                                                    <img src="<?php echo SITE_URL; ?>assets/img/icons/delete1.svg" class="me-2" alt="img">Delete Sale
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