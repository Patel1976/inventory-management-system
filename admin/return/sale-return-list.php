<?php include('../../include/header.php'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Return List</h4>
                <h6>Manage your Returns</h6>
            </div>
            <div class="page-btn">
                <a href="add-sale-return.php" class="btn btn-added"><img
                        src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" alt="img" class="me-2">Add New Sales
                    Return</a>
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
                                <th>Product Name</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Grand Total ($)</th>
                                <th>Paid ($)</th>
                                <th>Due ($)</th>
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
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/product6.jpg" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Macbook Pro</a>
                                </td>
                                <td>19 Nov 2022</td>
                                <td>Best Power Tools</td>
                                <td><span class="badges bg-lightgreen">Received</span></td>
                                <td>210</td>
                                <td>120</td>
                                <td>210</td>
                                <td><span class="badges bg-lightgreen">paid</span></td>
                                <td>
                                    <a class="me-3" href="editsalesreturn.html">
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
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/product7.jpg" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Apple Earpods</a>
                                </td>
                                <td>19 Nov 2022</td>
                                <td>Apex Computers</td>
                                <td><span class="badges bg-lightyellow">Ordered</span></td>
                                <td>1000</td>
                                <td>500</td>
                                <td>1000</td>
                                <td><span class="badges bg-lightyellow">Partial</span></td>
                                <td>
                                    <a class="me-3" href="editsalesreturn.html">
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