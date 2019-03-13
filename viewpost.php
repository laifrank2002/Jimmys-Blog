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
	<div id="content">
		<?php

		$result = $database->query('SELECT postID, postTitle, postContent, postDate FROM blog_posts WHERE postID = '.$_GET['id']);
		$row = $result->fetch_assoc();

		if($row['postID'] == ''){
			header('Location: ./');
			exit;
		}

		echo '<div class="post shadow">';
			echo '<h1>'.$row['postTitle'].'</h1>';
			echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
			echo ''.$row['postContent'].'';
			echo '<p><a href="index.php">Back Home!</a></p>';
		echo '</div>';

		?>
	</div>
	
	<!-- include our headers and save some code! -->
	<?php require("common/footer.php"); ?>
</body>
</html>