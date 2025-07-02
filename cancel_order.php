<?php
$con = mysqli_connect("localhost", "root", "", "Mobikart");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$id = $_GET['id'];
$sql = "UPDATE orders SET delivery_status = 'Order Cancelled' WHERE id = '$id'";

if (mysqli_query($con, $sql) == false) {
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);

header("Location: orders.php");

exit();
?>
