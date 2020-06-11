<?php ob_start();?>
<?php session_start() ?>

<?php include "../includes/db.php";?>
<?php 

if(($_SESSION['user_role'] !== 'subscriber')){
 
  header("Location: ../");
  exit;
}

?>

<?php 

if(isset($_SESSION['username'])){
$username =  $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '{$username}'";
$select_user_profile_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_array($select_user_profile_query)){
$user_id =  $row['user_id'];
$username =  $row['username'];
$user_password =  $row['user_password'];
$user_firstname =  $row['user_firstname'];
$user_lastname =  $row['user_lastname'];
$user_email =  $row['user_email'];
$user_image =  $row['user_image'];
$user_role =  $row['user_role'];

}}

?>
<?php

if(isset($_POST['edit_user'])) {

// $user_id        = $_POST['user_id'];
$user_firstname        = mysqli_real_escape_string($connection, trim($_POST['firstname']));
$user_lastname  = mysqli_real_escape_string($connection, trim($_POST['lastname']));
/* $user_role  = mysqli_real_escape_string($connection, trim($_POST['user_role'])); */
$username       = mysqli_real_escape_string($connection, trim($_POST['username']));

$user_email       = mysqli_real_escape_string($connection, trim($_POST['user_email']));
$user_password   = mysqli_real_escape_string($connection, trim($_POST['user_password']));

/* $post_tags         = $_POST['post_tags'];
$post_content      = $_POST['post_content'];
$post_date         = date('d-m-y'); */

//move_uploaded_file($post_image_temp, "images/$post_image" );

$query = "UPDATE users SET ";
$query .="user_firstname  = '{$user_firstname}', ";
$query .="user_lastname = '{$user_lastname}', ";
$query .="user_role = '{$user_role}', ";
/* $query .="post_user = '{$post_user}', "; */
$query .="username = '{$username}', ";
$query .="user_email   = '{$user_email}', ";
$query .="user_password = '{$user_password }' ";
/* $query .="post_image  = '{$post_image}' "; */
$query .= "WHERE username = '{$username}' ";   
$update_user_query = mysqli_query($connection, $query);  


if(!$update_user_query){
  die("QUERY FAILED ." . mysqli_error($connection));
  }

//$the_post_id = mysqli_insert_id($connection); 

//echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit user <?php echo $_SESSION['username']; ?></title>
  <link rel="stylesheet" href="../dist/css/profile.css">
  <link rel="shortcut icon" href="../images/1000.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/ed7d75afe7.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Side navigation -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="/1000womenapp/subscriber/">Stories</a>
   <button class="dropdown-btn" onclick="closeOne()">Post 
    <i class="fa fa-caret-down" id="noCarot"></i>
  </button>
  <div class="dropdown-container" id="noDisplayOne">
    <a href="/1000womenapp/subscriber/posts">View Posts</a>
  </div>
  <a href="/1000womenapp/subscriber/maps">Women Shelters</a>
  </div>


<div class="grid-container" >
    <!-- Dashboard Menu Button -->
    <div class="dash-menu">
        <span style="cursor:pointer" onclick="openNav()">
            <a href="#">
                <i class=" top fas fa-bars">
                    <span class="hide">
                        Menu
                    </span>
                </i> 
            </a>
        </span>
    </div>  

   
    <!-- Search Section -->
    <div class="search">
        <form class="search-form" action="/1000womenapp/subscriber/search" method="post">
                <input name="search" type="text" autocomplete="off" class="search-box" placeholder="Search items"  required>
                <button class="search-btn" type="submit" name="submit">
                    <i class="top fas fa-search-plus">
                        <span class="hide">Search</span>
                    </i>
                </button> 
        </form>
    </div>
    

  <!-- User Dropdown Section -->
  <div class="user"> 
    <div class="dropdown">	
        <i onclick="dropdownFunction()" style="cursor:pointer" class="top dropbtn fas fa-user-circle">
            <span class="hide dropbtn"style="cursor:pointer"><?php echo $_SESSION['username']; ?></span>
        </i>
        <div id="myDropdown" class="dropdown-content">
            <a href="profile" class="fas fa-user">  Profile</a>
            <a href="contact.php" class="fas fa-envelope-open-text">  Contact us</a>
            <a href="../logout.php" class="fas fa-power-off logout">  Logout</a> 
        </div>
    </div>
  </div>
</div>

<div class="post-container" id="main">

<form action="" method="post" class="addPostForm" enctype="multipart/form-data">    


<div class="form-group">
<label for="firstname">Firstname</label>
<input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="firstname">
</div>
<div class="form-group">
<label for="lastname">Lastname</label>
<input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="lastname">
</div>

<!-- <div class="form-group">
<label for="category">User role</label>
<div class="custom-select" style="width:250px;">
<select name="user_role" value="" id="">   
<option value='subscriber'>Select Role</option>
<option value='subscriber'><?php /* echo $user_role; */ ?></option>

<?php 

/* if($user_role == 'admin'){
echo "<option value='subscriber'>Subscriber</option>";
}else{
echo "<option value='admin'>Admin</option>";
} */

?>


</select>
</div>
</div>  -->

<!-- <div class="form-group">
<label for="users">Users</label>
<div class=" custom-select" style="width:200px;">
<select name="post_user" id="">
<option value="draft">Empty</option>
</select>
</div>
</div> -->

<!-- <div class="form-group">
<label for="post_user">Post User</label>
<input type="text" class="form-control" name="post_user">
</div> -->

<div class="form-group">
<label for="author">Username</label>
<input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
</div>

<!-- <div class="form-group custom-select" style="width:200px;">
<select name="post_status" id="">
<option value="draft">Post Status</option>
<option value="published">Published</option>
<option value="draft">Draft</option>
</select>
</div> -->

<div class="form-group">
<label for="post_status">Email</label>
<input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
</div>

<!-- <div class="form-group">
<div class="button-wrap">
<label class ="new-button" for="upload"> Upload File
<input id="upload" type="file" >
</label>
<div>  
<div class="box">
<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" />
<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Upload Image&hellip;</span></label>
</div>
</div>-->

<div class="form-group">
<label for="post_tags">Password</label>
<input autocomplete="off" type="password" value="" class="form-control" name="user_password">
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="Update">
</div>

</form>

</div>

<div class="footer">
   <div class="forum-footer">
         <p class="foot">
               &copy;1000Women || all rights reserved
         </p>
   </div>
</div>
































<script>

document.addEventListener("DOMContentLoaded", function(event) { 
  ClassicEditor
.create( document.querySelector( '#body' ), {

  removePlugins: [ 'insertImage', 'insertMedia', 'Link' ],
  toolbar: [ 'Heading', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
} ) 
.catch( error => {
	console.error( error );
} );
});

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  setTimeout("carotAppear()", 300); 
  setTimeout("carotTwoAppear()", 300);
  

}

function closeNav() {
document.getElementById("mySidenav").style.width = "0";
document.getElementById("noCarot").style.display = "none";
document.getElementById("noCarotTwo").style.display = "none";
document.getElementById("noDisplayOne").style.display = "none";
document.getElementById("noDisplayTwo").style.display = "none"; 
}

function carotAppear() {
document.getElementById("noCarot").style.display = "inline";
 document.getElementById("noCarotTwo").style.display = "inline"; 
}

function closeOne(){
   document.getElementById("noDisplayTwo").style.display = "none"; 
}
function closeTwo() {
   document.getElementById("noDisplayOne").style.display = "none";
}

 function carotTwoAppear() {
  document.getElementById("noCarotTwo").style.display = "inline"; 
}/*
function twoAppear() {
  document.getElementById("noDisplayTwo").style.display = "block";
}  */

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

</script>

<script src="../dist/scripts/select_dropdown.js"></script>
<script src="../dist/scripts/select_upload.js"></script> 
<script>
    /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function dropdownFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */

</script>

</body>
</html> 