<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/signup.css">
        <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
        <title>Grocery Login Page</title>
    </head>
    <body>
        <div>
            <h2>Sign Up</h2>
            <form action="includes/signup.inc.php" method="POST">
                <input type="text" name="name" placeholder="Full name..."><br>
                <input type="text" name="email" placeholder="Email..."><br>
                <input type="text" name="uid" placeholder="Username..."><br>
                <input type="password" name="pwd" placeholder="Password..."><br>
                <input type="password" name="pwdrepeat" placeholder="Repeat Password..."><br>
                <button type="submit" name="submit">Sign-Up</button><br>
            </form>
            <br>
            <p> Go back to log in</p><a href="login.php">Log in</a>
        </div>

        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p style='color: #e73b4f'>One or more Missing Fields. Please Fill in all Fields</p>";
                }
                elseif($_GET["error"] == "invaliduid"){
                    echo "<p style='color: #e73b4f'>Please Input a Valid Username</p>";
                }
                elseif($_GET["error"] == "invalidemail"){
                    echo "<p style='color: #e73b4f'>Please Input a Valid Email</p>";
                }
                elseif($_GET["error"] == "passwordsdontmatch"){
                    echo "<p style='color: #e73b4f'>Passwords do not match</p>";
                }
                elseif($_GET["error"] == "usernametaken"){
                    echo "<p style='color: #e73b4f'>Username or Email is already in Use</p>";
                }
                elseif($_GET["error"] == "passwordtooshort"){
                    echo "<p style='color: #e73b4f'>Password must be longer than 6 characters</p>";
                }
                elseif($_GET["error"] == "none"){
                    echo "<p>You Have Signed up Successfully!";
                }
            }
        ?>
    </body>
</html>