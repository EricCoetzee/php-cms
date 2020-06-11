<?php 
if(isset($_POST['create_post'])) {

    $post_title        = mysqli_real_escape_string($connection, trim($_POST['title']));
    $post_author        = mysqli_real_escape_string($connection, trim($_POST['author']));
    $post_category_id  = mysqli_real_escape_string($connection, trim($_POST['post_category_id']));
    $post_status       = mysqli_real_escape_string($connection, trim($_POST['post_status']));
    
    $post_image        = mysqli_real_escape_string($connection, trim($_FILES['file-2']['name']));
    $post_image_temp   = $_FILES['file-2']['tmp_name'];
    
    $post_tags         =mysqli_real_escape_string($connection, trim($_POST['post_tags']));
    $post_quote         = mysqli_real_escape_string($connection, trim($_POST['post_quote']));
    $post_content      = mysqli_real_escape_string($connection, trim($_POST['post_content']));
    $post_date         = mysqli_real_escape_string($connection, trim(date('d-m-y')));
    
    move_uploaded_file($post_image_temp, "../images/$post_image" );
    
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_quote,post_tags,post_status) ";        
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_quote}','{$post_tags}', '{$post_status}') ";         
    
    $create_post_query = mysqli_query($connection, $query);       
    
    if(!$create_post_query){
        die("QUERY FAILED ." . mysqli_error($connection));
    }
    
    //$the_post_id = mysqli_insert_id($connection); 
    echo "<p class='bg-success'>Post Created: <a href='/1000womenapp/admin/posts'>View post</a></p>";
    }

?>
    
<form action="" method="post" class="addPostForm" enctype="multipart/form-data">    

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title">
</div>

<div class="form-group">
<label for="category">Category</label>
<div class="custom-select" style="width:250px;">
<select name="post_category_id" id=""> 
<option value="uncategorized">Select Category</option>
<?php 
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);


if(!$select_categories){
    die("QUERY FAILED ." . mysqli_error($connection));
}

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
<input type="text" value="<?php echo $_SESSION['username']; ?>" class="form-control" name="author">
</div>

<div class="form-group">
<label for="post_status">Post Status</label>
<div class="custom-select custom-select-more" style="width:250px;">
<select name="post_status" id="">
<option value="draft">Select Status</option>
<option value="publish">Published</option>
<option value="draft">Draft</option>
</select>
</div>

<!-- <div class="form-group">
<label for="post_status">Post Status</label>
<input type="text" class="form-control" name="post_status">
</div> -->

<div class="form-group">
<!-- <div class="button-wrap">
<label class ="new-button" for="upload"> Upload File
<input id="upload" type="file" >
</label>
<div> -->
<div class="box">
<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" />
<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Upload Image&hellip;</span></label>
</div>
</div>

<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags">
<small style="color: red;">Tags will be used for website search engine</small>
</div>

<div class="form-group">
<label for="post_tags">Inspiratation</label>
<input type="text" class="form-control" name="post_quote">
<small style="color: red;">Please add an inspirational quote</small>
</div>


<div class="form-group">
<label for="post_content">Post Content</label>
<textarea class="form-control" style="height:200px" name="post_content" id="body" cols="30" rows="10"></textarea>
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>
</form>