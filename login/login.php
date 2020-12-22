<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Grocery Login Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--link to the jQuery CDN-->
        <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet"> <!--link to the google font-->
        <link rel="stylesheet" href="CSS/login.css"> <!--link to the login page css-->
    </head>
    <body>
        <div>
            <h2>Log in to The Grocery Store</h2>
            <form action="includes/login.inc.php" method="POST" id="loginform">
                <input type="text" name="uid" id="userid" placeholder="Username/Email..."><br>
                <input type="password" name="pwd" id="passwd" placeholder="Password..."><br>
                <button type="submit" name="submit" id="login">Log In</button><br>
            </form>
            <script>
                //simple javascript and jquery to validate that user has filled in all required fields.
                //Note that the more complex validations of specific fields is handled by our php in functions.inc.php
                function basicFormValidate(userid, passwd){
                    if(passwd == "" || userid==""){ //if either of the fields are empty then return false
                        return false;
                    }
                    return true; //else return true
                }
                //set up jquery event when the document is loaded
                $(document).ready(()=>{
                    //set up event listener for the click of the signup submit button
                    $("#login").on("click", (e)=>{
                        //retrieve the values of the submitted fields using jquery selectors
                        let uid = $("#loginform").find('input[name="uid"]').val();
                        let passwd = $("#loginform").find('input[name="pwd"]').val();
                        //get the boolean value corresponding to whether each field is filled in
                        let isFilled = basicFormValidate(uid, passwd);
                        if(isFilled==false){//if at least one field is empty prevent the submission of the form and alert the user of the error
                            e.preventDefault();
                            alert("One or more Missing Fields. Please Fill in all fields!")
                        }
                    })
                })
            </script>
            <br>
            <?php
                //this code retrieves the error from the query string in the url that is sent by our php functions in login.inc.php and functions.inc.php if it is present
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){//if we have empty field display an appropriate message (Note that the js handles this, this is simply a backup function)
                        echo "<p style='color: #e73b4f;text-align: center;padding:1%'>One or more Missing Fields. Please Fill in all Fields</p>";
                    }
                    elseif($_GET["error"] == "wronglogin"){ //if the user has entered a login that does not exist then display and appropriate message
                        echo "<p style='color: #e73b4f;text-align: center;padding:1%'>Incorrect Login Information. Please Try Again.</p>";
                    }
                    elseif($_GET["error"] == "none"){ //if no error then we have a sucessful login
                        echo "<p>Successful Login!</p>";
                    }
                }
            ?>
            <br>
            <p> Not a member? Signup here:</p><a href="signup.php">Sign Up</a> <!--link to the signup page-->
        </div>
    </body>
</html>