# 🧾 Inventory Management System

A complete **Inventory Management System** built using **PHP**, **MySQL**, **HTML**, **CSS**, **JavaScript**, and **Bootstrap**.  
This project efficiently manages products, sales, purchases, expenses, returns, stock adjustments, reports, and users with an intuitive and dynamic dashboard.

---

## 🚀 Features

### 🧩 Core Modules
1. **Product Management**
   - Product List & Add Product
   - Category List & Add Category
   - Brand List & Add Brand

2. **Sales Management**
   - Add Sale & Manage Sale List
   - Automatic stock deduction on sale

3. **Purchase Management**
   - Add Purchase & Purchase List
   - Stock auto-increment on purchase

4. **Expense Management**
   - Add Expense & Manage Expenses
   - Expense Category List

5. **Stock Adjustment**
   - Add Adjustment
   - Manage Quantity Corrections

6. **Return Management**
   - Sale Return List & Add Sale Return
   - Purchase Return List & Add Purchase Return

7. **People Management**
   - Customers, Suppliers, and Store Management

8. **Reports**
   - Sale, Purchase, Inventory, Expense, Supplier, Customer, and Tax Reports

9. **User Management**
   - Add / Manage Users
   - Assign Roles and Permissions

10. **Settings**
    - General, Email, Payment, Currency, Permission, and Tax Rate Settings

11. **Dashboard**
    - Overview of Sales, Purchases, and Stock
    - Real-time charts and insights

---

## 📊 Dashboard Overview

- **Sales & Purchase Reports:** Bar charts using Chart.js  
- **Top Selling Products:** Doughnut chart visualization  
- **Stock Alerts:** Low-stock notification list  
- **Top Customers:** Based on purchase volume  
- **Real-Time Analytics:** Powered by PHP and Chart.js  

---

## 🧠 Key Functionalities

- 🔄 **Automatic Stock Update:**  
  Real-time stock adjustments on add/edit/delete of sales and purchases.
  
- 🧾 **Comprehensive Reports:**  
  Generate detailed insights for inventory, sales, and expenses.

- 👥 **Role-Based Access Control:**  
  Manage user permissions for secure multi-user operation.

- ⚙️ **Dynamic AJAX Forms:**  
  Smooth user experience with no page reloads.

- 📱 **Responsive Design:**  
  Built with Bootstrap for mobile-friendly access.

---

## 🏗️ Project Architecture

```
inventory-management-system/
├── index.php
├── /modules/
│   ├── /product/
│   ├── /sale/
│   ├── /purchase/
│   ├── /expense/
│   ├── /return/
│   ├── /report/
│   └── ...
├── /classes/
│   ├── Product.php
│   ├── Sale.php
│   ├── Purchase.php
│   ├── Report.php
│   ├── Dashboard.php
│   └── ...
├── /assets/
│   ├── /css/
│   ├── /js/
│   │   └── chart_data.js
│   ├── /images/
│   └── /plugins/
├── /includes/
│   ├── db.php
│   ├── header.php
│   ├── footer.php
│   └── sidebar.php
└── README.md
```

---

## 🧩 Technologies Used

| Category        | Technology |
|-----------------|-------------|
| **Frontend**    | HTML, CSS, JavaScript, Bootstrap |
| **Backend**     | PHP (Core PHP with OOP) |
| **Database**    | MySQL |
| **Charts**      | Chart.js |
| **Environment** | XAMPP |

---

## ⚙️ Installation Guide

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/inventory-management-system.git
```

### 2️⃣ Move Project to XAMPP Directory
Copy the project folder into:
```
C:\xampp\htdocs\
```

### 3️⃣ Create Database
- Start **XAMPP** and open **phpMyAdmin**
- Create a new database (e.g. `inventory_db`)
- Import the provided SQL file (`database.sql` if included)

### 4️⃣ Configure Database Connection
Open `/includes/db.php` and update credentials:
```php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "inventory_db";
```

### 5️⃣ Run the Project
Open your browser and navigate to:
```
http://localhost/inventory-management-system
```

---

## 📸 Screenshots

> Add your project screenshots here (Dashboard, Product Page, Reports, etc.)

Example:
```
/assets/images/screenshots/dashboard.png
/assets/images/screenshots/product-list.png
```

---

## 🧑‍💻 Author

**Harsh Patel**  
💼 Full Stack Developer | PHP | JavaScript | MySQL  
📧 hp1241976@gmail.com  

---

## 📝 License

This project is **open-source**.

---

⭐ **If you like this project, consider giving it a star on GitHub!**
