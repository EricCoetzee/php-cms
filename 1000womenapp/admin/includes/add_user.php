<?php 
if(isset($_POST['create_user'])) {

    // $user_id        = $_POST['user_id'];
    $firstname        = mysqli_real_escape_string($connection, trim($_POST['firstname']));
    $lastname  = mysqli_real_escape_string($connection, trim($_POST['lastname']));
    $user_role  = mysqli_real_escape_string($connection, trim($_POST['user_role']));
    $username       = mysqli_real_escape_string($connection, trim($_POST['username']));
    
    $user_email       = mysqli_real_escape_string($connection, trim($_POST['user_email']));
    $user_password   =mysqli_real_escape_string($connection, trim($_POST['user_password']));
    
    /* $post_tags         = $_POST['post_tags'];
    $post_content      = $_POST['post_content'];
    $post_date         = date('d-m-y'); */
    
    //move_uploaded_file($post_image_temp, "images/$post_image" );

    $user_password = password_hash($user_password , PASSWORD_BCRYPT, array('cost' => 10));

    
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    $query .= "VALUES ('{$firstname}','{$lastname}','{$user_role}','{$username}','{$user_email}', '{$user_password}') "; 
    $create_user_query = mysqli_query($connection, $query);  
    
    
    if(!$create_user_query){
    die("QUERY FAILED ." . mysqli_error($connection));
    }
    
    //$the_post_id = mysqli_insert_id($connection); 
    
    echo "<p class='bg-success'>User Created: <a href='users.php'>View user</a></p>";
    }

?>
<form action="" method="post" class="addPostForm" enctype="multipart/form-data">    

<div class="form-group">
<label for="firstname">Firstname</label>
<input type="text" class="form-control" name="firstname">
</div>
<div class="form-group">
<label for="lastname">Lastname</label>
<input type="text" class="form-control" name="lastname">
</div>

<div class="form-group">
<label for="category">User role</label>
<div class="custom-select" style="width:250px;">
<select name="user_role" id="">   
<option value='subscriber'>Select</option>
<option value='admin'>Admin</option>
<option value='subscriber'>Subscriber</option>
</select>
</div>
</div> 

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
<input type="text" class="form-control" name="username">
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
<input type="email" class="form-control" name="user_email">
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
<input type="password" class="form-control" name="user_password">
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
</div>

</form>