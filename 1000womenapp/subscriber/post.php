<?php ob_start();?>
<?php session_start() ?>
<?php include "../includes/db.php";?>

<?php 

if(($_SESSION['user_role'] !== 'subscriber')){
 
  header("Location: ../");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['post_title']; ?></title>
    <link rel="stylesheet" href="/1000womenapp/dist/css/post.css">
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
            <a href="/1000womenapp/subscriber/profile" class="fas fa-user">  Profile</a>
            <a href="/1000womenapp/subscriber/contact.php" class="fas fa-envelope-open-text">  Contact us</a>
            <a href="/1000womenapp/logout.php" class="fas fa-power-off logout">  Logout</a> 
        </div>
    </div>
  </div>
</div>

<div class="forum-section">

    <div class="forum-head">
        <h1>Knowledge Base</h1>
    </div>

<div class="forum-section-in-section" id="main">
<?php
if(isset($_GET['p_id'])){
$the_post_id = mysqli_real_escape_string($connection, trim($_GET['p_id']));

$view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
$send_query = mysqli_query($connection, $view_query);
if(!$send_query){
   die('QUERY FAILED');
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";

$select_all_post_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_all_post_query)) {
$post_identity =  $row['post_id'];
$post_title =  $row['post_title'];
$post_author =  $row['post_author'];
$post_date =  $row['post_date'];
$post_image =  $row['post_image'];
$post_content =  $row['post_content'];
$_SESSION['post_title'] = $post_title;

}
?>
<div class="forum-section-container">
<h2 class="forum-title"><a href="#" class="forum-title-link" ><?php echo $post_title ?></a></h2>

<p class="forum-author"><strong>by</strong> <a href="" class="forum-author-link"><?php echo $post_author ?></a> &sol; <i class="far fa-clock"> <?php echo $post_date ?></i></p>
<hr class="line-rule">
<img class="forum-image" src="/1000womenapp/images\<?php echo $post_image ?>" alt="image">
<p class="forum-content"><?php echo $post_content ?></p>



   <?php

      if(isset($_SESSION['user_role'])){

         if(isset($_GET['p_id'])){

            $the_post_id = mysqli_real_escape_string($connection, trim($_GET['p_id']));
            echo "<div class='container-for-post-section-edit-btn'><a href='/1000womenapp/subscriber/posts.php?source=edit_post&p_id={$the_post_id}'><button class='forum-section-edit-btn'>Edit Post</button></a></div>";
         }
      } 
   }else{
      header("Location: index");
   }
      
      ?>
</div>

<hr class="line-rule"> 
<?php 
if(isset($_POST['create_comment'])){  
$the_post_id = mysqli_real_escape_string($connection, trim($_GET['p_id']));
$comment_author = mysqli_real_escape_string($connection, trim($_POST['comment_author']));
$comment_email = mysqli_real_escape_string($connection, trim($_POST['comment_email']));
$comment_content = mysqli_real_escape_string($connection, trim($_POST['comment_content']));

$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
$query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'comment_status', now())";

$create_comment_query = mysqli_query($connection, $query);

if(!$create_comment_query){
   die("QUERY FAILED ." . mysqli_error($connection));
   }

/* $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id ";
$update_comment_count = mysqli_query($connection, $query);   */

}

/* if(){
   $_SESSION['post_title'] = $post_title;
} */

if(isset($_GET['p_id'])){

$the_post_id = mysqli_real_escape_string($connection, trim($_GET['p_id'])); 

if($the_post_id == $post_identity){
   

}
}  

?>

<h4>Leave a comment</h4>
<form action="" method="post">
<div class="form-group">
   <label for="author">Name</label>
      <input type="text" class="form-control" value="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ; ?>" name="comment_author">
</div>

<div class="form-group">
   <label for="email">Email</label>
      <input type="email" value="<?php echo $_SESSION['email']; ?>" class="form-control" name="comment_email">
</div>

<div class="form-group">
   <label for="post_content">Comment</label>
   <textarea class="form-control .ck-editor__editable_inline" name="comment_content" id="body"></textarea>
</div>

   <div class="form-group">
      <input class="btn btn-primary" type="submit" name="create_comment" value="Submit">
</div>
</form>

<h4>Comments on this Post</h4>
<?php
if(isset($_GET['p_id'])){
   $the_post_id = mysqli_real_escape_string($connection, trim($_GET['p_id']));

$query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} " ;
$query .= "AND comment_status = 'approved' ORDER BY comment_id DESC ";
$select_comment_query = mysqli_query($connection, $query);

if (!$select_comment_query){
die("Query failed " . mysqli_error($connection));
}

while ($row = mysqli_fetch_array($select_comment_query))  {
$comment_date = $row['comment_date'];
$comment_content = $row['comment_content'];
$comment_author = $row['comment_author'];

?>

<div class="">
   <a class="" href="">
      <img style="float: left; border-radius:50%; margin-right: 5px;" src="http://placehold.it/64x64" alt="">
   </a>
   <div>
      <p style="font-family: Veranda;">Comment by <strong><?php echo $comment_author; ?></strong><br>
      Posted on <small><strong><?php echo $comment_date; ?></strong></small>
      <?php echo $comment_content; ?>
      
      </p>
   </div>
</div>
<hr width="50%" style="margin:20px">
<?php } 
}
?>

</div>
</div>


<div class="footer">
   <div class="forum-footer">
         <p class="foot">
               &copy;1000Women || all rights reserved
         </p>
   </div>
</div>




















<!-- Script Section -->

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

<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
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