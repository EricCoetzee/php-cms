<?php ob_start();?>
<?php session_start() ?>

<?php include "includes/db.php";?>
<?php include "includes/functions.php";?>

<?php 

    require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
    require './classes/config.php';


    if(!isset($_GET['forgot'])){
        redirect('index');
    }
    if(ifItIsMethod('post') ){
        if(isset($_POST['email'])){
            $email = mysqli_real_escape_string($connection, $_POST['email']); 
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));

            if(email_exists($email)){
           if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")){

                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    /* 
                        configure PHPmailer
                    
                    
                    */


                    $mail = new PHPMailer();
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = Config::SMTP_HOST;                                 // Enable SMTP authentication
                    $mail->Username   = Config::SMTP_USER;                     // SMTP username
                    $mail->Password   = Config::SMTP_PASSWORD;                               // SMTP password
                    $mail->Port       = Config::SMTP_PORT;
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth   = true;
                    $mail->isHTML(true);   
                    $mail->CharSet = 'UTF-8';  

                    $mail->setFrom('ericcoetzee123@gmail.com', 'Eric Coetzee');
                    $mail->addAddress($email); 
                    $mail->Subject = 'Email Reset Link';
                    $mail->Body    = '<p> Please click the link in order to reset you password<br>
                    
                    <a href="http://localhost/1000womenapp/reset?email='.$email.'&token='.$token.' ">http://localhost/1000womenapp/reset.php?email='.$email.'&token='.$token.'</a>
                    
                    
                    
                    </p>';
                    
                    if($mail->send()){
                        $emailSent = true;
                    }else{
                        echo '<h2 style="color:red !important; display:flex; justify-content: center;">Connection Error</h2><p style="color:red !important; display: flex; justify-content: center;">password not updated!</p>';
                    }

            }else{
                echo '<h2 style="color:red !important; display:flex; justify-content: center;">Connection Error</h2><p style="color:red !important; display: flex; justify-content: center;">password not updated!</p>';
            }
        }else{
            echo '<h2 style="color:red !important; display:flex; justify-content: center;">Connection Error</h2><p style="color:red !important; display: flex; justify-content: center;">Email does not exist in database!</p>';
        }
        }
    }

?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>forgot Password</title>
     <link rel="stylesheet" href="dist/css/forgot.css">
 </head>

 
 <body >
     <div class="container-container">
     <div class="container">
     <div class="panel-box">
         <div class="text-center">

         <?php if(!isset( $emailSent)): ?>
     <h2 class="the-heading-one">Forgot your Password?</h2>
     
      <form action="" role="form" method="post" class="the-form" >

     <div class="form-group">
     <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    <input type="text" class="form-control" name="email" placeholder="email here" autocomplete="off">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="recover-submit" value="Reset Password">
    </div>
    <input type="hidden" class="hide" name="token" id="token" value="">

     </form>
        <a class="back-to-login" href="/1000womenapp/">Back to login</a>

         <?php else: ?>
        
            <h2 style="color:green;">Email Successfully Sent<h2>

     <h3>Please check your email...</h3>
     
     <a class="back-to-login" href="/1000womenapp/">Back to login</a>

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