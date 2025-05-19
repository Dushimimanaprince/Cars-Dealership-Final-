<?php
$host = "localhost";
$port = "1521";
$service_name = "prince27555";
$username = "system";
$password = "prince";
$connection_string = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SERVICE_NAME=$service_name)))";

$conn = oci_connect($username, $password, $connection_string);

if (!$conn) {
    die("Connection failed: " . oci_error()['message']);
}

$form_type = $_POST['form_type'];

switch ($form_type) {
    case "customer":
        $sql = "INSERT INTO Customers (Customer_ID, Name, Contact_Number, Email) VALUES (:id, :name, :contact, :email)";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":id", $_POST['customer_id']);
        oci_bind_by_name($stmt, ":name", $_POST['customer_name']);
        oci_bind_by_name($stmt, ":contact",$_POST['customer_contact']);
        oci_bind_by_name($stmt, ":email", $_POST['customer_email']);
        break;

    case "employee":
        $sql = "INSERT INTO Employees (Employee_ID, Name, Role, Contact_Number) VALUES (:id, :name, :role, :contact)";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":id", $_POST['employee_id']);
        oci_bind_by_name($stmt, ":name", $_POST['employee_name']);
        oci_bind_by_name($stmt, ":role", $_POST['employee_role']);
        oci_bind_by_name($stmt, ":contact", $_POST['employee_contact']);
        break;

    case "car":
        $sql = "INSERT INTO Cars_Inventory (Vehicle_ID, Make, Model, Price) 
                VALUES (:id, :make, :model, :price)";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":id", $_POST['vehicle_id']);
        oci_bind_by_name($stmt, ":make", $_POST['make']);
        oci_bind_by_name($stmt, ":model", $_POST['model']);
        oci_bind_by_name($stmt, ":price", $_POST['price']);
        break;

    case "transaction":
        $sql = "INSERT INTO Transactions (Transaction_ID, Customer_ID, Vehicle_ID, Sale_Date) 
                VALUES (:tid, :cid, :vid, TO_DATE(:sdate, 'YYYY-MM-DD'))";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":tid", $_POST['transaction_id']);
        oci_bind_by_name($stmt, ":cid", $_POST['transaction_customer_id']);
        oci_bind_by_name($stmt, ":vid", $_POST['transaction_vehicle_id']);
        oci_bind_by_name($stmt, ":sdate", $_POST['sale_date']);
        break;
    case "stock":
        $sql ="INSERT INTO Car_Stock (Vehicle_ID, Model, Available_Stock, Sold_Stock)
             VALUES (:id, :model, :avail, :sold)";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":id", $_POST['stock_vehicle_id']);
        oci_bind_by_name($stmt, ":model", $_POST['stock_model']);
        oci_bind_by_name($stmt, ":avail", $_POST['available_stock']);
        oci_bind_by_name($stmt, ":sold", $_POST['sold_stock']);
        break;

    default:
        die("Unknown form type.");
    }

if (oci_execute($stmt)) {
    echo "Record inserted successfully! ✅";
} else {
    $error = oci_error($stmt);
    echo "<p>Error: ❌" . $error['message'] . "</p>";
}

oci_free_statement($stmt);
oci_close($conn);
?>
