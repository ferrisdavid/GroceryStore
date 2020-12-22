<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--link to the jquery CDN-->
        <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet"> <!--link to the google font-->
        <link rel="stylesheet" href="CSS/signup.css"> <!--link to the signup page css-->
        <title>Grocery Login Page</title>
    </head>
    <body>
        <div>
            <h2>Sign Up</h2>
            <form action="includes/signup.inc.php" method="POST" id="signupForm"> <!--simple sign up form that accepts a name, email, username, password, and the password repeated, form is submitted with the post method to protect information-->
                <input type="text" name="name" placeholder="Full name..." id="name"><br>
                <input type="text" name="email" placeholder="Email..." id="email"><br>
                <input type="text" name="uid" placeholder="Username..." id="userid"><br>
                <input type="password" name="pwd" placeholder="Password..." id="passwd"><br> <!--password fields are given type password to hide the input-->
                <input type="password" name="pwdrepeat" placeholder="Repeat Password..." id="passwdrp"><br>
                <button type="submit" name="submit" id="signup">Sign-Up</button><br>
            </form>
            <br>
            <p> Go back to log in</p><a href="login.php">Log in</a><br> <!--link to return the user to the log in page-->
        <script>
            //this function checks that all the fields of the signup form have been filled in
            //Note that the more complex validations of specific fields is handled by our php in functions.inc.php
            function basicFormValidate(name,email,userid,passwd,passwdrp){
                if(name==""||email==""||passwdrp==""||passwd == "" || userid==""){ //if any of the fields are empty return false
                    return false;
                }
                return true; //else return true
            }
            //set up jquery event when the document is loaded
            $(document).ready(()=>{
                //set up event listener for the click of the signup submit button
                $("#signup").on("click", (e)=>{
                    //retrieve the values of the submitted fields using jquery selectors
                    let name = $("#signupForm").find('input[name="name"]').val();
                    let email = $("#signupForm").find('input[name="email"]').val();
                    let userid = $("#signupForm").find('input[name="uid"]').val();
                    let passwd = $("#signupForm").find('input[name="pwd"]').val();
                    let passwdrp = $("#signupForm").find('input[name="pwdrepeat"]').val();
                    //get the boolean value corresponding to whether each field is filled in
                    let isFilled = basicFormValidate(name,email,userid,passwd,passwdrp);
                    if(isFilled==false){//if at least one field is empty prevent the submission of the form and alert the user of the error
                        e.preventDefault();
                        alert("One or more Missing Fields. Please Fill in all fields!");
                    }
                })
            })
        </script>
        <?php
            //this code retrieves the error from the query string in the url that is sent by our php functions in signup.inc.php and functions.inc.php if it is present
            if(isset($_GET["error"])){ 
                if($_GET["error"] == "emptyinput"){ //if we have empty field display an appropriate message (Note that the js handles this, this is simply a backup function)
                    echo "<p style='color: #e73b4f;text-align: center;padding:1%'>One or more Missing Fields. Please Fill in all Fields</p>";
                }
                elseif($_GET["error"] == "invaliduid"){ //if the inputted username is invalid then display an appropriate message
                    echo "<p style='color: #e73b4f;text-align: center;padding:1%'>Please Input a Valid Username: Remeber your Name Cannot be the same as your Username!</p>";
                }
                elseif($_GET["error"] == "invalidemail"){//if the inputted email is invalid then display an appropriate message
                    echo "<p style='color: #e73b4f;text-align: center;padding:1%'>Please Input a Valid Email</p>";
                }
                elseif($_GET["error"] == "passwordsdontmatch"){//if the inputted password does not match the repeated password field then display an appropriate message
                    echo "<p style='color: #e73b4f;text-align: center;padding:1%'>Passwords do not match</p>";
                }
                elseif($_GET["error"] == "usernametaken"){//if the inputted username is already taken then display an appropriate message
                    echo "<p style='color: #e73b4f;text-align: center;padding:1%'>Username or Email is already in Use</p>";
                }
                elseif($_GET["error"] == "passwordtooshort"){ //if the inputted password is less than 6 characters then display an appropriate message
                    echo "<p style='color: #e73b4f;text-align: center;padding:1%'>Password must be longer than 6 characters</p>";
                }
                elseif($_GET["error"] == "none"){ //if error is none then we have successfully signed the user up
                    echo "<p>You Have Signed up Successfully!";
                }
            }
        ?>
        </div>
    </body>
</html>