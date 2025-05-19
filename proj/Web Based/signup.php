<?php
echo "🛠️ Signup script started<br>";

// 1. Connect to Oracle
$conn = oci_connect("system", "prince", "//localhost:1521/prince27555");
if (!$conn) {
    $e = oci_error();
    die("❌ Connection failed: " . $e['message']);
}
//echo "✅ Connected to Oracle<br>";

// 2. Get POST data
$username = $_POST['username'];
$password_plain = $_POST['password'];
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);
$employee_id = $_POST['employee_id'];

echo "📦 Received - Username: $username, Employee ID: $employee_id<br>";

// 3. Prepare insert
$sql = "INSERT INTO Employees_Login (Username, Password, Employee_ID) 
        VALUES (:username, :password, :employee_id)";
$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid, ":username", $username);
oci_bind_by_name($stid, ":password", $password_hash);
oci_bind_by_name($stid, ":employee_id", $employee_id);

// 4. Execute insert
if (oci_execute($stid)) {
    //echo "✅ Inserted successfully<br>";
    oci_free_statement($stid);
    oci_close($conn);
    // Redirect after 2 seconds
    header("refresh:2;url=login.html");
    echo "<script>alert('You have been Signed Up ✅.'); window.location.href = 'login.html';</script>";
    exit();
} else {
    $e = oci_error($stid);
    echo "❌ Insert failed: " . $e['message'];
    oci_free_statement($stid);
    oci_close($conn);
}
?>
