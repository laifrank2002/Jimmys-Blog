<DOCTYPE !php>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/blog.css">
	<title>Jimmy's Blog</title>
	<!-- also require the database -->
	<?php require("includes/config.php"); ?>
</head>
<body>
	<!-- include our headers and save some code! -->
	<?php require("common/header.php"); ?>
	
	<div id = "content">
		<div>
			<?php
				try {
					$statement = 'SELECT postID, postTitle, postDescription, postDate FROM blog_posts ORDER BY postID DESC';
					$result = $database->query($statement);
					
					while($row = $result->fetch_assoc()) {
						echo '<div class="post preview shadow">';
							echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
							echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
							echo '<p>'.$row['postDescription'].'</p>';                
							echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';                
						echo '</div>';
					}
				
					
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			?>
		</div>
	</div>
	
	<!-- include our headers and save some code! -->
	<?php require("common/footer.php"); ?>
</body>
</html>