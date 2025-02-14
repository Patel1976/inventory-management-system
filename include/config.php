<?php
// Define the Base URL dynamically
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/projects/Inventory-Management-System/');

// Define Core Pages
define('DASHBOARD_URL', SITE_URL . 'index.php');
define('SIGNIN_URL', SITE_URL . 'signin.php');
define('SIGNUP_URL', SITE_URL . 'signup.php');
define('FORGOT_URL', SITE_URL . 'forgetpassword.php');
define('LOGOUT_URL', SITE_URL . 'logout.php');

// Settings & User Management
define('ADD_PERMISSION_URL', SITE_URL . 'admin/setting/add-permission.php');
define('CURRENCY_SETTINGS_URL', SITE_URL . 'admin/setting/currency-settings.php');
define('EDIT_PERMISSION_URL', SITE_URL . 'admin/setting/edit-permission.php');
define('EMAIL_SETTINGS_URL', SITE_URL . 'admin/setting/email-settings.php');
define('GENERAL_SETTINGS_URL', SITE_URL . 'admin/setting/general-settings.php');
define('PAYMENT_SETTINGS_URL', SITE_URL . 'admin/setting/payment-settings.php');
define('PERMISSION_URL', SITE_URL . 'admin/setting/permissions.php');
define('TAX_RATES_URL', SITE_URL . 'admin/setting/taxrates.php');
define('UNIT_URL', SITE_URL . 'admin/setting/units.php');
define('PROFILE_URL', SITE_URL . 'profile.php');
define('ADD_USER_URL', SITE_URL . 'admin/user/add-user.php');
define('EDIT_USER_URL', SITE_URL . 'admin/user/edit-user.php');
define('USERS_URL', SITE_URL . 'admin/user/user-list.php');

// Product Management
define('ADD_BRAND_URL', SITE_URL . 'admin/product/add-brand.php');
define('ADD_CATEGORY_URL', SITE_URL . 'admin/product/add-category.php');
define('ADD_PRODUCT_URL', SITE_URL . 'admin/product/add-product.php');
define('BRAND_URL', SITE_URL . 'admin/product/brand-list.php');
define('CATEGORY_URL', SITE_URL . 'admin/product/category-list.php');
define('EDIT_BRAND_URL', SITE_URL . 'admin/product/edit-brand.php');
define('EDIT_CATEGORY_URL', SITE_URL . 'admin/product/edit-category.php');
define('EDIT_PRODUCT_URL', SITE_URL . 'admin/product/edit-product.php');
define('PRODUCT_DETAILS_URL', SITE_URL . 'admin/product/product-details.php');
define('PRODUCT_URL', SITE_URL . 'admin/product/product-list.php');

// Sales & Purchases
define('ADD_SALE_URL', SITE_URL . 'admin/sale/add-sales.php');
define('EDIT_SALE_URL', SITE_URL . 'admin/sale/edit-sales.php');
define('SALE_DETAILS_URL', SITE_URL . 'admin/sale/sales-details.php');
define('SALE_URL', SITE_URL . 'admin/sale/sales-list.php');
define('ADD_PURCHASE_URL', SITE_URL . 'admin/purchase/add-purchase.php');
define('EDIT_PURCHASE_URL', SITE_URL . 'admin/purchase/edit-purchase.php');
define('PURCHASE_URL', SITE_URL . 'admin/purchase/purchase-list.php');

// Customers & Suppliers & Store
define('ADD_CUSTOMER_URL', SITE_URL . 'admin/people/add-customer.php');
define('ADD_STORE_URL', SITE_URL . 'admin/people/add-store.php');
define('ADD_SUPPLIER_URL', SITE_URL . 'admin/people/add-supplier.php');
define('CUSTOMER_URL', SITE_URL . 'admin/people/customer-list.php');
define('EDIT_CUSTOMER_URL', SITE_URL . 'admin/people/edit-customer.php');
define('EDIT_STORE_URL', SITE_URL . 'admin/people/edit-store.php');
define('EDIT_SUPPLIER_URL', SITE_URL . 'admin/people/edit-supplier.php');
define('STORE_URL', SITE_URL . 'admin/people/store-list.php');
define('SUPPLIER_URL', SITE_URL . 'admin/people/supplier-list.php');

// Reports
define('CUSTOMER_REPORT_URL', SITE_URL . 'admin/reports/customer-report.php');
define('INVENTORY_REPORT_URL', SITE_URL . 'admin/reports/inventory-report.php');
define('EXPENSE_REPORT_URL', SITE_URL . 'admin/reports/expense-report.php');
define('TAX_REPORT_URL', SITE_URL . 'admin/reports/tax-report.php');
define('PURCHASE_REPORT_URL', SITE_URL . 'admin/reports/purchase-report.php');
define('SALES_REPORT_URL', SITE_URL . 'admin/reports/sales-report.php');
define('SUPPLIER_REPORT_URL', SITE_URL . 'admin/reports/supplier-report.php');

// Expense Management
define('ADD_EXPENSE_URL', SITE_URL . 'admin/expense/add-expense.php');
define('EDIT_EXPENSE_URL', SITE_URL . 'admin/expense/edit-expense.php');
define('EXPENSE_CATEGORY_URL', SITE_URL . 'admin/expense/expense-category.php');
define('EXPENSE_URL', SITE_URL . 'admin/expense/expense-list.php');


// Return
define('ADD_PURCHASE_RETURN_URL', SITE_URL . 'admin/return/add-purchase-return.php');
define('ADD_SALE_RETURN_URL', SITE_URL . 'admin/return/add-sale-return.php');
define('EDIT_PURCHASE_RETURN_URL', SITE_URL . 'admin/return/edit-purchase-return.php');
define('EDIT_SALE_RETURN_URL', SITE_URL . 'admin/return/edit-sale-return.php');
define('PURCHASE_RETURN_URL', SITE_URL . 'admin/return/purchase-return-list.php');
define('SALE_RETURN_URL', SITE_URL . 'admin/return/sale-return-list.php');

// Adjustments
define('ADD_STOCK_ADJUSTMENT_URL', SITE_URL . 'admin/adjustment/add-stock-adjustment.php');
define('EDIT_STOCK_ADJUSTMENT_URL', SITE_URL . 'admin/adjustment/edit-stock-adjustment.php');
define('STOCK_ADJUSTMENT_URL', SITE_URL . 'admin/adjustment/stock-adjustment-list.php');