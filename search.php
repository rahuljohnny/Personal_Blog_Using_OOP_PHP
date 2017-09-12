<?php include 'inc/header.php' ?>
<?php include 'inc/slider.php' ?>

<?php 

	if (!(isset($_GET['search'])) || ($_GET['search'])==NULL) {
		header("loction: 404.php");
	}
	else
	{
		$search=($_GET['search']);
	}

 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

			<?php 

				$query="SELECT * FROM post WHERE title LIKE '%$search%' OR body LIKE '%$search%' ";
				$post=$db->select($query);
				if ($post) {
					while ($row=$post->fetch_assoc()) {			
			 ?>

				<div class="samepost clear">
					<h2><a href="post.php?id=<?php echo ['id']; ?>"><?php echo $row['title']; ?></a></h2>
					<h4><?php echo $fm->formatDate($row['date']); ?>, By <a href="#"><?php echo $row['author']; ?></a></h4>
					 <a href="#"><img src="admin/upload/<?php echo $row['images']; ?>" alt="post image"/></a>
					<p>
						<?php echo $fm->text_shorten($row['body']); ?>
					</p>
					<div class="readmore clear">
						<a href="post.php?id=<?php echo $row['id']; ?>">Read More</a>
					</div>
				</div> 
				<?php }} else{?>

				<p>Search Not Found!!!</p>

		<?php }; ?> <!--  End Of While Loop -->


		
		</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>

