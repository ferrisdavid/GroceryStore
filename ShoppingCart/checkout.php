<?php
session_start(); //start the session to access session variables
require_once("../login/includes/dbh.inc.php"); //import the database connect file to interact with db
if(!isset($_SESSION['userid']) || count($_SESSION['cart']) <= 0){ //if the user is not logged in or have no items in the cart then redirect to login
    header("location: ../login/login.php");
    exit();
}

$user = $_SESSION['userid']; //get the users id from the session
$sql = "SELECT NumOrders FROM users WHERE usersId=$user"; //query to be sent to db to get the users number of orders
$result = mysqli_query($conn,$sql); //query the db
$NumOrders = mysqli_fetch_assoc($result)["NumOrders"]; //retrieve the number of orders from the associative array
$NumOrders = $NumOrders + 1; //increment the number of orders

$query = "UPDATE users SET NumOrders=$NumOrders WHERE usersId=$user"; //update the users number of orders in the db
$result = mysqli_query($conn,$query);

$productId = array_column($_SESSION['cart'], 'productid'); //retrive the product ids from the users cart
foreach($productId as $id){ //loop through the product ids in the cart and send them to the orders table in the db
    $query = "INSERT INTO orders (userid, productid, orderNumber) VALUES (?, ?, ?)"; //using a prepared statement to send the product to the orders table
    $stmt = mysqli_stmt_init($conn); //initialize the statement
    if(!mysqli_stmt_prepare($stmt, $query)){ //if unable to prepare the statement then direct back to the cart with an error
        header("location: cart.php?error=failedstmt");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iii", $user, $id, $NumOrders); //bind the values to be inserted to the statement
    mysqli_stmt_execute($stmt); //execute the statement
    mysqli_stmt_close($stmt); //close the statement
}


$count = count($_SESSION["cart"]); //get the number of items in the cart
for($i=0; $i<$count; $i++){ //loop through the items in the cart and remove all the items
    unset($_SESSION["cart"][$i]);
}

header("location: cart.php?error=none"); //finally redirect back to the cart
exit();


