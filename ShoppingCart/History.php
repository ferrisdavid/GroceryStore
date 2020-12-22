<?php
session_start(); //start session to access session variables
require_once("../login/includes/dbh.inc.php"); //require database connect file to interact with db
require_once("components/product.php"); //import products file to access functions for generating item cards
if(!isset($_SESSION["userid"])){ //if the userid session variable is not set then the user hasnt logged in so redirect to login
    header("location: ../login/login.php");
    exit();
}

$user = $_SESSION['userid'];
$sql = "SELECT NumOrders FROM users WHERE usersId=$user";//query to send the database to get the number of orders this user has submitted
$result = mysqli_query($conn,$sql); //query db
$NumOrders = mysqli_fetch_assoc($result)["NumOrders"]; //retrieve number of orders
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" > <!--font-awesome CDN-->
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet"> <!--linking the google font-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--jQuery CDN-->
    <link rel="stylesheet" href="../footer/muhammad.css"> <!--linking footer stylesheet-->
    <link href="style.css" rel="stylesheet" type="text/css"> <!--linking the base page stylesheet-->
</head>
<body>
    <?php
        require_once("components/header.php"); //import the header
    ?>
    <div class="container-fluid"> <!--bootstrap container to hold the items of the order history and price breakdown-->
        <div class="row text-center py-5"> <!--bootstrap container for the header of the page this defines a row in the grid-->
            <div class="col-12">
              <h1 style="text-align: center;">View Your Orders!</h1>  
            </div>
        </div>
        <div class="row text-center py-3"><!--another bootstrap row container for the form for users to search for an order-->
            <div class="col-12">
                <form method="POST" action="History.php" id="orderForm"> <!--form to allow users to search for a specific order-->
                    <input style="width:70%;padding:1%;text-align:center" type="text" name="orderNumber" required placeholder="Enter Your Order Number"><br>
                    <button type="submit" style="padding: 0.5%; margin:0.5%" id="submit">Find This Order</button>
                </form>
                <script>
                    function formValidate(input){ //javascript function to validate the order search form this only allows the user to submit numbers
                        let pattern = /^[0-9]+$/;
                        if(pattern.test(input)){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                    //jquery to set up a click event listener on the form submit button that will validate the form when submitted
                    $(document).ready(()=>{
                        $("#submit").on("click", (e)=>{ //when the submit button is clicked fetch the value from the text field
                            let submittedNumber = $('#orderForm').find('input[name="orderNumber"]').val();
                            let isNumeric = formValidate(submittedNumber); //check if the text is only digits
                            if(isNumeric === false){ //if anything but a digit is inputted prevent the submit and alert the user 
                                e.preventDefault();
                                alert("Please Input a Valid Number");
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="row text-center py-3"> <!--another bootstrap row container for the item history and price breakdown cards-->
            <div class="col-md-6 mx-2">
                <?php
                    $user = $_SESSION["userid"]; //retrieve the userid from session
                    if(!isset($_POST["orderNumber"])){ //if the user has yet to search for an order then we display their most recent order
                        if($NumOrders == 0){ //if no orders placed display an appropriate message
                            echo "<i class='far fa-frown fa-7x' style='color:#ddded6;'></i> <span style='font-size:2vw;color:#ddded6;'>It Looks like you have no Orders. Try Ordering something, I hear the tomato's are lovely this time of year!<span>";
                        }
                        else{ //otherwise display the most recent order
                            echo "<h3 style='color:#ddded6;'>Here are the Contents of Your Most Recent Order: (Order Number $NumOrders)</h3>"; 
                        }
                        
                        $stmt = "SELECT * FROM orders WHERE userid=$user AND orderNumber=$NumOrders"; //query to be sent to the db to get the items in the last order
                        $orders = mysqli_query($conn,$stmt); //query the db
                        $products = array(); //accumulate the product ids from the order into an array
                        while($row = mysqli_fetch_assoc($orders)){
                            array_push($products, $row["productid"]);
                        }

                        $sql = "SELECT * FROM products"; //query to retrieve the products from the db
                        $AvailableProducts = mysqli_query($conn, $sql); //query the db
                        $total = 0; // total to track the price
                        $count = count($products); //get the number of products in the order
                        while($productRow = mysqli_fetch_assoc($AvailableProducts)){ //move through the products in the db to find the products from the order in the products table
                            for($i=0; $i < count($products); $i++){
                                if($productRow["productid"] == $products[$i]){ // if we have found a matching product in the order history and products table then display the product using the displayHistoryItem function
                                    displayHistoryItem($productRow['productimage'], $productRow['productname'], $productRow['productprice'], $productRow['productdescription'], $productRow['productid']);
                                    $total = $total + $productRow['productprice']; //accumulate the total price
                                }
                            }
                        }
                    }
                    else{//execute if the user has searched for a specific order
                        $orderNum = $_POST["orderNumber"]; //retrieve the order number submitted
                        echo "<h3 style='color:#ddded6;'>Here are the Contents of Your Order: (Order Number $orderNum)</h3>";
                        $stmt = "SELECT * FROM orders WHERE userid=$user AND orderNumber=$orderNum"; //query to be sent to db to retrieve the items submitted in specific order
                        $orders = mysqli_query($conn,$stmt); //query the db
                        if($orders === false || mysqli_num_rows($orders)==0){ //if the order does not exist then display the appropriate message
                            echo "<i class='far fa-frown fa-7x' style='color:#ddded6;'></i> <span style='font-size:2vw;color:#ddded6;'>Uh oh! It looks like We don't have that order<span>";
                        }
                        $products = array(); //otherwise we accumulate the product id's into an array
                        while($row = mysqli_fetch_assoc($orders)){
                            array_push($products, $row["productid"]);
                        }
                        //same process to generate dynamic page based on the contents of the order from the above if statement portion of this if else block
                        $sql = "SELECT * FROM products";
                        $AvailableProducts = mysqli_query($conn, $sql);
                        $total = 0;
                        $count = count($products);
                        while($productRow = mysqli_fetch_assoc($AvailableProducts)){
                            for($i=0; $i < count($products); $i++){
                                if($productRow["productid"] == $products[$i]){
                                    displayHistoryItem($productRow['productimage'], $productRow['productname'], $productRow['productprice'], $productRow['productdescription'], $productRow['productid']);
                                    $total = $total + $productRow['productprice'];
                                }
                            }
                        }
                    }
                ?>  
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25"> <!--bootstrap column container for price breakdown of order-->
                <div class='pt-4'>
                    <h6>Price Summary</h6>
                    <hr>
                    <div class='row price-details' style='padding: 3% 2%'> <!--bootstrap container for price information-->
                        <div class='col-md-6'> <!--first column for price breakdown to display labels-->
                            <?php
                                echo "<h6>Price ($count items)</h6>"; //label for the price of the order using a count variable for to display number of items
                            ?>
                            <h6>Delivery Charge</h6>
                            <hr>
                            <h6>Total Amount</h6>
                        </div>
                        <div class='col-md-6'> <!--second column for price breakdown to display respective values-->
                            <h6>$<?php echo $total?></h6> <!--display the total price that was accumulated above for the order-->
                            <h6 class="text-success">FREE</h6> <!--display the shipping cost-->
                            <hr>
                            <h6>$<?php echo $total?></h6> <!--display the total price that was accumulated above for the order-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main></main>
    <?php require_once("../footer/footer-bootstrap.php"); //import the footer ?>
<!--bootstrap javascript-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

