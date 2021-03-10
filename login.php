<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Login-SiWebBd</title> 
    <?php include 'links/links.php' ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="new.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php
 include 'dbcon.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = " select * from registration where email='$email' ";
    $query = mysqli_query($con,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
         $email_pass = mysqli_fetch_assoc($query);

        $db_pass = $email_pass['password'];

        $_SESSION['username'] = $email_pass['username'];


        $pass_decode = password_verify($password, $db_pass);

        if($pass_decode){
               ?>
                   <script>
                         alert("Login Successful ");
                     </script>
              <?php

        ?>
        <script>
          location.replace("home.php");
        </script>
        <?php

         }else{
               ?>
                   <script>
                         alert("Password Incorrect ");
                     </script>
              <?php
         }

     }else{
               ?>
                   <script>
                         alert("Invalid Email ");
                     </script>
              <?php
     }

}

?>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                   <div class="logo"> <a href="index.php"><h2 class="text-center">SiWebBd</h2></a></div>
                    <p class="text-center">Login with your email and password.</p>
                    
                    <div class="form-group input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email Address" type="email" required>
                      </div> <!-- form-group// -->
                      <div class="form-group input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control" placeholder="Password" type="password" name="password" value="" required>
                             </div> <!-- form-group// -->
                    
                    <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block"> Log In </button>
                                    </div> <!-- form-group// -->
                    <div class="link login-link text-center">Don't Have Any Account? 
                     <a href="reg.php">Sign Up</a> 
                     </form>
                  </div>
                
            </div>
        </div>
    </div>
</body>
</html>
