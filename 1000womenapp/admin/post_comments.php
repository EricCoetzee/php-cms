<?php ob_start();?>
<?php session_start() ?>
<?php 

if(($_SESSION['user_role'] !== 'admin')){
 
  header("Location: ../subscriber");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="stylesheet" href="../dist/css/post_comments.css">
    <link rel="shortcut icon" href="../images/1000.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/ed7d75afe7.js" crossorigin="anonymous"></script>

</head>
<body>

<?php include "../includes/db.php";?>

<!-- Side navigation -->
<!-- Side navigation -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="/1000womenapp/admin/">Dashboard</a>
  <a href="/1000womenapp/admin/stories">Stories</a>
   <button class="dropdown-btn" onclick="closeOne()">Post 
    <i class="fa fa-caret-down" id="noCarot"></i>
  </button>
  <div class="dropdown-container" id="noDisplayOne">
    <a href="/1000womenapp/admin/posts?source=add_post">Create Post</a>
    <a href="/1000womenapp/admin/posts">View Posts</a>
  </div> 
  <a href="/1000womenapp/admin/categories">Categories</a>
  <a href="/1000womenapp/admin/comments">Comments</a>
  <button class="dropdown-btn" onclick="closeTwo()">User 
    <i class="fa fa-caret-down" id="noCarotTwo"></i>
  </button>
  <div class="dropdown-container" id="noDisplayTwo">
    <a href="/1000womenapp/admin/users?source=add_user">Add User</a>
    <a href="/1000womenapp/admin/users">View Users</a>
  </div>
  <a href="/1000womenapp/admin/maps">Women Shelters</a>
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
        <form class="search-form" action="/1000womenapp/admin/search" method="post">
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

<div style="overflow-x:auto;"> 
<table>
<thead>

<tr>
<th>id</th>
<th>Author</th>
<th>Comment</th>
<th>Email</th>
<th>Status</th>
<th>Date</th>
<th>Response to</th>
<th>Approve</th>
<th>Unapprove</th>
<th>Delete</th>
</tr>

</thead>
<tbody>

<?php 
$query = "SELECT * FROM comments WHERE comment_post_id=". mysqli_real_escape_string($connection, trim($_GET['id'])). " ";
$select_comments = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_comments)) {
$comment_id =  $row['comment_id'];
$comment_post_id =  $row['comment_post_id'];
$comment_author =  $row['comment_author'];
$comment_content =  $row['comment_content'];
$comment_email =  $row['comment_email'];
$comment_status =  $row['comment_status'];
$comment_date =  $row['comment_date'];

echo "<tr>";
echo "<td> $comment_id</td>";
echo "<td> $comment_author</td>";
echo "<td> $comment_content </td>";

/*  $query = "SELECT * FROM categories WHERE cat_id = {$post_category}";
$select_categories_id = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_categories_id)) {
$cat_id =  $row['cat_id'];
$cat_title =  $row['cat_title'];

echo "<td> {$cat_title} </td>";
} */

echo "<td> $comment_email </td>";
echo "<td> $comment_status </td>";
echo "<td> $comment_date </td>";

$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
$select_post_id_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_post_id_query)){
$post_id = $row ['post_id'];
$post_title = $row ['post_title'];
echo "<td> <a href='post/$post_id'> $post_title</a> </td>";
}

echo "<td><a href='post_comments.php?approve=$comment_id&id=" . mysqli_real_escape_string($connection, trim($_GET['id'])) ." '>Approve</a></td>";
echo "<td><a href='post_comments.php?unapprove=$comment_id&id=" . mysqli_real_escape_string($connection, trim($_GET['id'])) ." '>Unapprove</a></td>";
echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?')\" href='post_comments.php?delete=$comment_id&id=" . mysqli_real_escape_string($connection, trim($_GET['id'])) ." '>Delete</a></td>";
echo "</tr>";
}

?>

</tbody>
</table>
</div>
<?php 

if(isset($_GET['unapprove'])){
    $the_comment_id = mysqli_real_escape_string($connection, trim($_GET['unapprove']));
    $query = "UPDATE comments SET comment_status ='unapproved' WHERE comment_id = $the_comment_id";
    $unapprove_query = mysqli_query($connection, $query);
    header("Location: post_comments.php?id=" . mysqli_real_escape_string($connection, trim($_GET['id'])) . "");
    } 

    if(isset($_GET['approve'])){
        $the_comment_id = mysqli_real_escape_string($connection, trim($_GET['approve']));
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
        $approve_query = mysqli_query($connection, $query);
        header("Location: post_comments.php?id=" . mysqli_real_escape_string($connection, trim($_GET['id'])) . "");
        }

if(isset($_SESSION['user_role'])){

if($_SESSION['user_role'] === 'admin'){

if(isset($_GET['delete'])){
$the_comment_id = mysqli_real_escape_string($connection, trim($_GET['delete']));;
$query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
$delete_query = mysqli_query($connection, $query);
header("Location: post_comments.php?id=" . mysqli_real_escape_string($connection, trim($_GET['id'])) . "");
}}}

?>
</div>
<div class="footer">
   <div class="forum-footer">
         <p class="foot">
               &copy;1000Women || all rights reserved
         </p>
   </div>
</div>






































<<script>

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


<!-- <script src="../dist/scripts/select_dropdown.js"></script>
<script src="../dist/scripts/select_upload.js"></script>  -->
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