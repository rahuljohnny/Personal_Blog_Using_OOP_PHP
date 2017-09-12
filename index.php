<?php include 'inc/header.php' ?>
<?php include 'inc/slider.php' ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

		<!-- For Pagination -->

		<?php 

			$per_page=3;
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
			}
			else
			{
				$page=1;
			}

			$start=($page-1)*$per_page;


		 ?>

		<!-- For Pagination -->

		<?php 
			$query="SELECT * FROM post limit $start,$per_page";
			$post=$db->select($query);
			if ($post) {
				while ($row=$post->fetch_assoc()) {			
		 ?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($row['date']); ?>, By <a href="#"><?php echo $row['author']; ?></a></h4>
				 <a href="#"><img src="admin/<?php echo $row['images']; ?>" alt="post image"/></a>
				<p>
					<?php echo $fm->text_shorten($row['body']); ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $row['id']; ?>">Read More</a>
				</div>
			</div> 
			<?php }; ?> <!--  End Of While Loop -->

		<!-- Pagination Start -->

		<?php 

		$query="SELECT * FROM post";
		$result=$db->select($query);
		$total_rows=mysqli_num_rows($result);
		$total_page=ceil($total_rows/$per_page);

			echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>";

			for ($i=1; $i <=$total_page ; $i++) { 
				echo "<a href='index.php?page=".$i."'>".$i."</a>";
			}

			echo "<a href='index.php?page=$total_page'>".'Last Page'."</a></span>";

		 ?>



		<!-- Pagination End -->



			<?php } else {
				header('location: 404.php');
			}; ?>

		</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>

	