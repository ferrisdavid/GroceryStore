<?php

session_start(); //start the session in order to access the session variables
if(!isset($_SESSION["userid"])){ //if the user is not logged in then redirect to login page
    header("location: ../login.php");
    exit();
}
session_unset(); //otherwise unset the session variables and destroy the session
session_destroy();

header("location: ../login.php"); //redirect back to the login page
exit();