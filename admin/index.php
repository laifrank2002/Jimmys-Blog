<?php
//include config
require_once('../includes/config.php');

//if not logged in, redirect the user 
if(!$user->is_logged_in() ){ header('Location: login.php'); } 

//show message from add / edit page
if(isset($_GET['delpost'])){ 
	$stmt = $database->query('DELETE FROM blog_posts WHERE postID = '.$_GET['delpost']) ;
	header('Location: index.php?action=deleted');
	exit;
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<script language="JavaScript" type="text/javascript">
		function delpost(id, title)
		{
		  if (confirm("Are you sure you want to delete '" + title + "'"))
		  {
			  window.location.href = 'index.php?delpost=' + id;
		  }
		}
	</script>
</head>
<body>
	<div>
		<?php include('menu.php');?>

		<table>
		<tr>
			<th>Title</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
		<?php
			try {

				$result = $database->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
				while($row = $result->fetch_assoc()){
					
					echo '<tr>';
					echo '<td>'.$row['postTitle'].'</td>';
					echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
					?>

					<td>
						<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> | 
						<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
					</td>
					
					<?php 
					echo '</tr>';

				}

			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		?>
		</table>
		
		<p><a href='add-post.php'>Add Post</a></p>

	</div>
</body>
</html>