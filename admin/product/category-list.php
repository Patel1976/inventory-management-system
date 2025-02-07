<?php include('../../include/header.php'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Category list</h4>
                <h6>View/Search product Category</h6>
            </div>
            <div class="page-btn">
                <a href="add-category.php" class="btn btn-added">
                    <img src="<?php echo SITE_URL; ?>assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="<?php echo SITE_URL; ?>assets/img/icons/filter.svg" alt="img">
                                <span><img src="<?php echo SITE_URL; ?>assets/img/icons/closes.svg" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg" alt="img"></a>
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

                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Category</option>
                                        <option>Computers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto"><img src="<?php echo SITE_URL; ?>assets/img/icons/search-whites.svg"
                                            alt="img"></a>
                                </div>
                            </div>
                        </div>
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
                                <th>Category name</th>
                                <th>Description</th>
                                <th>Status</th>
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Computers</a>
                                </td>
                                <td>Computers Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="edit-category.php">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Fruits</a>
                                </td>
                                <td>Fruits Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="edit-category.php">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Fruits</a>
                                </td>
                                <td>Fruits Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="edit-category.php">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Fruits</a>
                                </td>
                                <td>Fruits Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="edit-category.php">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="edit-category.php">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="edit-category.php">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="edit-category.php">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="editcategory.html">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="editcategory.html">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="editcategory.html">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="editcategory.html">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="editcategory.html">
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
                                        <img src="<?php echo SITE_URL; ?>assets/img/product/noimage.png" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Accessories</a>
                                </td>
                                <td>Accessories Description</td>
                                <td>Active</td>
                                <td>
                                    <a class="me-3" href="editcategory.html">
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