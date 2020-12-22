<?php
//this function is used to display product cards on the main page dynamically as the arguments are passed from data retrieved from the database
//the cards us bootstrap to display the information in the correct format and in order to be responsive
function displayProduct($productName, $productPrice, $productImage, $productDescription, $productid){
    //the product is stored as multiline string and then echoed into the document
    $product = "
    <div class='col-xl-3 col-md-6 my-3 my-md-2'>
    <form action='index.php' method='POST'>
    <div class='card shadow elementShadow'>
    <div>
    <img src='$productImage' alt='$productName' class='img-fluid card-img-top' style='max-width:100%; height:auto;'>
    </div>
    <div class='card-body'>
    <h5 class='card-title'>$productName</h5>
    <p class='card-text'>$productDescription</p>
    <h5>
    <span class='price'>$$productPrice</span>
    </h5>
    <button type='submit' class='btn btn-warning my-3' name='add'>Add to Cart<i class='fas fa-shopping-cart'></i></button>
    <input type='hidden' name='productid' value='$productid'>
    </div>
    </div>
    </form>
    </div>
    ";
    echo $product;
}

//this function is used to display product cards on the cart page dynamically as the arguments are passed from data retrieved from the database
//the cards us bootstrap to display the information in the correct format and in order to be responsive
//this is essentially the same as the function for the main page except it provides a button for the user to remove the item from their cart
function displayCartItem($productImage, $productName, $productPrice, $productDescription, $productid){
    $item = "
    <form action='cart.php?action=remove&id=$productid' method='POST' class='cart-items'>
        <div class='border rounded'>
            <div class='row bg-white'>
                <div class='col-md-3 pl-0'>
                    <img src=$productImage alt=$productName class='img-fluid'>
                </div>
                <div class='col-md-6'>
                    <h5 class='pt-2'>$productName</h5>
                    <small class='text-secondary'>Seller: The Grocery Store</small><br>
                    <small class='text-seconday'>$productDescription</small>
                    <h5 class='pt-2'>Price: $$productPrice</h5>
                    <button type='submit' class='btn btn-danger mx-2' name='remove'>Remove</button>
                </div>
            </div>
        </div>
    </form>
    ";
    echo $item;
}

//this function is used to display product cards on the order history page dynamically as the arguments are passed from data retrieved from the database
//the cards us bootstrap to display the information in the correct format and in order to be responsive
//this is essentially the same as the function for the main page except it only displays the product information and does not provide any user interaction (i.e. add/remove buttons)
function displayHistoryItem($productImage, $productName, $productPrice, $productDescription, $productid){
    $item = "
    <form action='cart.php?action=remove&id=$productid' method='POST' class='cart-items'>
        <div class='border rounded'>
            <div class='row bg-white'>
                <div class='col-md-3 pl-0'>
                    <img src=$productImage alt=$productName class='img-fluid'>
                </div>
                <div class='col-md-6'>
                    <h5 class='pt-2'>$productName</h5>
                    <small class='text-secondary'>Seller: The Grocery Store</small><br>
                    <small class='text-seconday'>$productDescription</small>
                    <h5 class='pt-2'>Price: $$productPrice</h5>
                </div>
            </div>
        </div>
    </form>
    ";
    echo $item;
}
