<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

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
        <div class="wide-container about-us">
            <span class="text-on-img-centered">&nbsp;About Us&nbsp;</span>
            <span class="text-on-img-bottomleft">Source: https://www.pexels.com/</span>
        </div>

        <div class="content-wrapper">
            <br><br><br>
            <p class="content-wrapper">
                Every day we serve and welcome many hungry customers. They’re not just hungry for food, they’re hungry for something that can make their lives happier, healthier and easier. They purchase from us to go from anxiety to inspiration.
                We try to make the experience as easy as possible. We’ve always been about value, convenience, and making customers’ lives simpler. Our all new online platform features a quick search function that allows our users to find what they want at light speeds.
                <br><br>
                We are beyond a simple grocery shopping site, and to classify us as such would do a disservice to our great hospitality and care when dealing with customers.
            </p>
            <br>            
        </div>
    </main>
    <?php require_once("../footer/footer-bootstrap.php");?>
    <!-- INSERT FOOTER HERE -->
    
</body>
</html>