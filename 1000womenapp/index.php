<body>

<?php include "includes/header.php";?>
<?php include "includes/db.php" ?>
<?php
if(isset($_POST['create_user'])) {

$username       = mysqli_real_escape_string($connection, trim($_POST['username']));
$user_email       = mysqli_real_escape_string($connection, trim($_POST['user_email']));
$user_password   = mysqli_real_escape_string($connection, trim($_POST['user_password']));

if(!empty($username) && !empty($user_email) && !empty($user_password)){

$username = mysqli_real_escape_string($connection, trim($username));
$user_email  = mysqli_real_escape_string($connection, trim($user_email));
$user_password = mysqli_real_escape_string($connection, trim($user_password));

$user_password = password_hash($user_password , PASSWORD_BCRYPT, array('cost' => 12));

/* $query = "SELECT randSalt FROM users";
$select_randsalt_query = mysqli_query($connection, $query);
if(!$select_randsalt_query){
die("QUERY FAILED" . mysqli_error($connection));
} */

/* while($row = mysqli_fetch_assoc($select_randsalt_query)){
    $db_salt = $row['randSalt'];
    $user_password = crypt($user_password, $db_salt);
}

 */

$query = "INSERT INTO users(username, user_email, user_password, user_role) ";

$query .= "VALUES ('{$username}','{$user_email}', '{$user_password}', 'subscriber') "; 

$create_register_query = mysqli_query($connection, $query);  

if(!$create_register_query){
die("QUERY FAILED" . mysqli_error($connection) . ' ' . mysqli_errno($connection));
}
$message = "Your registration has been submitted";
}else{

$message = "Fields cannot be empty";
}   

}else {
    $message = "";
}
?>

    <div class="grid-container">
        <div class="header-left">
        <img src="images/1000.png" width="20%" style="margin-left:10px; margin-bottom:10px;" alt="">
        </div>
        
        <?php include "includes/right_header.php";?>

        <?php include "includes/section-one.php";?>
        <?php include "includes/register.php";?>
        
        <?php include "includes/footer.php";?>
      </div>
      <script src="dist/scripts/hscript.js"></script>
</body>
</html>