<?php include "includes/db.php" ?>
<?php session_start(); ?>

<?php
 if(isset($_POST['login'])){
  $username = mysqli_real_escape_string($connection, trim($_POST['username']));
 $password = mysqli_real_escape_string($connection, trim($_POST['password']));

 $username = mysqli_real_escape_string($connection, trim($username));
 $password = mysqli_real_escape_string($connection, trim($password));

 $query = "SELECT * FROM users WHERE username = '{$username}' ";
 $select_users_query = mysqli_query($connection, $query);
 if(!$select_users_query){
    die("QUERY FAILED" . mysqli_error($connection));
}
while($row = mysqli_fetch_assoc($select_users_query )) {
    
     
     $db_user_id = $row['user_id'];
     $db_username = $row['username'];
     $db_user_password = $row['user_password'];
     $db_user_email = $row['user_email'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];
}
//$password = crypt($password, $db_user_password);
    if(password_verify($password,$db_user_password)){
        
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['email'] = $db_user_email;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

     header("Location: admin");
    }else {
        header("Location: /1000womenapp/");
    }
 }
?>