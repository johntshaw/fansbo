 <?php
$servername = "localhost";
$username = "connection";
$password = "connection";
$db = "fansbo";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_errno > 0) {
    die('Connection failed: ' . $conn->connect_error);
}
echo "Connected successfully";
?>
<br />