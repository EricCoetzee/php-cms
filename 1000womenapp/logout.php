
<?php 

 session_start(); 

session_destroy();
session_unset();

/* $_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['email'] = null;
$_SESSION['user_role'] = null; */

header('Location: /1000womenapp');
exit();
?>