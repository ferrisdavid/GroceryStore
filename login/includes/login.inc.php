<?php
//if the user has clicked the log in button
if(isset($_POST["submit"])){

    $username = $_POST["uid"]; //retrieve the username from the post method
    $pwd = $_POST["pwd"]; //retrieve the password from the post method

    require_once 'dbh.inc.php'; //import the connection to the db
    require_once 'functions.inc.php'; //import the functions for validation and logging the user in

    if (emptyInputLogin($username, $pwd) !== false){ //check if any of the fields are empty, if they are then redirect to login page with an error and exit the function
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd); //if all inputs are present attempt to log the user in using the loginUser function in functions.inc.php
}
else{ //otherwise the user has attempted to access this page without clicking submit so redirect back to the login page
    header("location: ../login.php");
    exit();
}