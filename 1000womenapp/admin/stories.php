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
    <title>Stories</title>
    <link rel="stylesheet" href="../dist/css/stories.css">
    <link rel="shortcut icon" href="../images/1000.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/ed7d75afe7.js" crossorigin="anonymous"></script>

    <style>
      pre {
  white-space: pre-wrap;
  word-wrap: break-word;
  text-align: justify;
}
    </style>
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


<div class="forum-section" id="main">
        
        <!-- Forum head -->
        <div class="forum-head">
            <h1>Knowledge Base</h1>
        </div>

        <div class="forum-section-in-section">

        <!-- Forum Post selection from Database -->
        <?php
        $query = "SELECT * FROM posts  ORDER BY post_date  ";

        $select_all_post_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_all_post_query)) {
            $post_id =  $row['post_id'];
            $post_title =  $row['post_title'];
            $post_author =  $row['post_author'];
            $post_date =  $row['post_date'];
            $post_image =  $row['post_image'];
            $post_quote =  $row['post_quote'];
            $post_status =  $row['post_status'];

            if($post_status == 'publish' ){
            
        ?>

        <!-- Forum Post Display -->
        <div class="forum-section-container">

            <!-- Forum post title -->
            <h2 class="forum-title"><a href="post/<?php echo $post_id; ?>" class="forum-title-link" ><?php echo $post_title ?></a></h2>

            <!-- Forum Post Author and Date  -->
            <p class="forum-author"><strong>by</strong> <a href="authors?author=<?php echo $post_author?>&p_id=<?php echo $post_id?>" class="forum-author-link"><?php echo $post_author ?></a> &sol; <i class="far fa-clock"> <?php echo $post_date ?></i></p>

            <hr class="line-rule">

            <!-- Forum Post image -->
            <a href="post/<?php echo $post_id; ?>"><img class="forum-image" src="../images/<?php echo $post_image ?>" alt="image"></a>
            
            
            <!-- Forum Post Content -->
            <pre class="forum-content"><strong>Inspiration: </strong> 
            
"<?php echo $post_quote ?>" 

                -<?php echo $post_author?>
          
          </pre> 
            
            <!-- Forum Post Read More button -->
            <a href="/1000womenapp/admin/post/<?php echo $post_id;?>" class="forum-title-link" ><button class="read-more-btn">Read More</button></a>
            
        </div>
        <hr class="line-rule"> 

        <?php  }  }?> 
        
        </div>
    
        
        <!-- Forum Show Categories Section Aside -->
        <div class="forum-side">
            <h2 class="forum-side-heading">Popular Category</h2>

            <!-- Selelect categories from the database -->
            <?php 
                $query = "SELECT * From categories";
                $select_categories_sidebar = mysqli_query($connection, $query);
            ?>

            <!-- Display categories in a ul while loop -->
            <div class="catogory-row">
                <ul>
                    <?php 
                        while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                            $cat_title =  $row['cat_title'];
                            $cat_id =  $row['cat_id'];
                            echo "<li class='forum-categories'><a href='/1000womenapp/admin/category/{$cat_id} '>{$cat_title}</a></li>";
                        }
                    ?>  
                </ul>
            </div>
        
        </div>

        <!-- The Widget area to be added -->
        <div class="widget"> 
                        Widget area
        </div>
        
    </div> 

    <!-- Forum Footer -->
    <div class="footer">
   <div class="forum-footer">
         <p class="foot">
               &copy;1000Women || all rights reserved
         </p>
   </div>
</div>






























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