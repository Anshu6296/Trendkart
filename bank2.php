<?php
session_start();
include 'components/connect.php'; 
$con = mysqli_connect("localhost", "root", "", "Mobikart");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


// Get form values
$total_price = $_GET['total_price'];
$total_products = $_GET['total_products'];
$card = $_GET['card'];
$card_number = $_GET['card_number'];
$expmonth = $_GET['expmonth'];
$expyear = $_GET['expyear'];
$cvv = $_GET['cvv'];

// Check if card already exists in the bank table
$sql_check = "SELECT balance FROM bank WHERE card_number='$card_number' AND cvv='$cvv' AND expyear='$expyear' AND expmonth='$expmonth'";
$result_check = mysqli_query($con, $sql_check);
$row_check = mysqli_fetch_array($result_check);

// If the card does not exist, insert it with an initial balance
if ($row_check == null) {
    $initial_balance = 100000; // Set an initial balance for the new card
    $sql_insert = "INSERT INTO bank (card_number, cvv, expyear, expmonth, balance) VALUES ('$card_number', '$cvv', '$expyear', '$expmonth', '$initial_balance')";
    mysqli_query($con, $sql_insert);
    $balance = $initial_balance;
} else {
    $balance = $row_check['balance'];
}

$cssContent = file_get_contents("failed.php");

if ($balance >= $total_price) {
    // Update the balance
    $query_update = "UPDATE bank SET balance = balance - $total_price WHERE card_number = '$card_number'";
    mysqli_query($con, $query_update);

    // Get user details
    $sql_user = "SELECT name, number, email, address FROM users WHERE id='" . $_SESSION['user_id'] . "'";
    $result_user = mysqli_query($con, $sql_user);
    $row_user = mysqli_fetch_array($result_user);

    if ($row_user) {
        $name = $row_user['name'];
        $number = $row_user['number'];
        $email = $row_user['email'];
        $address = $row_user['address'];
        $cd = date('Y-m-d');

        // Insert the order
        $sql_order = "INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on, delivery_status) VALUES ('" . $_SESSION['user_id'] . "', '$name', '$number', '$email', '$card', '$address', '$total_products', '$total_price', '$cd', 'pending')";
        mysqli_query($con, $sql_order);

        // Clear the user's cart
        $sql_clear_cart = "DELETE FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'";
        mysqli_query($con, $sql_clear_cart);

        $cssContent1 = file_get_contents("success.php");
        echo $cssContent1;

        // Redirect to orders page after 5 seconds
        $nextPage = 'orders.php';
        $delayInSeconds = 5;
        header("Refresh: $delayInSeconds; URL=$nextPage");
    } else {
        echo $cssContent;
    }
} else {
    echo $cssContent; // Insufficient balance
}
?>
