<?php
//function to check if a field is empty in the signup page
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result=false;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){ //if at least one field is empty return true
        $result=true;
    }
    else{ //otherwise return false
        $result=false;
    }
    return $result;
}

//function to check if the user has submitted an invalid user name
function invalidUid($username, $name){
    $result=false;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){ //if the username contains anything other than strictly letters and digits then return true
        $result=true;
    }
    else{ //otherwise result is false
        $result=false;
    }
    if($name === $username){ //check if the user name is the same as the inputted name (this is not allowed) then it is invalid
        $result=true;
    }
    return $result;
}

//function to check for an invalid email
function invalidEmail($email){
    $result=false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //validate the email by using the built in filter function and email filter in php if this returns false then return true
        $result=true;
    }
    else{//otherwise the email is valid so return false
        $result=false;
    }
    return $result;
}

//function to check if both passwords inputted in the signup page match
function pwdMatch($pwd, $pwdRepeat){
    $result=false;
    if($pwd !== $pwdRepeat){ //if the two fields are not the same then return true
        $result=true;
    }
    else{ //otherwise the passwords are the same
        $result=false;
    }
    return $result;
}

//function to check if the password is at least 6 characters
function pwdGreater($pwd){
    $result=false;
    if(strlen($pwd) < 6){ //if the field is less than 6 return true
        $result=true;
    }
    else{ //else the password is long enough
        $result=false;
    }
    return $result;
}

//function to check if a username or email is already taken
function uidExists($conn, $username, $email){
    //The use of prepared statements is essential to protecting against malicious attacks on the site (SQL injection)
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;"; //use a prepared statement to query db users table for the username or email
    $stmt = mysqli_stmt_init($conn); //initialize the statement
    if(!mysqli_stmt_prepare($stmt, $sql)){ //if we are unable to prepare the statement then redirect to an error page and exit the function
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email); //bind the parameters to the statement (username and email)
    mysqli_stmt_execute($stmt); //execute the statement

    $resultData = mysqli_stmt_get_result($stmt);//retrieve the result of the prepared statement

    if($row = mysqli_fetch_assoc($resultData)){//if the statement returned something then we have found a user on the site who already has this username or email and therefore we have an invalid signup
        return $row; //return the row so this information can be accessed in our login function
    }
    else{ //if nothing is found then return false
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt); //close the prepared statement
}

//fucntion to sign a user up and put their info into the db
function createUser($conn, $name, $email, $username, $pwd){
    //The use of prepared statements is essential to protecting against malicious attacks on the site (SQL injection)
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);"; //prepared statement to be sent to the db, inserting a user into the users table
    $stmt = mysqli_stmt_init($conn); //initialize the prepared statement
    if(!mysqli_stmt_prepare($stmt, $sql)){ //if we are unable to prepare the statement to be executed then redirect to an error page and exit the function
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //hash the password using the built in php function in order to protect the users information

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd); //bind the values that need to be sent to the db to insert the user (name, email, username, and the hashed password)
    mysqli_stmt_execute($stmt); //execute the prepared statement
    mysqli_stmt_close($stmt); //close the prepared statement
    header("location: ../signup.php?error=none"); //redirect back to signup page with a successful sign up
    exit();
}

//function to check if a field is empty in the login form
function emptyInputLogin($username, $pwd){
    $result=false;
    if(empty($username) || empty($pwd)){ //if either of the fields are empty return true
        $result=true;
    }
    else{ //otherwise return false
        $result=false;
    }
    return $result;
}

//function to log a user into the site
function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username); //use the uidExists method defined above which was used to check if a user was in the db for the signup page to see if the user is in the db

    if($uidExists === false){ //if the user is not in the db then redirect to login page and display an error message (incorrect information)
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"]; //retrieve the hashed password from the data from the db returned by the uidExists function
    $checkPwd = password_verify($pwd, $pwdHashed); //use the password_verify built in function to retrieve a boolean value corresponding to if the password and hashed password match

    if($checkPwd === false){ //if the inputted password does not match the hashed password in the db then the login is wrong so redirect to login and display error
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif($checkPwd === true){ //otherwise if they match then we start the session and set session variables corresponding to the users id and username
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../../ShoppingCart/index.php"); //redirect to main product page
        exit();
    }
}