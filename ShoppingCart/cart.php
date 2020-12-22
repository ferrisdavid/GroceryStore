<?php
    session_start(); //start the session to get access to the session variables
    if(!isset($_SESSION['userid'])){ //check if the user is logged in, if not then redirect to login page
        header("location: ../login/login.php");
        exit();
    }

    require_once("../login/includes/dbh.inc.php"); //import the database connection file to communicate with the db
    require_once("./components/product.php"); //import the functions from product.php in order to generate the product cards dynamically
    $sql = "SELECT * FROM products"; //query to be sent to db to retrieve all products
    $result = mysqli_query($conn, $sql); //query the db

    //this block of code handles the remove functionality of the shopping cart allowing users to remove an item from the cart
    if(isset($_POST['remove'])){ //if the user has clicked to remove an item complete the following
        if($_GET['action'] == 'remove'){ 
                $count = count($_SESSION["cart"]); //get the number of items in the cart
                for($i=0; $i<$count; $i++){ //loop through the items in the cart until we find the item that needs to be removed
                    if($_SESSION["cart"][$i]['productid'] == $_GET["id"]){ //the id of the item to be removed is passed to a query string in order to allow us to identify it in the cart
                        $removeIndex = $i; //get the index that needs to be removed from the cart
                        unset($_SESSION["cart"][$i]); //remove the item from the cart and break from the loop
                        break;
                    }
                }
                for($j=$removeIndex+1; $j<$count; $j++){ //loop through the items that come after the removed item and move them one position back in order to fill the position left by the removed item
                    $_SESSION['cart'][$j-1] = $_SESSION['cart'][$j];
                    unset($_SESSION["cart"][$j]);
                }
                //Javascript
                echo "<script>alert('Product removed')</script>"; //alert the user that the item has been removed sucessfully
                echo "<script>window.location = 'cart.php'</script>"; //redirect the user back to the cart
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--linking the bootstrap CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" > <!--linking the font-awesome CDN-->
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet"> <!--linking google font-->
    <link rel="stylesheet" href="../footer/muhammad.css"> <!--linking the footer css-->
    <link href="style.css" rel="stylesheet"> <!--linking base page css-->
</head>
<body>
    <?php
        require_once("components/header.php"); //import the header
    ?>
    <div class='container-fluid'> <!--bootstrap container to make the cart responsive, consists of one row with two columns, one for the product cards and one for the price breakdown-->
        <div class='row px-5'>
            <div class='col-md-7'>
                <div class='shopping-cart' style='padding:3% 0'> <!--container for the products in the users cart-->
                    <h6 style='color:#ddded6'>My Cart</h6>
                    <hr>

                    <?php
                        $total = 0;//total to track the price of the items in cart
                        if(isset($_SESSION['cart']) and count($_SESSION['cart'])>0){ //if the cart variable is set and there is at least one item then display the cart
                            $productid = array_column($_SESSION['cart'], 'productid'); //get the product ids in the user cart
                            while($row = mysqli_fetch_assoc($result)){ //loop through the products on the site
                                foreach($productid as $id){ //loop through product ids in the cart
                                    if($row['productid'] == $id){ //if the id of the cart product matches that of the product from the db then display the product
                                        displayCartItem($row['productimage'], $row['productname'], $row['productprice'], $row['productdescription'], $row['productid']);//use the display cart function and the product information from the db to generate the product card
                                        $total = $total + floatval($row['productprice']); //accumulate the total price
                                    }
                                }
                            }   
                        }
                        else{ //if nothing is in the cart display an appropriate message to the user
                            echo "<h5 style='color:#ddded6;'>Your Cart is Empty</h5>";
                        }
                        
                    ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25"> <!--bootstrap column container for the price breakdown of the cart-->
                <div class='pt-4'>
                    <h6>Price Summary</h6>
                    <hr>
                    <div class='row price-details' style='padding: 3% 2%'> <!--container for the price details of the users cart-->
                        <div class='col-md-6'>
                            <?php
                                if(isset($_SESSION['cart'])){ //if there are items in the cart display the number of items
                                    $count = count($_SESSION['cart']);
                                    echo "<h6>Price ($count items)</h6>";
                                }
                                else{ //otherwise display an appropriate 0 items
                                    echo "<h6>Price (0 items)";
                                }
                            ?>
                            <h6>Delivery Charge</h6>
                            <hr>
                            <h6>Total Amount</h6>
                        </div>
                        <div class='col-md-6'>
                            <h6>$<?php echo $total?></h6> <!--display the cost of the items-->
                            <h6 class="text-success">FREE</h6> <!--display the cost of shipping-->
                            <hr>
                            <h6>$<?php echo $total?></h6> <!--display the total cost of the items-->
                        </div>
                        <?php
                        if(isset($_SESSION["cart"]) and count($_SESSION['cart'])>0){ //if the user has at least one item in the cart then display the check out button to allow them to check out the items
                            echo"<form method='POST' action='checkout.php'>
                            <button type='submit'>Check-out</button>
                            </form>"; //simple form that uses the script within checkout.php to checkout the users item (send to db and clear cart)
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main></main>
    <?php require_once("../footer/footer-bootstrap.php"); //import the footer ?>
    <!--bootstrap js and jquery scripts-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>