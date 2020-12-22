<?php
//create the required info to connect to the db (Note these are generic values, the values are changed depending on the db)
$serverName="localhost";
$dBUserName="root";
$dBPassword="";
$dBName="GroceryDB";

$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName); //create a connection to the db

//if unable to connect then exit the program and display the error
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}