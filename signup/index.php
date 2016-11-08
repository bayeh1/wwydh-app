<?php
    session_start();
    include("../helpers/conn.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
 {
// username and password received from loginform
$Fname=mysqli_real_escape_string($conn,$_POST['Fname']);
$Lname=mysqli_real_escape_string($conn,$_POST['Lname']);
$username=mysqli_real_escape_string($conn,$_POST['username']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$login = $username.$password;
$login = md5($login);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$address=mysqli_real_escape_string($conn,$_POST['address']);
$sID = "";
$zipCode=mysqli_real_escape_string($conn,$_POST['zipCode']);





$sql_query="INSERT INTO users(id,first,last,username,login,email,address,zipCode) VALUES('sID','$Fname','$Lname','$username','$login','$email','$address','$zipCode')";
$result=mysqli_query($conn,$sql_query)or die(mysqli_error($conn));

if($result)
{
$_SESSION['login_user']=$username;

header("location: login.php");
}
else
{
$error="Registration Failed!";
}
}
?>
?>
<!DOCTYPE html>
<html>
    <head>
        <title>WWYDH | Login</title>
        <link href="../helpers/header_footer.css" type="text/css" rel="stylesheet" />
        <link href="style.css" type="text/css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <?php if (isset($error)) { ?>
            <script type="text/javascript">
                alert("Incorrect Username/Password!");
            </script>
        <?php } ?>
    </head>
    <body>
        <div class="bg"></div>
        <div id="nav">
            <div class="nav-inner width">
                <a href="..//home">
                    <div id="logo"></div>
                    <div id="logo_name">What Would You Do Here?</div>
                <div id="user_nav" class="nav">
                    <ul>
                        <a href="#" class="active"><li>Log in</li></a>
                        <a href="#"><li>Sign up</li></a>
                        <a href="../contact"><li>Contact</li></a>
                    </ul>
                </div>
                <div id="main_nav" class="nav">
                    <ul>
                        <a href="../locations"><li>Locations</li></a>
                        <a href="../ideas"><li>Ideas</li></a>
                        <a href="../plans"><li>Plans</li></a>
                        <a href="../projects"><li>Projects</li></a>
                    </ul>
                </div>
            </div>
        </div>
        <div id="signin">
            <div class="title">Sign in to WWYDH</div>
    <form method="post" action="#" name="loginform">
              <input type="text" value="" placeholder="Enter First Name"  name="Fname" class="form-size" />
              <input type="text" value="" placeholder="Enter Last Name"  name="Lname" class="form-size" />
              <input type="text" value="" placeholder="Enter Username"  name="username" class="form-size"/>
              <input type="password" value="" placeholder="Enter Password"  name="password" class="form-size" />
              <input type="text" value="" placeholder="Enter Email"  name="email" class="form-size" />
              <input type="text" value="" placeholder="Enter Address"  name="address" class="form-size" />
              <input type="text" value="" placeholder="Enter Zip Code" name="zipCode" class="form-size" />
              <input type="submit" id="enter" class="form-size" value="Sign Up">
</form>
        </div>
      <!--  <div id="footer"> -->
            <div class="grid-inner">
                &copy; Copyright WWYDH <?php echo date("Y") ?>
            </div>
        </div>
    </body>
</html>
