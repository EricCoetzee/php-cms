<button class="sign-up-btn"onclick="document.getElementById('id01').style.display='block'" type="button">Sign In</button>
<div id="id01" class="modal">
  <form class="modal-content animate" action="login.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="images/1000.png" width="20%" alt="">
    
    </div>

    <div class="modal-form-container">
      <label for="email"><b>Email</b></label>
      <input class="smallInput" type="text" placeholder="Enter Email" name="username" autocomplete="off">

      <label for="psw"><b>Password</b></label>
      <input class="smallInput" type="password" placeholder="Enter Password" name="password" autocomplete="off">
        
      <button class="smallbtn" type="submit"name="login">Sign In</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="modal-form-container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="forgot?forgot=<?php echo uniqid(true); ?>">password?</a></span>
    </div>
  </form>
</div>