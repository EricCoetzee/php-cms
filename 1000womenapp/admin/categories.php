<?php ob_start();?>
<?php session_start() ?>
<?php include "../includes/db.php";?>

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
    <title>Categories</title>
    <link rel="stylesheet" href="../dist/css/categories.css">
    <link rel="shortcut icon" href="../images/1000.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/ed7d75afe7.js" crossorigin="anonymous"></script>

</head>
<body> 


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

<div class="category-container"  id="main">

<div class="category-header">
    <h2>Add edit or delete categories</small></h2>
</div>    

 
<div class="category-section-one"> 
<?php 
if(isset($_POST['submit'])) {
    $cat_title = mysqli_real_escape_string($connection, trim($_POST["cat-title"]));
    if($cat_title == "" || empty($cat_title)){
    echo "This field should not be empty";
    
    } else {
    $query = "INSERT INTO categories(cat_title)";
    $query .= "VALUE('{$cat_title}')";
    $create_category_query = mysqli_query($connection, $query);
    if(!$create_category_query){
    die('QUERY FAILED' . mysqli_error($connection));
    }}}

?>

    <div class="category-form-container">
        <form action="" method="post">
            <div class="category-input-container">
                <label for="cat-title"><h3>Add Category</h3></label>
                <input class="category-input" type="text" autocomplete="off" placeholder="Enter Category Name" name="cat-title" id="">
                <input type="submit" class="category-submit" name="submit" value="Add Category">
            </div>
        </form>
    </div>
<?php  //Update and include query
if (isset($_GET['edit'])) {
    $cat_id = mysqli_real_escape_string($connection, trim($_GET['edit']));
    include "includes/category_update.php";
}
?>
</div>

<div class="category-section-two">  
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Title</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            
<!-- //Find all categories query -->
<?php 
$query = "SELECT * From categories";
$select_categories = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_categories)) {
$cat_id =  mysqli_real_escape_string($connection, trim($row['cat_id']));
$cat_title = mysqli_real_escape_string($connection, trim($row['cat_title']));

echo "<tr>";
echo "<td>{$cat_id}</td>";
echo "<td>{$cat_title}</td>";
echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?')\" href='categories.php?delete={$cat_id}'>Delete</a></td>";
echo "<td><a href='categories?edit={$cat_id}'>Edit</a></td>";
echo "</tr>"; 
}
?>

<!-- //Delete Categories -->
<?php 
if(isset($_GET['delete'])){
if($_SESSION['user_role'] === 'admin'){

if(isset($_GET['delete'])){
$the_cat_id = mysqli_real_escape_string($connection, trim($_GET['delete']));
$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
$delete_query = mysqli_query($connection, $query);
header("Location: categories");
}}}

?>    
        </tbody>
    </table>
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
