<?php session_start(); //start the session to access the session variables?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Grocery List</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--link to the bootstrap CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" > <!--link to the font-awesome CDN-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--link to the jQuery CDN-->
        <link rel="stylesheet" href="../footer/muhammad.css"> <!--link to the footer css-->
        <link rel="stylesheet" href="CSS/style.css"> <!--link to the grocery list css-->
        <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet"> <!--link the google font-->
        <style>
            /* additional footer styling */
        .footer .footer-content h2 {
            padding-top: 30px;
            padding-bottom: 20px;
        }
        </style>
    </head>
    <body>
        <?php
            require_once("../ShoppingCart/components/header.php"); //import the header
        ?>
        <h1>Grocery List</h1>
        <div class="container"> <!--container for the grocery list creator tool-->
            <h2>Use the Text Box to add items to your Grocery List!</h2>
            <h3>Click on an Item to scratch it off or Double Click to remove it</h3>
            <input id="iteminput" type="text" placeholder="What Item?" required> <!--textbox for user to type in item-->
            <label for="quantity">X</label>
            <input type="number" min="1" max="100" id="quantity" value="1"> <!--number input for user to specify the quantity of the item (1-100)-->
            <br>
            <button id="addButton">Add Item</button> <!--button to add the item to the grocery list-->
            <div class="grocerylist" id="listcontainer"> <!--div to hold the items added to the list. this is where the list is displayed and accumulated-->

            </div>
        </div>
        <main></main>
        <?php require_once("../footer/footer-bootstrap.php"); //import the footer ?>
        <script src="grocerylist.js"></script> <!--script for adding and removing values from the grocery list-->
        <!--bootstrap js and jQuery scripts-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>