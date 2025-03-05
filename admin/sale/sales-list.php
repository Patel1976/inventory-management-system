<?php include('../../include/header.php'); ?>

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
                    <table class="table  datanew">
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
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>walk-in-customer</td>
                                <td>19 Nov 2022</td>
                                <td>SL0101</td>
                                <td><span class="badges bg-lightgreen">Completed</span></td>
                                <td><span class="badges bg-lightgreen">Paid</span></td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td class="text-red">100.00</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="sales-details.php" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img">Sale
                                                Detail</a>
                                        </li>
                                        <li>
                                            <a href="edit-sales.php" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" class="me-2"
                                                    alt="img">Edit
                                                Sale</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#showpayment"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/dollar-square.svg"
                                                    class="me-2" alt="img">Show
                                                Payments</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#createpayment"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/plus-circle.svg"
                                                    class="me-2" alt="img">Create
                                                Payment</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download
                                                pdf</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item confirm-text"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/delete1.svg"
                                                    class="me-2" alt="img">Delete
                                                Sale</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>walk-in-customer</td>
                                <td>19 Nov 2022</td>
                                <td>SL0102</td>
                                <td><span class="badges bg-lightgreen">Completed</span></td>
                                <td><span class="badges bg-lightgreen">Paid</span></td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td class="text-red">100.00</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="sales-details.php" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img">Sale
                                                Detail</a>
                                        </li>
                                        <li>
                                            <a href="edit-sales.php" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" class="me-2"
                                                    alt="img">Edit
                                                Sale</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#showpayment"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/dollar-square.svg"
                                                    class="me-2" alt="img">Show
                                                Payments</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#createpayment"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/plus-circle.svg"
                                                    class="me-2" alt="img">Create
                                                Payment</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download
                                                pdf</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item confirm-text"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/delete1.svg"
                                                    class="me-2" alt="img">Delete
                                                Sale</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>walk-in-customer</td>
                                <td>19 Nov 2022</td>
                                <td>SL0103</td>
                                <td><span class="badges bg-lightgreen">Completed</span></td>
                                <td><span class="badges bg-lightgreen">Paid</span></td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td class="text-green">100.00</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="sales-details.php" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img">Sale
                                                Detail</a>
                                        </li>
                                        <li>
                                            <a href="edit-sales.php" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" class="me-2"
                                                    alt="img">Edit
                                                Sale</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#showpayment"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/dollar-square.svg"
                                                    class="me-2" alt="img">Show
                                                Payments</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#createpayment"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/plus-circle.svg"
                                                    class="me-2" alt="img">Create
                                                Payment</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download
                                                pdf</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item confirm-text"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/delete1.svg"
                                                    class="me-2" alt="img">Delete
                                                Sale</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>