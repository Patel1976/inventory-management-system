<?php include('../../include/header.php'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>PURCHASE LIST</h4>
                <h6>Manage your purchases</h6>
            </div>
            <div class="page-btn">
                <a href="add-purchase.php" class="btn btn-added">
                    <img src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img">Add New Purchases
                </a>
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
                                <th>Reference</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Payment Status</th>
                                <th>Action</th>
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
                                <td class="text-bolds">Apex Computers</td>
                                <td>PT001</td>
                                <td>19 Nov 2022</td>
                                <td><span class="badges bg-lightgreen">Received</span></td>
                                <td>550</td>
                                <td>120</td>
                                <td>550</td>
                                <td><span class="badges bg-lightgreen">Paid</span></td>
                                <td>
                                    <a class="me-3" href="edit-purchase.php">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="img">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="text-bolds">Modern Automobile</td>
                                <td>PT002</td>
                                <td>19 Nov 2022</td>
                                <td><span class="badges bg-lightgreen">Received</span></td>
                                <td>410</td>
                                <td>410</td>
                                <td>410</td>
                                <td><span class="badges bg-lightgreen">Paid</span></td>
                                <td>
                                    <a class="me-3" href="edit-purchase.php">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="img">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="text-bolds">AIM Infotech</td>
                                <td>PT003</td>
                                <td>19 Nov 2022</td>
                                <td><span class="badges bg-lightred">Pending</span></td>
                                <td>210</td>
                                <td>120</td>
                                <td>210</td>
                                <td><span class="badges bg-lightred">Unpaid</span></td>
                                <td>
                                    <a class="me-3" href="edit-purchase.php">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="img">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="text-bolds">Best Power Tools</td>
                                <td>PT004</td>
                                <td>19 Nov 2022</td>
                                <td><span class="badges bg-lightgreen">Received</span></td>
                                <td>210</td>
                                <td>120</td>
                                <td>210</td>
                                <td><span class="badges bg-lightred">Unpaid</span></td>
                                <td>
                                    <a class="me-3" href="editpurchase.html">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="img">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="text-bolds">Best Power Tools</td>
                                <td>PT005</td>
                                <td>19 Nov 2022</td>
                                <td><span class="badges bg-lightred">Pending</span></td>
                                <td>210</td>
                                <td>120</td>
                                <td>210</td>
                                <td><span class="badges bg-lightred">UnPaid</span></td>
                                <td>
                                    <a class="me-3" href="editpurchase.html">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/delete.svg" alt="img">
                                    </a>
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