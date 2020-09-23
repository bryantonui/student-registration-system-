<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Profile</title>
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <h2>Student Registration System</h2>
            <h3>
            <?php 
            
            if (@$_GET['registered'] == 'true')
                echo "Your account has been created successfully";
            
            ?>
            </h3>

            <h3>
            <?php 
            if (isset($_SESSION['userUnavailable'])) {
                # code...
                echo $_SESSION['userUnavailable'];
                unset($_SESSION['userUnavailable']);
                session_destroy();
            }
            ?>
            </h3>
            <h3>
            <?php 
            //check if session variable exists 
            if (isset($_SESSION['emailTaken'])) {
                # code...
              //if email exists displat this message 
              echo $_SESSION['emailTaken'];
              //unset ensures after a refresh the message does not appear again
              unset($_SESSION['emailTaken']);
              session_destroy();
              //session killed when user leave the page
            }
            ?>
            </h3>
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In </button>

                <button type="button" class="toggle-btn"onclick="register()"> Register</button>
            </div>
            <div class="social-icons">
                <img src="fb.png">
                <img src="tw.png">
                <img src="gp.png">
            </div>

            
          
            <form method="post" action="access.php" id="login" class="input-group">
                <input type="email" class="input-field" name="emaillogin" placeholder="Email"required>
                <input type="password" class="input-field" name="passwordlogin" placeholder="Enter password"required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Log In</button>
            </form>

            
            <form method="post" action="register.php" id="register" class="input-group">
                <input type="text" class="input-field" name="name" placeholder="Student Name"required>
                <input type="email" class="input-field" name="email" placeholder="Email"required>
                <input type="password" class="input-field" name="password" placeholder="Enter password"required>
                <input type="password" class="input-field" name="cdpassword" placeholder="Confirm password"required>
                <input type="checkbox" class="check-box"><span>I agree to terms & conditions</span>
                <button type="submit"  name="creatacc" class="submit-btn">Register</button>
                
                
            </form>
        </div>
        
    </div>
    <script>
        var x=document.getElementById("login");
        var y=document.getElementById("register");
        var z=document.getElementById("btn");

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
    </script>
</body>
</html>