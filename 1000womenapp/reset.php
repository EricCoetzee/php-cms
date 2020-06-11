<?php ob_start();?>
<?php session_start() ?>

<?php include "includes/db.php";?>
<?php include "includes/functions.php";?>

<?php 

   require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
    require './classes/config.php';


    if(!isset($_GET['email']) && !isset($_GET['token']) ){
        redirect('index');
    }

    

    $email = "eric@ezeemax.net";
    $token = '507a1ec5b33bac6211db3543991319251cb0fd119ca07122dcec2c6f5c029bc9ded8c194276b9c7227d86a053d2341179f9b';
 
    if($stmt = mysqli_prepare($connection, 'SELECT username, user_email, token FROM users WHERE token=?')){

        mysqli_stmt_bind_param($stmt, 's', $_GET['token']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        
        
        /* if($_GET['token'] !== $token || $_GET['email']  !== $email){
            redirect('../');
        } */
        
        if(isset($_POST['password']) && isset($_POST['confirmPassword']) ){
            
            if($_POST['password'] === $_POST['confirmPassword']){

                $password = mysqli_real_escape_string($connection, $_POST['password']) ;

                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

                if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='{$hashedPassword}' WHERE user_email = ? ")){

                    mysqli_stmt_bind_param($stmt, "s",  $_GET['email']);
                    mysqli_stmt_execute($stmt);

                    if(mysqli_stmt_affected_rows($stmt) >= 1){
                        
                    }
                    mysqli_stmt_close($stmt);
                    $verified = true;

                }else{
                   echo '<h2 style="color:red !important; display:flex; justify-content: center;">Connection Error</h2><p style="color:red !important; display: flex; justify-content: center;">password not updated!</p>';
                }
            }
        }
    }else{
        echo '<h2 style="color:red !important; display:flex; justify-content: center;">Connection Error</h2><p style="color:red !important; display: flex; justify-content: center;">password not updated!</p>';
     }
 

?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Reset Password</title>
     <link rel="stylesheet" href="dist/css/reset.css">
 </head>

 
 <body >
     <div class="container-container">
         
     <div class="container">
     <div class="panel-box">
         <div class="text-center">

         <?php if(!isset($verified)): ?>
     <h2 class="the-heading-one">Reset your Password!</h2>
     
      <form action="" role="form" method="post" class="the-form" >

     <div class="form-group">
     <span class="input-group-addon"><i class="glyphicon glyphicon-password"></i></span>
    <input type="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="off">
    </div>

    <div class="form-group">
     <span class="input-group-addon"><i class="glyphicon glyphicon-password-two"></i></span>
    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" autocomplete="off">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="recover-submit" value="Reset Password">
    </div>
    <input type="hidden" class="hide" name="token" id="token" value="">

     </form>
        <a class="back-to-login" href="/1000womenapp/">Back to login</a>

         <?php else: ?>
            <h2 style="color:green;">Update Successful<h2>
     <h3 style="color:purple;">Please login with your new password</h3>
     
     <a class="back-to-login" href="/1000womenapp/index">Back to login</a>

         <?php endif; ?>
     </div>
     </div>
    </div>
    </div>
    <hr>

    <!-- Footer Section  -->
    <div class="footer">
   <div class="forum-footer">
         <p class="foot">
               &copy;1000Women || all rights reserved
         </p>
   </div>
</div>
 </body>
 </html>