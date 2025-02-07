<?php include('../../include/header.php'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Tax report</h4>
                <h6>Manage your Tax report</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="tabs-set">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab"
                                data-bs-target="#purchase" type="button" role="tab" aria-controls="purchase"
                                aria-selected="true">Purchase Tax Report</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale"
                                type="button" role="tab" aria-controls="salw" aria-selected="false">Sale Tax
                                Report</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                            aria-labelledby="purchase-tab">
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-path">
                                        <a class="btn btn-filter" id="filter_search">
                                            <img src="<?php echo SITE_URL; ?>assets/img/icons/filter.svg" alt="img">
                                            <span><img src="<?php echo SITE_URL; ?>assets/img/icons/closes.svg"
                                                    alt="img"></span>
                                        </a>
                                    </div>
                                    <div class="search-input">
                                        <a class="btn btn-searchset"><img
                                                src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg"
                                                alt="img"></a>
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
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/excel.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/printer.svg"
                                                    alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card" id="filter_inputs">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="From Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg"
                                                            alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="To Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg"
                                                            alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Choose Suppliers</option>
                                                    <option>Suppliers</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                            <div class="form-group">
                                                <a class="btn btn-filters ms-auto"><img
                                                        src="<?php echo SITE_URL; ?>assets/img/icons/search-whites.svg"
                                                        alt="img"></a>
                                            </div>
                                        </div>
                                    </div>
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
                                            <th>Supplier</th>
                                            <th>Date</th>
                                            <th>Ref No</th>
                                            <th>Total Amount</th>
                                            <th>Payment Method</th>
                                            <th>Discount</th>
                                            <th>Tax Amount</th>
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
                                            <td>Lavi</td>
                                            <td>12 Jul 2023</td>
                                            <td>#4237300</td>
                                            <td>$30,000</td>
                                            <td>PayPal</td>
                                            <td>10</td>
                                            <td>$457</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>Anthony</td>
                                            <td>18 Aug 2023</td>
                                            <td>#5628954</td>
                                            <td>$40,000</td>
                                            <td>Stripe</td>
                                            <td>12</td>
                                            <td>$265</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>Tracy</td>
                                            <td>23 Sep 2023</td>
                                            <td>#7590325</td>
                                            <td>$52,000</td>
                                            <td>PayPal</td>
                                            <td>20</td>
                                            <td>$382</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>Victor</td>
                                            <td>05 Sep 2023</td>
                                            <td>#9814586</td>
                                            <td>$18,000</td>
                                            <td>PayPal</td>
                                            <td>15</td>
                                            <td>$561</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sale" role="tabpanel">
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-path">
                                        <a class="btn btn-filter" id="filter_search2">
                                            <img src="<?php echo SITE_URL; ?>assets/img/icons/filter.svg" alt="img">
                                            <span><img src="<?php echo SITE_URL; ?>assets/img/icons/closes.svg"
                                                    alt="img"></span>
                                        </a>
                                    </div>
                                    <div class="search-input">
                                        <a class="btn btn-searchset"><img
                                                src="<?php echo SITE_URL; ?>assets/img/icons/search-white.svg"
                                                alt="img"></a>
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
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/excel.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                    src="<?php echo SITE_URL; ?>assets/img/icons/printer.svg"
                                                    alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card" id="filter_inputs2">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="From Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg"
                                                            alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="To Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="<?php echo SITE_URL; ?>assets/img/icons/calendars.svg"
                                                            alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Choose Customer</option>
                                                    <option>Customer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                            <div class="form-group">
                                                <a class="btn btn-filters ms-auto"><img
                                                        src="<?php echo SITE_URL; ?>assets/img/icons/search-whites.svg"
                                                        alt="img"></a>
                                            </div>
                                        </div>
                                    </div>
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
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Invoice Number</th>
                                            <th>Total Amount</th>
                                            <th>Payment Method</th>
                                            <th>Discount</th>
                                            <th>Tax Amount</th>
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
                                            <td>Lavi</td>
                                            <td>12 Jul 2023</td>
                                            <td>INV2750916</td>
                                            <td>$30,000</td>
                                            <td>PayPal</td>
                                            <td>10</td>
                                            <td>$457</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>Anthony</td>
                                            <td>18 Aug 2023</td>
                                            <td>INV2750913</td>
                                            <td>$40,000</td>
                                            <td>Stripe</td>
                                            <td>12</td>
                                            <td>$265</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>Tracy</td>
                                            <td>23 Sep 2023</td>
                                            <td>INV2750939</td>
                                            <td>$52,000</td>
                                            <td>PayPal</td>
                                            <td>20</td>
                                            <td>$382</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>Victor</td>
                                            <td>05 Sep 2023</td>
                                            <td>INV2750987</td>
                                            <td>$18,000</td>
                                            <td>PayPal</td>
                                            <td>15</td>
                                            <td>$561</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="searchpart">
    <div class="searchcontent">
        <div class="searchhead">
            <h3>Search </h3>
            <a id="closesearch"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </div>
        <div class="searchcontents">
            <div class="searchparts">
                <input type="text" placeholder="search here">
                <a class="btn btn-searchs">Search</a>
            </div>
            <div class="recentsearch">
                <h2>Recent Search</h2>
                <ul>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Settings</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Report</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Invoice</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Sales</h6>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../../include/footer.php'); ?>