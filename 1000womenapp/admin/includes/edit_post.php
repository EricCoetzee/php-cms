<?php 

if(isset($_GET['p_id'])){
$the_post_id = mysqli_real_escape_string($connection, trim($_GET['p_id']));
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";

$select_posts_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)) {

$post_id =  $row['post_id'];
$post_author =  $row['post_author'];
$post_title =  $row['post_title'];
$post_category =  $row['post_category_id'];
$post_status =  $row['post_status'];
$post_image =  $row['post_image'];
$post_quote =  $row['post_quote'];
$post_content =  $row['post_content'];
$post_tags =  $row['post_tags'];
$post_date =  $row['post_date'];
}

if(isset($_POST['update_post'])){
$post_title     = mysqli_real_escape_string($connection, trim($_POST['title']));
$post_author        = mysqli_real_escape_string($connection, trim($_POST['author']));
$post_category_id  =  mysqli_real_escape_string($connection, trim($_POST['post_category_id']));
$post_status       = mysqli_real_escape_string($connection, trim($_POST['post_status']));

$post_image        = mysqli_real_escape_string($connection, trim($_FILES['file-2']['name']));
$post_image_temp   = mysqli_real_escape_string($connection, trim($_FILES['file-2']['tmp_name']));


$post_tags         = mysqli_real_escape_string($connection, trim($_POST['post_tags']));
$post_quote      = mysqli_real_escape_string($connection, trim($_POST['post_quote']));
$post_content      = mysqli_real_escape_string($connection, trim($_POST['post_content']));

move_uploaded_file($post_image_temp, "../images/$post_image" );
if(empty($post_image)) {

$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_image = mysqli_query($connection,$query);

while($row = mysqli_fetch_array($select_image)) {

$post_image = $row['post_image'];

}}
// $post_title = mysqli_real_escape_string($connection, $post_title);   

$query = "UPDATE posts SET ";
$query .="post_title  = '{$post_title}', ";
$query .="post_category_id = '{$post_category_id}', ";
$query .="post_date   =  now(), ";
$query .="post_author = '{$post_author}', ";
/* $query .="post_user = '{$post_user}', "; */
$query .="post_status = '{$post_status}', ";
$query .="post_tags   = '{$post_tags}', ";
$query .="post_quote   = '{$post_quote}', ";
$query .="post_content= '{$post_content}', ";
$query .="post_image  = '{$post_image}' ";
$query .= "WHERE post_id = {$the_post_id} ";

$update_post = mysqli_query($connection,$query);


if(!$update_post){
    die("QUERY FAILED ." . mysqli_error($connection));
}

echo "<p class='bg-success'>Post Sucessfully Updated. <a href='posts'>View Post</a></p>";


}

?>

<form action="" method="post" class="addPostForm" enctype="multipart/form-data">    

<div class="form-group">
<label for="title">Post Title</label>
<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
</div>

<div class="form-group">
<label for="post_category_id">Category</label>
<div class="custom-select" style="width:250px;">
<select name="post_category_id" value="<?php echo $post_category_id; ?>"id="">
<option value="uncategorized">Select Category</option>
<?php 
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);


if(!$select_categories){
    die("QUERY FAILED ." . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($select_categories);

$cat_id =  $row['cat_id'];
$cat_title =  $row['cat_title'];

echo "<option value='{$cat_id}'>{$cat_title}</option>";

while($row = mysqli_fetch_assoc($select_categories)) {
    
$cat_id =  $row['cat_id'];
$cat_title =  $row['cat_title'];

echo "<option value='{$cat_id}'>{$cat_title}</option>";

}
?>

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
<label for="author">Post Author</label>
<input value="<?php echo $_SESSION['username']; ?>" type="text" class="form-control" name="author">
</div>

<div class="form-group">
<label for="post_status">Post Status</label>
<div class="custom-select custom-select-more" style="width:250px;">
<select name="post_status" id="">
<option value="<?php echo $post_status; ?>">Select Status</option>
<option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>

<?php
if($post_status === 'publish'){
echo '<option value="draft">draft</option>';
}else{
echo '<option value="publish">publish</option>';
}
?>
</select>
</div> 
</div> 

<!-- <div class="form-group">
<label for="post_status">Post Status</label>
<input type="text"value="<?php /* echo $post_status; */ ?>" class="form-control" name="post_status">
</div> -->

<div class="form-group">

<!-- <div class="button-wrap">
<label class ="new-button" for="upload"> Upload File
<input id="upload" type="file" >
</label>
<div> -->

<div class="">
<img width="100"  src="../images/<?php echo $post_image; ?>" alt="image needed">
</div>
</div>  
<div class="form-group">
<div class="box">
<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" />
<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Upload Image&hellip;</span></label>
</div>
</div>

<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
<small style="color: red;">This field is used for this websites search engine</small>
</div>

<div class="form-group">
<label for="post_quote">Inspitation</label>
<input type="text" value="<?php echo $post_quote; ?>" class="form-control" name="post_quote">
<small style="color: red;">Please update your Inspitational quote</small>
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea  class="form-control "  name="post_content" id="body"><?php echo $post_content; ?></textarea>
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div>

</form>
