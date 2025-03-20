<?php include('config.php'); 
include($_SERVER['DOCUMENT_ROOT'] . "/projects/Inventory-Management-System/login_check.php");
include($_SERVER['DOCUMENT_ROOT'] . "/projects/Inventory-Management-System/db_connection.php"); 
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$general_settings = $conn->query("SELECT * FROM general_settings")->fetch_assoc();
$company_logo = !empty($general_settings['company_logo']) ? SITE_URL . 'uploads/logo/' . $general_settings['company_logo'] : SITE_URL . 'assets/img/inventory-logo.png';
$favicon = !empty($general_settings['favicon_icon']) ? SITE_URL . 'uploads/logo/' . $general_settings['favicon_icon'] : SITE_URL . 'assets/img/favicon.png';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Inventory Management System">
    <meta name="author" content="IMS">
    <title>Inventory Management System</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL; ?>assets/img/favicon.png">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/animate.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/owlcarousel/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/style.css">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="<?= DASHBOARD_URL ?>" class="logo">
                    <img src="<?php echo $company_logo; ?>" alt="">
                </a>
                <a href="<?= DASHBOARD_URL ?>" class="logo-small">
                    <img src="<?php echo $favicon; ?>" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevrons-left feather-16">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </a>
            </div>
            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="<?php echo SITE_URL . 'uploads/profile/' . ($user['image'] ?? 'user.png'); ?>" alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="<?php echo SITE_URL . 'uploads/profile/' . ($user['image'] ?? 'user.png'); ?>"
                                        alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6><?php echo htmlspecialchars($user['name']); ?></h6>
                                    <h5><?php echo htmlspecialchars($user['role']); ?></h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="<?= PROFILE_URL ?>"> <i class="me-2" data-feather="user"></i>
                                My
                                Profile</a>
                            <a class="dropdown-item" href="<?= GENERAL_SETTINGS_URL ?>"><i class="me-2"
                                    data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="<?= LOGOUT_URL ?>"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/log-out.svg" class="me-2"
                                    alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?= PROFILE_URL ?>">My Profile</a>
                    <a class="dropdown-item" href="<?= GENERAL_SETTINGS_URL ?>">Settings</a>
                    <a class="dropdown-item" href="<?= SIGNIN_URL ?>">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="">
                            <a href="<?= DASHBOARD_URL ?>"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/dashboard.svg" alt="img"><span>
                                    Dashboard</span> </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="<?php echo SITE_URL; ?>assets/img/icons/product.svg"
                                    alt="img"><span>
                                    Product</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= PRODUCT_URL ?>">Product List</a></li>
                                <li><a href="<?= ADD_PRODUCT_URL ?>">Add Product</a></li>
                                <li><a href="<?= CATEGORY_URL ?>">Category List</a></li>
                                <li><a href="<?= ADD_CATEGORY_URL ?>">Add Category</a></li>
                                <li><a href="<?= BRAND_URL ?>">Brand List</a></li>
                                <li><a href="<?= ADD_BRAND_URL ?>">Add Brand</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="<?php echo SITE_URL; ?>assets/img/icons/sales1.svg"
                                    alt="img"><span>
                                    Sales</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= SALE_URL ?>">Sales List</a></li>
                                <li><a href="<?= ADD_SALE_URL ?>">Add Sales</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/purchase1.svg" alt="img"><span>
                                    Purchase</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= PURCHASE_URL ?>">Purchase List</a></li>
                                <li><a href="<?= ADD_PURCHASE_URL ?>">Add Purchase</a></li>
                            </ul>
                        </li>
                        <!-- <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/expense1.svg" alt="img"><span>
                                    Expense</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= EXPENSE_URL ?>">Expense List</a></li>
                                <li><a href="<?= ADD_EXPENSE_URL ?>">Add Expense</a></li>
                                <li><a href="<?= EXPENSE_CATEGORY_URL ?>">Expense Category</a></li>
                            </ul>
                        </li> -->
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/transfer1.svg" alt="img"><span>
                                    Stock Adjustment</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= STOCK_ADJUSTMENT_URL ?>">Adjustment List</a></li>
                                <li><a href="<?= ADD_STOCK_ADJUSTMENT_URL ?>">Add Adjustment</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="<?php echo SITE_URL; ?>assets/img/icons/return1.svg"
                                    alt="img"><span>
                                    Return</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= SALE_RETURN_URL ?>">Sales Return List</a></li>
                                <li><a href="<?= ADD_SALE_RETURN_URL ?>">Add Sales Return </a></li>
                                <li><a href="<?= PURCHASE_RETURN_URL ?>">Purchase Return List</a></li>
                                <li><a href="<?= ADD_PURCHASE_RETURN_URL ?>">Add Purchase Return </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="<?php echo SITE_URL; ?>assets/img/icons/users1.svg"
                                    alt="img"><span>
                                    People</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= CUSTOMER_URL ?>">Customer List</a></li>
                                <li><a href="<?= ADD_CUSTOMER_URL ?>">Add Customer </a></li>
                                <li><a href="<?= SUPPLIER_URL ?>">Supplier List</a></li>
                                <li><a href="<?= ADD_SUPPLIER_URL ?>">Add Supplier </a></li>
                                <li><a href="<?= STORE_URL ?>">Store List</a></li>
                                <li><a href="<?= ADD_STORE_URL ?>">Add Store</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="<?php echo SITE_URL; ?>assets/img/icons/time.svg"
                                    alt="img"><span>
                                    Report</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= SALES_REPORT_URL ?>">Sales Report</a></li>
                                <li><a href="<?= PURCHASE_REPORT_URL ?>">Purchase Report</a></li>
                                <li><a href="<?= INVENTORY_REPORT_URL ?>">Inventory Report</a></li>
                                <li><a href="<?= SUPPLIER_REPORT_URL ?>">Supplier Report</a></li>
                                <li><a href="<?= CUSTOMER_REPORT_URL ?>">Customer Report</a></li>
                                <!-- <li><a href="<?= EXPENSE_REPORT_URL ?>">Expense Report</a></li> -->
                                <li><a href="<?= TAX_REPORT_URL ?>">Tax report</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="<?php echo SITE_URL; ?>assets/img/icons/users1.svg"
                                    alt="img"><span>
                                    Users</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= USERS_URL ?>">Users List</a></li>
                                <li><a href="<?= ADD_USER_URL ?>">Add User </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img
                                    src="<?php echo SITE_URL; ?>assets/img/icons/settings.svg" alt="img"><span>
                                    Settings</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= GENERAL_SETTINGS_URL ?>">General Settings</a></li>
                                <!-- <li><a href="<?= EMAIL_SETTINGS_URL ?>">Email Settings</a></li> -->
                                <li><a href="<?= PAYMENT_SETTINGS_URL ?>">Payment Settings</a></li>
                                <li><a href="<?= CURRENCY_SETTINGS_URL ?>">Currency Settings</a></li>
                                <!-- <li><a href="<?= PERMISSION_URL ?>">Group Permissions</a></li> -->
                                <li><a href="<?= TAX_RATES_URL ?>">Tax Rates</a></li>
                                <li><a href="<?= UNIT_URL ?>">Units</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="<?= LOGOUT_URL ?>">
                                <img src="<?php echo SITE_URL; ?>assets/img/icons/logout.svg" alt="img"><span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>