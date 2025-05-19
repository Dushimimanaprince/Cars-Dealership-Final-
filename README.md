
# 🚗 Car Sales Management System
---

## 📅 Project Details

- **Student Name**: DUSHIMIMANA Prince
- **Student ID**: 27555
- **Lecturer**: Eric Maniraguha
- **Course Code & Name**: INSY 8311 - Database Development with PL/SQL
- **Academic Year**: 2024-2025
---

## 🌐 Introduction
The Car Sales Management System is a web-based project made to help car dealers manage their daily business easily. This system allows users to add and view details about customers, employees, available cars, stock, and sales transactions — all in one place.

It is built using PHP for the frontend and Oracle (PL/SQL) for the backend. It also includes an audit log feature that automatically keeps track of any changes made to important data. With a clean user interface and helpful features, the system makes car dealership management simpler, faster, and more organized.
Whether it’s adding a new customer, selling a car, or checking what vehicles are in stock, this system helps you handle everything smoothly.

---
##❗ Problem Statement

The Car Sales Management System is designed to solve the following challenges:

🔍 Manual Data Handling: Car dealerships often use paperwork or spreadsheets to manage customer and vehicle data, leading to errors and inefficiencies.

📦 Lack of Stock Tracking: There's no easy way to keep track of how many cars are available vs. sold, which can cause confusion and missed sales opportunities.

🧾 No Centralized Sales Records: Sales transactions are not organized or easily accessible, making it hard to track performance or find details quickly.

👥 No Employee Tracking: Dealerships struggle to assign responsibility or track which employee handled which transaction.

🛠️ No Automation or Auditing: Important actions (like inserting or deleting data) aren’t logged automatically, which creates accountability issues and risks of data tampering.
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
## 📊 Entity-Relationship Diagram (ERD)

**Entities:**
- Customers
- Employees
- Cars Inventory
- Car Stock
- Transactions
- Audit Log

**🔗 Relationships:** 
- Customers buy vehicles through transactions.
- Employees manage vehicle sales.
- Vehicles listed in inventory link to stock records.
- Transactions update stock by adjusting sold and available units.
- Audit log records all data changes via triggers.

---

## 🧠 How It Works

### 1. ** ⚡ Frontend (PHP, HTML, JS, CSS)**
- Hosted on **XAMPP** as Local Server in `htdocs`.
- Navigation menu includes:
  - **Home** – Carousel with company highlights
  - **Insert** – Form-based record entry
  - **Review Form** – View data entries
  - **Audit Form** – Track changes to DB tables
  - **Process** – Run packaged procedures for transactions
  - **Spending** – View costs/profit tracking
  - **Logout** – End session

### 2. ** ♾️ Backend (Oracle PL/SQL)**
- Oracle database with structured tables:
  - `Customers`, `Employees`, `Cars_Inventory`, `Car_Stock`, `Transactions`, `Audit_Log`
- Includes:
  - **Triggers** to record changes to the audit log
  - **Stored Procedures** for inserting sales and managing stock
  - **Packages** (e.g., `car_sales_pkg`) to group logic

---

