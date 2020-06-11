<div class="section-two">

            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="register-container">
                  <h2>Sign Up</h2>
                  <p>Please fill in this form to create an account.</p>
                  <hr>
              
                  <label for="username"><b>Username</b></label> <span class="error">*  <?php echo $message ?></span>
                  <input class="input-type" type="text" autocomplete="off" value="" placeholder="Enter Username" name="username">
              
                  <label for="user_email"><b>Email</b></label><span class="error">* </span>
                  <input class="input-type" type="text" autocomplete="off" placeholder="Enter Email" value="" name="user_email" >
              
                  <label for="user_password"><b>Password</b></label><span class="error">* </span>
                  <input class="input-type" type="password" autocomplete="off" placeholder="Enter Password"  value="" name="user_password" >
                  <hr>
                  <p>By creating an account you agree to our <a href="terms">Terms & Privacy</a>.</p>
              
                  <button type="submit" 
                   class="registerbtn" name="create_user">Register</button>
                </div>
            </form>
        </div>