<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fotogram</title>
</head>
<body>

    <div class="signUp">
        <img src="logo.png" class="loginAvatar">
        <h1>
             Sign Up
        </h1>
        <form method="post">
            <label for="first">First Name</label>
            <input type="text" name="first" placeholder="First Name">

            <label for="last">Last Name</label>
            <input type="text" name="last" placeholder="Last Name">

            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Email" id="email">

            <p id="eml" style="color:red"></p>

            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" >

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" id="passw">

            <p id="pass" style="color:red"></p>

            <label for="repeat">Repeat Password</label>
            <input type="password" name="repeat" placeholder="Repeat Password" id="repeatP">

            <p id="passR" style="color:red"></p>

            <input type="submit" name="signUpButton" value="Sign Up" id="btnID">

            <a href="index.php">Already have an account? Click here.</a>
        </form>
    </div>

    <script>
        var email = document.getElementById("email");
        var password = document.getElementById("passw");
        var passwordR = document.getElementById("repeatP");

        email.oninput = function() {
            var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	        if(email.value.match(pattern)){
                document.getElementById("eml").innerHTML = " ";
                document.getElementById("passw").disabled = false;
                document.getElementById("repeatP").disabled = false;
                document.getElementById("btnID").disabled = false;
	        }
            else if(email.value == "") {
                document.getElementById("eml").innerHTML = " ";
                document.getElementById("passw").disabled = false;
                document.getElementById("repeatP").disabled = false;
                document.getElementById("btnID").disabled = false;
            }
	        else{
		        document.getElementById("eml").innerHTML = "Please provide a valid email address ";
                document.getElementById("passw").disabled = true;
                document.getElementById("repeatP").disabled = true;
                document.getElementById("btnID").disabled = true;
	        }
        }

        password.oninput = function() {
            var v = /[a-z]/;
	        var u = /[A-Z]/;
	        var w = /[0-9]/;

            if(password.value.match(v) && password.value.match(u) && password.value.match(w) && password.value.length >= 8){
                document.getElementById("pass").innerHTML = " ";
                document.getElementById("email").disabled = false;
                document.getElementById("repeatP").disabled = false;
                document.getElementById("btnID").disabled = false;
            }
            else if(password.value == ""){
                document.getElementById("pass").innerHTML = " ";
                document.getElementById("email").disabled = false;
                document.getElementById("repeatP").disabled = false;
                document.getElementById("btnID").disabled = false;
            }
            else {
                document.getElementById("pass").innerHTML = "Password must contains numeric,lowercase and uppercase characters and minimum 8 characters";
                document.getElementById("email").disabled = true;
                document.getElementById("repeatP").disabled = true;
                document.getElementById("btnID").disabled = true;
            }
        }

        passwordR.oninput = function() {
            if(password.value == passwordR.value) {
                document.getElementById("passR").innerHTML = " ";
                document.getElementById("email").disabled = false;
                document.getElementById("pass").disabled = false;
                document.getElementById("btnID").disabled = false;
            }
            else if(passwordR.value == ""){
                document.getElementById("passR").innerHTML = " ";
                document.getElementById("email").disabled = false;
                document.getElementById("pass").disabled = false;
                document.getElementById("btnID").disabled = false;
            }
            else {
                document.getElementById("passR").innerHTML = "Password does not match";
                document.getElementById("email").disabled = true;
                document.getElementById("btnID").disabled = true;
            }
        }
    </script>
 
</body>
</html>