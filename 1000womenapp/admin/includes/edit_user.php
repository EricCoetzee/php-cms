<?php

if(isset($_GET['edit_user'])){
$the_user_id = mysqli_real_escape_string($connection, trim($_GET['edit_user']));


$query = "SELECT * FROM users WHERE user_id = $the_user_id ";

$select_user_by_id = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_user_by_id)) {
$user_id =  $row['user_id'];
$user_firstname =  $row['user_firstname'];
$user_lastname =  $row['user_lastname'];
$user_role =  $row['user_role'];
$username =  $row['username'];
// $post_image =  $row['post_image'];
$user_email =  $row['user_email'];
$user_password =  $row['user_password'];

}
if(isset($_POST['edit_user'])) {

// $user_id        = $_POST['user_id'];
$user_firstname        = mysqli_real_escape_string($connection, trim($_POST['firstname']));
$user_lastname  = mysqli_real_escape_string($connection, trim($_POST['lastname']));
$user_role  = mysqli_real_escape_string($connection, trim($_POST['user_role']));
$username       = mysqli_real_escape_string($connection, trim($_POST['username']));

$user_email       = mysqli_real_escape_string($connection, trim($_POST['user_email']));
$user_password   = mysqli_real_escape_string($connection, trim($_POST['user_password']));

/* $post_tags         = $_POST['post_tags'];
$post_content      = $_POST['post_content'];
$post_date         = date('d-m-y'); */

//move_uploaded_file($post_image_temp, "images/$post_image" );

if(!empty($user_password)){
    $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
    $get_user_query = mysqli_query($connection, $query_password);
   if(!$get_user_query){
    die("QUERY FAILED" . mysqli_error($connection));
}
$row = mysqli_fetch_array($get_user_query);
$db_user_password = $row['user_password'];

if($db_user_password != $user_password){
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
}

$query = "UPDATE users SET ";
$query .="user_firstname  = '{$user_firstname}', ";
$query .="user_lastname = '{$user_lastname}', ";
$query .="user_role = '{$user_role}', ";
/* $query .="post_user = '{$post_user}', "; */
$query .="username = '{$username}', ";
$query .="user_email   = '{$user_email}', ";
$query .="user_password = '{$hashed_password}' ";
/* $query .="post_image  = '{$post_image}' "; */
$query .= "WHERE user_id = {$the_user_id} ";   
$update_user_query = mysqli_query($connection, $query);  

if(!$update_user_query){
    die("QUERY FAILED ." . mysqli_error($connection));
}
 header("Location: users");
} 
//$the_post_id = mysqli_insert_id($connection); 
} 
}else{
    header('Location: /1000womenapp/admin');
}
?>

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
<option value='<?php /* echo $user_role; */ ?>'>Select Role</option>
<option value='<?php /* echo $user_role; */ ?>'><?php /* echo $user_role; */ ?></option>

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