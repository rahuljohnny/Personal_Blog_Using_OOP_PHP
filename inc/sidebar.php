		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<?php 

						$query="SELECT * FROM category";
						$category=$db->select($query);
						if ($category) {
							while ($row=$category->fetch_assoc()) {
								
					 ?>
					<ul> 
						<li><a href="posts.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
											
					</ul>
					<?php }}else
					{
						echo "No Category Created";
					} ?>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>

				<?php 
					$query="SELECT * FROM post LIMIT 5";
					$query=$db->select($query);
					if ($query) {
						while ($row=$query->fetch_assoc()) {
							

				 ?>
					<div class="popular clear">
						<h3><a href="posts.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h3>
						<a href="#"><img src="admin/<?php echo $row['images']; ?>" alt="post image"/></a>
						<p><?php echo $fm->text_shorten($row['body'],120) ?></p>	
					</div>

				<?php }}else{
					header("location: 404.php");
				}
				
				 ?>	
					
					
	
			</div>
			
		</div>