<?php
    session_start(); //start the session to access session variables
    if(!isset($_SESSION["userid"])){ //if the user is not logged in redirect to the login page
        header("location: ../login/login.php");
        exit();
    }
    require_once("../login/includes/dbh.inc.php"); //import the database connect file to interact with the db
    require_once("./components/product.php"); //import the functions from product.php to generate the product cards dynamically

    $sql = "SELECT * FROM products"; //query to be sent to the db to retrieve products on the site
    $result = mysqli_query($conn, $sql); //query the db for the products
    $headers = ["Cold Beverages", "Produce", "Meat", "Fruit", "Toiletries"]; //array of headers to split the items into sections
    if(isset($_POST["add"])){ //this if statement handles the adding to cart functionality
        if(isset($_SESSION["cart"])){ //if the cart variable is already created then simply add the product id to the cart array
            $item_array_id = array_column($_SESSION["cart"], "productid");
            if(in_array($_POST["productid"], $item_array_id)){ //check if the item being added is already in the cart if so then notify the user and redirect to the item page
                echo "<script>alert('Product is already in your cart')</script>";
                echo "<script>window.location = 'index.php'</script>";
            }else{ //otherwise add the item id to the cart session array
                $count= count($_SESSION["cart"]);
                $item_array = array('productid'=>$_POST['productid']); //id of the product to be added is sent through the post method
                $_SESSION["cart"][$count] = $item_array;
            }

        }else{ //if the cart variable is not created then we create it and add the product id as the first item, items are stored as associative arrays
            $item_array = array('productid'=>$_POST['productid']);

            $_SESSION["cart"][0] = $item_array;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--link the bootstrap CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" > <!--link the font-awesome CDN-->
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet"> <!--link the google font-->
    <link rel="stylesheet" href="../footer/muhammad.css"> <!--link the footer css-->
    <link href="style.css" rel="stylesheet"> <!--link the base page css-->
</head>
<body>
    <?php require_once("components/header.php"); //import the header ?>
    <div class="container-fluid"> <!--bootstrap container to make the page responsive, holds the products-->
        <h1 class="text-center py-5 head" id="welcome">Welcome to The Grocery Store!</h1>
        <h1>Featured Items</h1>
        <?php
            $numRows = mysqli_num_rows($result) / 4; //get the number of rows returned by the query and divide by four since each row contains four items, this will give the number of rows
            for($i=0; $i<$numRows; $i++){ //loop through the number of required rows
                $count = 0; //initialize count accumulator to track how many products have been placed
                $header = $headers[$i]; //retrieve the header from the header array
                echo "<h2>$header</h2>"; //display the appropriate header
                echo "<hr>"; //place a horizontal rule
                echo "<div class='row text-center my-5'>"; //create a container using bootstraps classes for responsiveness to place the products of this row
                while($row = mysqli_fetch_assoc($result)){ //move through the results of the query
                    displayProduct($row["productname"], $row["productprice"], $row["productimage"], $row["productdescription"], $row["productid"]); //use the display product function from product.php to generate the product card dynamically from the information obtained from db
                    $count+=1; //increment count
                    if($count==4){ //check if 4 products have been placed, if so then break and move to the next row
                        break;
                    }
                }
                echo "</div>";
            }
        ?>
    </div>
    <main></main>
    <?php require_once("../footer/footer-bootstrap.php"); //import the footer?>
<!--bootstrap javascript and jquery-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>