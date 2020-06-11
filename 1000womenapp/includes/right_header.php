<div class="header-right">
  <form class="form-inline" action="login.php   " method="post">
      <input type="text" id="login" placeholder="Enter Email" name="username" autocomplete="off">
      <input type="password" id="pwd" placeholder="Enter Password" name="password" autocomplete="off">
      <label>
        <input type="checkbox" name="remember"> Remember me
      </label>
      <button type="submit" name="login">Sign In</button>
  </form >
    <span class="forgot-account"><a href="forgot?forgot=<?php echo uniqid(true); ?>">Forgot Account?</a></span> 
    <?php include "login_modal.php";?>
    <?php include "register_modal.php";?>
</div>