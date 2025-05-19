
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
  ## ❗ Problem Statement

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

  ### 1. **⚡ Frontend (PHP, HTML, JS, CSS)**
  - Hosted on **XAMPP** as Local Server in `htdocs`.
  - Navigation menu includes:
    - **Home** – Carousel with company highlights
    - **Insert** – Form-based record entry
    - **Review Form** – View data entries
    - **Audit Form** – Track changes to DB tables
    - **Process** – Run packaged procedures for transactions
    - **Spending** – View costs/profit tracking
    - **Logout** – End session

  ### 2. **♾️ Backend (Oracle PL/SQL)**
  - Oracle database with structured tables:
    - `Customers`, `Employees`, `Cars_Inventory`, `Car_Stock`, `Transactions`, `Audit_Log`
  - Includes:
    - **Triggers** to record changes to the audit log
    - **Stored Procedures** for inserting sales and managing stock
    - **Packages** (e.g., `car_sales_pkg`) to group logic

  ---

  ## 🔧 Database Structure

  ### 🧰 Tables
  - Customers
  - Employees
  - Cars Inventory
  - Car Stock
  - Transactions
  - Audit Log

  ### 💡 Constraints
  - Primary Keys, Foreign Keys
  - NOT NULL, UNIQUE, CHECK constraints

  ---


  ## 🔢 SQL Components

  ### 🛠️ Procedures
  - Automates tasks like inserting transactions and updating stock in a single call.

  ### 💡 Functions
  - Calculates values like total spending by a customer, which can be reused in queries or reports

  ### 👀 Cursors
  - Handles row-by-row processing of data, such as displaying all car sales in a loop

  ### 📦 Packages
  - StudentManagement: Handle attendance and grade fetching

  ### 🚧 Triggers
  - Groups related procedures and functions into one unit for better organization and reusability.


  ---

  ## 💼 Tools Used

  - Oracle Database 21c
  - Visual Studio Code
  - SQL Developer Extension 
  - Xampp for Hosting
  - GitHub for version control

  ---


  ## 📅 Timeline

  **Phase I: Project Goal ✅**

  Managing a car dealership manually can be time-consuming and error-prone. This project automates the 
  dealership’s essential operations using a modern tech stack. 

  **Phase II: Logical Design ✅**

  -Entity-Relationship Diagrams (ERDs) were created to define all entities and their relationships. Primary keys, foreign keys, and normalization (up to 3NF) were applied to remove 
   redundancy. Data types and constraints were applied as per business rules.

  ![ERD 1](https://github.com/Dushimimanaprince/Cars-Dealership-Final-/blob/1d857561a5facb0374abd309dfb0d6f11534acde/proj/screenshot/ERD.png)

  **Phase IV: Database Creation ✅**
- Tables were physically created in Oracle using SQL DDL scripts. Sequences were defined for ID generation. Indexes and integrity constraints were enforced to ensure consistent and 
  valid data entry.

![CREATING DATABASE CONNECTION](https://github.com/Dushimimanaprince/Cars-Dealership-Final-/blob/c47520fd09b25b049d4848966c00643c7140c3cb/proj/screenshot/1.png)

 **Phase V: Data Insertion and Validation ✅**
-Sample records with realistic Rwandan student and instructor names were inserted. Test data respected all constraints. Data was validated for consistency, and foreign key relationships 
 were properly tested using both attendance and grades records.
![INSERT INTO CUSTOMERS via Webpage](https://github.com/Dushimimanaprince/Cars-Dealership-Final-/blob/c47520fd09b25b049d4848966c00643c7140c3cb/proj/screenshot/Insert.png)

 **Phase VI: Procedures, Functions, Triggers, Packages ✅**
- Custom PL/SQL components were developed:
Procedure: Automates tasks like inserting transactions and updating stock in a single call.

Trigger: Automatically logs every data change into the audit table after key actions (insert, update, delete).

Function: Calculates values like total spending by a customer, which can be reused in queries or reports.

Cursor: Handles row-by-row processing of data, such as displaying all car sales in a loop.

Package: Groups related procedures and functions into one unit for better organization and reusability.

**Phase VII: Final Documentation & Presentation ✅**
- [tue_27185_confiance_plsql2.pptx](https://github.com/Dushimimanaprince/Cars-Dealership-Final-/blob/2346267fedcd0d040779b08cb6c5633de01428d7/proj/Car_Sales_Project_Presentation.pptx)


## 📄 License

This project is submitted as part of the Capstone Project for Database Development with PL/SQL By Dushimimana Prince

---

> "Code is like humor. When you have to explain it, it’s bad." – Cory House

---
