<div style="overflow-x:auto;"> 
<table>
<thead>

<tr>

<th>Author</th>
<th>Title</th>
<th>Category</th>
<th>Image</th>
<th>Comments</th>
<th>Date</th>
<th>Views</th>
</tr>

</thead>
<tbody>

<?php 
$query = "SELECT * FROM posts ORDER BY post_id DESC";
$select_posts = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_posts)) {
 $post_id =  $row['post_id']; 
$post_author =  $row['post_author'];
$post_title =  $row['post_title'];
$post_category =  $row['post_category_id'];
$post_image =  $row['post_image'];
$post_date =  $row['post_date'];
$post_views =  $row['post_views_count'];


echo "<tr>";
echo "<td> $post_author </td>";
echo "<td> $post_title </td>";

$query = "SELECT * FROM categories WHERE cat_id = {$post_category}";
$select_categories_id = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_categories_id)) {
$cat_id =  $row['cat_id'];
$cat_title =  $row['cat_title'];
echo "<td> {$cat_title} </td>";
}


echo "<td> <img width='10'src='../images/$post_image'> </td>"; 


$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
$send_comment_query = mysqli_query($connection, $query);
$row = mysqli_fetch_array($send_comment_query);
$count_comments = mysqli_num_rows($send_comment_query);

echo "<td> $count_comments </td>"; 

echo "<td> $post_date </td>";
echo"<td>$post_views</td>";
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