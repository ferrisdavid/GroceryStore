<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Grocery Login Page</title>
        <link rel="stylesheet" href="CSS/login.css">
        <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div>
            <h2>Log in to The Grocery Store</h2>
            <form action="includes/login.inc.php" method="POST">
                <input type="text" name="uid" placeholder="Username/Email..."><br>
                <input type="password" name="pwd" placeholder="Password..."><br>
                <button type="submit" name="submit">Log In</button><br>
            </form>
            <br>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p style='color: #e73b4f'>One or more Missing Fields. Please Fill in all Fields</p>";
                    }
                    elseif($_GET["error"] == "wronglogin"){
                        echo "<p style='color: #e73b4f'>Incorrect Login Information. Please Try Again.</p>";
                    }
                    elseif($_GET["error"] == "none"){
                        echo "<p>Successful Login!</p>";
                    }
                }
            ?>
            <br>
            <p> Not a member? Signup here:</p><a href="signup.php">Sign Up</a>
        </div>
    </body>
</html>