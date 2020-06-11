<button class="sign-up-btn" onclick="document.getElementById('id02').style.display='block'" type="button">Sign up</button>
              <div id="id02" class="modal">
                <form class="modal-content animate" action="index.php" method="post" enctype="multipart/form-data">
                  <div class="imgcontainer">
                    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <img src="images/1000.png" width="20%" alt="">
                  </div>
              
                  <div class="modal-form-container">
                    <label for="username"><b>Username</b></label><span class="error">* <?php echo $message ?></span>
                    <input class="smallInput" type="text" value="" placeholder="Enter Username" name="username"  autocomplete="off">

                    <label for="email"><b>Email</b></label><span class="error">* </span>
                    <input class="smallInput" type="text" placeholder="Enter Email"  name="user_email"  autocomplete="off">
              
                    <label for="psw"><b>Password</b></label><span class="error">* </span>
                    <input class="smallInput" type="password" placeholder="Enter Password"  name="user_password" autocomplete="off">
                      
                    <button class="smallbtn" type="submit" name="create_user">Sign Up</button>
                    <label>
                      By creating an account you agree to our <a href="terms"> Terms & Privacy</a>.
                    </label>
                  </div>
              
                  <div class="modal-form-container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                  </div>
                </form>
              </div>