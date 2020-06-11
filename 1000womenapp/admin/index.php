
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dist/css/dashboard.css">
    <link rel="shortcut icon" href="../images/1000.jpg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/ed7d75afe7.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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


  
  <!-- All Dashboard Content -->
    <div class="section-container"  id="main"> 
    

        <!--  Dashboard user Welcome -->
        <div class="dash-header">
            <h2>Welcome to Admin  <small><?php echo $_SESSION['username']; ?></small></h2>
        </div>
          

        <!-- Dashboard Post count Section  -->
        <div class="section-one">
        <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

        <?php 

            $query = "SELECT * FROM posts ";
            $select_all_post = mysqli_query($connection, $query);
            $post_count = mysqli_num_rows($select_all_post);
            echo "<div class='huge'>{$post_count}</div>";
        ?>


                          
                                <div class="under-number">Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts">
                        <div class="panel-footer">
                            <span class="pull-left blue">View Details</span>
                            <span class="pull-right blue"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>   
        </div>




        <!-- Dashboard Comment count Section  -->
        <div class="section-two">
        <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-4x"></i>
                            </div> 
                            <div class="col-xs-9 text-right">

        <?php 

        $query = "SELECT * FROM comments ";
        $select_comments_post = mysqli_query($connection, $query);
        $comment_count = mysqli_num_rows($select_comments_post);
        echo "<div class='huge'>{$comment_count}</div>"; 
        ?>
                            
                              <div class="under-number">Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments">
                        <div class="panel-footer">
                            <span class="pull-left green">View Details</span>
                            <span class="pull-right green"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>




        <!-- Dashboard Users count Section  -->
        <div class="section-three">
        <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
            <?php 
            $query = "SELECT * FROM users ";
            $select_users = mysqli_query($connection, $query);
            $user_count = mysqli_num_rows($select_users);
            echo "<div class='huge'>{$user_count}</div>";
            ?>
                                <div class="under-number"> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users">
                        <div class="panel-footer">
                            <span class="pull-left yellow">View Details</span>
                            <span class="pull-right yellow"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>  




      <!-- Dashboard Category count Section  -->
        <div class="section-four">
        <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
        <?php  
        $query = "SELECT * FROM categories ";
        $select_categories = mysqli_query($connection, $query);
        $category_count = mysqli_num_rows($select_categories);
        echo "<div class='huge'>{$category_count}</div>";
        ?>
                                <div class="under-number">Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories">
                        <div class="panel-footer">
                            <span class="pull-left red">View Details</span>
                            <span class="pull-right red"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>




    <!-- Dashboard Chart Section -->
        <div class="section-five">


          <!-- Dashboard Chart PHP Database Connection -->
            <?php

$query = "SELECT * FROM posts WHERE post_status = 'publish'";
$select_all_publish_post = mysqli_query($connection, $query);
$post_publish_count = mysqli_num_rows($select_all_publish_post); 

              
    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
    $select_all_draft_post = mysqli_query($connection, $query);
    $post_draft_count = mysqli_num_rows($select_all_draft_post); 


    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
    $select_unapproved_comments = mysqli_query($connection, $query);
    $unapproved_comment_count = mysqli_num_rows($select_unapproved_comments);

    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
    $select_subscriber_users = mysqli_query($connection, $query);
    $user_subscriber_count = mysqli_num_rows($select_subscriber_users); 
            ?>
            

            <!-- Dashboard Chart Script -->

            <script type="text/javascript">
          google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['1000 Women App data chart', 'chart'],

                <?php

                    $element_text = ['All Posts','Active Posts', 'Draft Posts' , 'Comments', ' Unapproved Comments', 'Users', 'Subscriber Users', 'Categories'];
                    $element_count = [$post_count, $post_publish_count ,  $post_draft_count, $comment_count, $unapproved_comment_count, $user_count, $user_subscriber_count, $category_count];

                    for($i = 0; $i < 7; $i++){
                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                    }
                ?>

            //  ['2014', 1000]
            ]);

            var options = {
              chart: {
                title: '',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        </script>

            <div id="columnchart_material" style="width: 80%; height: 500px;"></div>

        </div>

    </div> 




    <!-- Footer Section  -->
    <div class="footer">
   <div class="forum-footer">
         <p class="foot">
               &copy;1000Women || all rights reserved
         </p>
   </div>
</div>

    






































    <!-- <script src="../dist/scripts/menu.js"></script> -->
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
}

/*
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

    </script>
  </body>
</html>
