<?php include 'inc/header.php'; ?>

<?php 

	if (!(isset($_GET['id'])) || ($_GET['id'])==NULL) {
		header("loction: 404.php");
	}
	else
	{
		$id=($_GET['id']);
	}

 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

			<?php 

				$query="SELECT * FROM post WHERE id=$id";
				$post = $db->select($query);
				if ($post) {
					while ($row=$post->fetch_assoc()) {
		
			 ?>

			<div class="about">
				<h2><?php echo $row['title']; ?></h2>
				<h4><?php echo $fm->formatDate($row['date']); ?>,By <?php echo $row['author']; ?></h4>
				<img src="admin/<?php echo $row['images']; ?>" alt="MyImage"/>
				<p><?php echo $row['body']; ?></p>

				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
						$cat_id=$row['cat_id'];
						$related_post="SELECT * FROM post WHERE cat_id='$cat_id' ORDER BY rand() LIMIT 6";
						$related_post=$db->select($related_post);
						if ($related_post) {
							while ($row=$related_post->fetch_assoc()) {
								
					 ?>
					<a href="#"><img src="admin/<?php echo $row['images']; ?>" alt="post image"/></a>
					<?php }}

					else {
						echo "Related Post are not Available";
					}
					 ?>
					
				</div>

				<?php } }else{header("location: 404.php");}?>
			</div>

		</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>
	