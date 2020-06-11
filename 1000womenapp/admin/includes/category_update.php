<div class="category-form-container">

<form action="" method="post">

<div class="category-input-container">
<label for="cat-title"><h3>Edit Category</h3></label>

<?php 
if(isset($_GET['edit'])){
$cat_id = mysqli_real_escape_string($connection, trim($_GET['edit']));
$query = "SELECT * FROM categories WHERE cat_id = $cat_id";
$select_categories_id = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_categories_id)) {
$cat_id =  $row['cat_id'];
$cat_title =  $row['cat_title'];
?>

<input value="<?php if(isset( $cat_title )){ echo $cat_title; } ?>" class="category-input" autocomplete="off" type="text" placeholder="Category Name" name="cat-title">
<?php }} ?>

<?php //Update Query
if(isset($_POST['update_category'])){
$the_cat_title = mysqli_real_escape_string($connection, trim($_POST['cat-title']));
$query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
$update_query = mysqli_query($connection, $query);


if(!$update_query){
    die("QUERY FAILED ." . mysqli_error($connection));
    }
}
?>  
   
<input type="submit" class="category-submit" name="update_category" value="Update Category">

</div>
</form>
</div>