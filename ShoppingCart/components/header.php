<!--This is the header component that is imported on all the pages. it is created using bootstrap classes and was created with the help of the bootstrap navbar documentation page-->
<header id="header">
    <div class="container-fluid" style="background-color: #5ecbd3">
    <nav class="navbar navbar-expand-xl navbar-dark" style="text-shadow: 1px 1px 8px #e73b4f;">
        <a href="/grocery/ShoppingCart/index.php" class="navbar-brand"> <!--icon to link back to the main page-->
            <h3>
                <i class="fas fa-shopping-basket"></i> The Grocery Store
            </h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <!--collapsable menu for when the screen size becomes too small-->
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
                <a href="/grocery/ShoppingCart/cart.php" class="nav-item nav-link active"> <!--link to the users cart which displays the number of items in the cart dynamically-->
                    <h5>
                        <i class="fas fa-shopping-cart"></i> Cart
                        <?php
                            if(isset($_SESSION['cart'])){ //if the user has an item in the cart display the count
                                $count = count($_SESSION['cart']);
                                echo "<span id='cart_count' class='bg-light' style='text-align:center; padding:0 0.9rem 0.1rem 0.9rem; border-radius:3rem; color:#e73b4f'>$count</span>";
                            }
                            else{//otherwise simply display 0
                                echo "<span id='cart_count' class='bg-light' style='text-align:center; padding:0 0.9rem 0.1rem 0.9rem; border-radius:3rem; color:#e73b4f'>0</span>";
                            }
                        ?>
                    </h5>
                </a>
                <a href="/grocery/grocerylist/grocerylist.php" class="nav-item nav-link active"> <!--link with icon to the grocery list creator page-->
                    <h5>
                        <i class="fas fa-clipboard-list"></i> Grocery List&nbsp;&nbsp;
                    </h5>
                </a>
                <a href="/grocery/ShoppingCart/History.php" class="nav-item nav-link active"> <!--link with icon to the order history page-->
                    <h5>
                        <i class="fas fa-receipt"></i> Order History&nbsp;&nbsp;
                    </h5>
                </a>
                <a href="/grocery/ConsumerTools/nutritionalPage.php" class="nav-item nav-link active"> <!--link with icon to the nutrition information page-->
                    <h5>
                    <i class="fab fa-nutritionix"></i> Nutrition Facts&nbsp;&nbsp;
                    </h5>
                </a>
                <a href="/grocery/ConsumerTools/locator.php" class="nav-item nav-link active"> <!--link with icon to the store locator page-->
                    <h5>
                    <i class="fas fa-store"></i> Store Locator&nbsp;&nbsp;
                    </h5>
                </a>
                <a href="/grocery/login/includes/logout.inc.php" class="nav-item nav-link active"> <!--link with icon to the logout script to log the user out-->
                    <h5>
                    <i class="fas fa-sign-out-alt"></i> Log Out&nbsp;&nbsp;
                    </h5>
                </a>
            </div>
        </div>
    </nav>
    </div>
</header>