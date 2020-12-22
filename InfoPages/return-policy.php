<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Policy</title>

    <!-- Footer.css -->
    <link rel="stylesheet" href="muhammad.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Sansita+Swashed&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- jQuery and Bootstrap bundle -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" ></head>
    <style>
        .footer .footer-content h2 {
            padding-top: 30px;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
        require_once("../ShoppingCart/components/header.php"); 
    ?>
    
    <main style="background-color: #2d4154;">
        <div class="wide-container return-policy">
            <img src="img/return-policy-img.jpg" class="wide-img">
            <span class="text-on-img-centered">&nbsp;Return Policy&nbsp;</span>
            <span class="text-on-img-bottomleft">Source: https://www.pexels.com/</span>
        </div>

        <div class="content-wrapper">
            <br><br><br>
            <p class="content-wrapper">
                We have a 48-hour return policy, which means you have 48 hours after receiving your item to request a return. 
                To be eligible for a return, you must be able to demonstrate an issue or defect with the item. You’ll also need the receipt or proof of purchase. 
                To start a return, you can contact us at <i>support@TheGroceryStore.com</i>. If your return is accepted, we’ll send you a return shipping label, as well as instructions on how and where to send your package. Items sent back to us without first requesting a return will not be accepted. 
                You can always contact us for any return question at <i>support@TheGroceryStore.com</i>.
                <br>
                <br>
                <br>
                <b>Damages and issues</b> 
                <br>
                Please inspect your order upon reception and contact us immediately if the item is defective, damaged or if you receive the wrong item so that we can evaluate the issue and make it right.
                <br>
                <br>
                <b>Exceptions / non-returnable items</b> 
                <br>
                Certain types of items cannot be returned, like perishable goods (such as food, flowers, or plants), and personal care goods (such as beauty products). We also do not accept returns for hazardous materials, flammable liquids, or gases. Please get in touch if you have questions or concerns about your specific item. 
                Unfortunately, we cannot accept returns on sale items or gift cards.
                <br>
                <br>
                <b>Exchanges</b>
                <br>
                The fastest way to ensure you get what you want is to return the item you have, and once the return is accepted, make a separate purchase for the new item.
                <br>
                <br>
                <b>Refunds</b>
                <br>
                We will notify you once we’ve received and inspected your return, and let you know if the refund was approved or not. If approved, you’ll be automatically refunded on your original payment method. Please remember it can take some time for your bank or credit card company to process and post the refund too.
            </p>
            <br>            
        </div>

    </main>
    <?php require_once("../footer/footer-bootstrap.php");?>
    <!-- INSERT FOOTER HERE -->
</body>
</html>
</body>
</html>
