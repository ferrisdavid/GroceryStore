<?php

if(isset($_POST["submit"])){ //check that the user has accessed this script by clicking the submit button
    //retrieve the form fields from the post method
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];


    require_once 'dbh.inc.php'; //import the connection to the db
    require_once 'functions.inc.php'; //import validation and signup functions

    if(emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false){ //check if any field is empty and redirect to signup with an error as query in url
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($username, $name) !== false){ //check for an invalid username and redirect to signup with an error as query in url
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if(invalidEmail($email) !== false){ //check for an invalid email and redirect to signup with an error as query in url
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $pwdRepeat) !== false){ //check if the password and repeated password dont match and redirect to signup page with an error as query in url
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $username, $email) !== false){ //check if the username or email has already been taken and redirect to signup page with an error as query in url
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    if(pwdGreater($pwd)!==false){ //check if the password is less than 6 characters and redirect to signup page with an error as query in url
        header("location: ../signup.php?error=passwordtooshort");
        exit();
    }
    //if all the fields are valid than create the user using the createUser function defined in functions.inc.php
    createUser($conn, $name, $email, $username, $pwd);

}else{ //otherwise the user has not properly accessed this script so redirect to the signup page
    header("location: ../signup.php");
    exit();
}