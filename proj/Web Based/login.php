<?php
session_start();

// 🔧 Update these as needed
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Oracle connection string
$tns = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = prince27555))
)";
$db_username = "system";
$db_password = "prince";

// Connect to Oracle DB
$conn = oci_connect($db_username, $db_password, $tns);
if (!$conn) {
    $e = oci_error();
    die("❌ Connection failed: " . htmlentities($e['message']));
}

// Fetch user info
$sql = "SELECT * FROM Employees_Login WHERE Username = :username";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":username", $username);
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC);

if ($row && password_verify($password, $row['PASSWORD'])) {
    $_SESSION['username'] = $username;
    $_SESSION['employee_id'] = $row['EMPLOYEE_ID'];
    header("Location: homep.html");
    exit;
} else {
    echo "❌ Invalid login.";
}

oci_free_statement($stid);
oci_close($conn);
?>
