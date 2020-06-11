<div style="overflow-x:auto;"> 
<table>
<thead>

<tr>
<th>id</th> 
<th>Author</th>
<th>Title</th>
<th>Category</th>
<th>Status</th>
<th>Image</th>
<th>Tags</th>
<th>Comments</th>
<th>Date</th> 
<th>Edit</th>
<th>Delete</th>
<th>Views</th>
</tr>

</thead>
<tbody>

<?php 

$user = $_SESSION['username'];

$query = "SELECT * FROM posts WHERE post_author = '$user' ORDER BY post_id DESC";
$select_posts = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_posts)) {
 $post_id =  $row['post_id']; 
$post_author =  $row['post_author'];
$post_title =  $row['post_title'];
$post_category =  $row['post_category_id'];
$post_status =  $row['post_status'];
$post_image =  $row['post_image'];
$post_tags =  $row['post_tags'];
$post_date =  $row['post_date'];
$post_views =  $row['post_views_count'];


echo "<tr>";
echo "<td> $post_id </td>"; 
echo "<td> $post_author </td>";
echo "<td> $post_title </td>";

$query = "SELECT * FROM categories WHERE cat_id = {$post_category}";
$select_categories_id = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_categories_id)) {
$cat_id =  $row['cat_id'];
$cat_title =  $row['cat_title'];
echo "<td> {$cat_title} </td>";
}

echo "<td> $post_status </td>";
echo "<td> <img width='10'src='../images/$post_image'> </td>"; 
echo "<td> $post_tags </td>"; 

$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
$send_comment_query = mysqli_query($connection, $query);
$row = mysqli_fetch_array($send_comment_query);
$count_comments = mysqli_num_rows($send_comment_query);

echo "<td><a href='post_comments?id=$post_id'> $count_comments </a></td>"; 

echo "<td> $post_date </td>";
echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?')\" href='posts.php?delete={$post_id}'>Delete</a></td>"; 
echo"<td><a href='posts.php?reset={$post_id}'> $post_views</a></td>";
echo "</tr>";
}
?>

</tbody>
</table>
</div>
<?php 

if(isset($_GET['delete'])){

if($_SESSION['user_role'] === 'admin'){

if(isset($_GET['delete'])){
$the_post_id =mysqli_real_escape_string($connection, trim($_GET['delete']));
$query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
$delete_query = mysqli_query($connection, $query);
header("Location: posts");
}}}
if(isset($_GET['reset'])){

    if($_SESSION['user_role'] === 'admin'){
    
    if(isset($_GET['reset'])){
    $the_post_id =mysqli_real_escape_string($connection, trim($_GET['reset']));
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$the_post_id} ";
    $reset_query = mysqli_query($connection, $query);
    header("Location: posts");
    }}}

?>