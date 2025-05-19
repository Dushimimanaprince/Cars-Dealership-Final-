# 🚗 Car Sales Management System

A robust, end-to-end Car Sales Management System designed for **car dealerships** to manage their operations efficiently — from **customer and employee records** to **car inventory, stock, transactions**, and **automated audit logs**. Built using a **PHP frontend** and **Oracle PL/SQL backend**, this system demonstrates how modern web applications can work seamlessly with enterprise-grade databases.

---

## 📌 Project Purpose

Managing a car dealership manually can be time-consuming and error-prone. This project automates the dealership’s essential operations using a modern tech stack. 

Key goals include:
- 📋 Automate the data entry for customers, employees, and vehicles.
- 📈 Track sales transactions, stock updates, and vehicle availability.
- 🔐 Maintain an **audit log** for every change in critical tables.
- 📦 Implement **PL/SQL packages and procedures** for centralized business logic.
- 🌐 Provide a **clean, user-friendly web interface** (dark mode) for staff interaction.

---

## 🧠 How It Works

### 1. **Frontend (PHP, HTML, JS, CSS)**
- Hosted on **XAMPP** in `htdocs`.
- Navigation menu includes:
  - **Home** – Carousel with company highlights
  - **Insert** – Form-based record entry
  - **Review Form** – View data entries
  - **Audit Form** – Track changes to DB tables
  - **Process** – Run packaged procedures for transactions
  - **Spending** – View costs/profit tracking
  - **Logout** – End session

### 2. **Backend (Oracle PL/SQL)**
- Oracle database with structured tables:
  - `Customers`, `Employees`, `Cars_Inventory`, `Car_Stock`, `Transactions`, `Audit_Log`
- Includes:
  - **Triggers** to record changes to the audit log
  - **Stored Procedures** for inserting sales and managing stock
  - **Packages** (e.g., `car_sales_pkg`) to group logic

---

## 🧱 Database Schema

#### ➤ Customers Table
```sql
CREATE TABLE Customers (
    Customer_ID NUMBER PRIMARY KEY,
    Name VARCHAR2(100),
    Contact_Number VARCHAR2(20),
    Email VARCHAR2(100)
);
