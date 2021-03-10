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
</head>
<body>



  

                     <?php

        include 'dbcon.php';

if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($con, $_POST['username']) ;
  $email = mysqli_real_escape_string($con, $_POST['email']) ;
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']) ;
  $password = mysqli_real_escape_string($con, $_POST['password']) ;
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']) ;

    $pass = password_hash($password,  PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

    $emailquery = " select * from registration where email= '$email' ";
    $query = mysqli_query($con,$emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount>0){
      ?>
           <script>
               alert("This Email Already Exists,Please Try Another Email");
           </script>
          <?php
    }else{
      if($password === $cpassword){

          $insertquery = "insert into registration ( username, email, mobile, password, cpassword) values('$username', '$email','$mobile','$pass','$cpass')";

            $iquery = mysqli_query($con, $insertquery);

        if($iquery){

                 ?>
                   <script>
                       alert("Your Account Created Successfully");
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
                         alert("Registration failed ");
                     </script>
              <?php
        }

      }else{
        ?>
                   <script>
                         alert("Password are not matching ");
                              </script>
              <?php
             }
          }



}


        ?>

<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                
                    <div class="logo"> <a href="index.php"><h2 class="text-center">SiWebBd</h2></a></div>
                    <p class="text-center">Create New Account</p>
         <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">

           <div class="form-group input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="username" class="form-control" placeholder="User Name" type="text" required>
                      </div> <!-- form-group// -->
                      <div class="form-group input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email Address" type="email" required>
                          </div> <!-- form-group// -->
                           <div class="form-group input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                        </div>
                        <input name="mobile" class="form-control" placeholder="Phone Number" type="Number" >
                          </div> <!-- form-group// -->
                          <div>
                            <div class="form-group input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                         <input class="form-control" placeholder="Password" type="password" name="password" value="" required>
                             </div> <!-- form-group// -->
                             <div class="form-group input-group">
                               <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                               </div>
                               <input class="form-control" placeholder="Confirm password" type="password" name="cpassword" required>
                                </div> <!-- from-group// -->
                      <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block"> Create Account  </button>
                                    </div> <!-- form-group// -->
                                    <p class="text-center">Already have an account? <a href="login.php"> Log In</a> </p>
                                       </form>
                  </div>
                
            </div>
        </div>
    </div>
</body>
</html>
