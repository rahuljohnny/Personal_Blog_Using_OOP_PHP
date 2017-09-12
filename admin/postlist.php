 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>   
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="8%">Images</th>
							<th width="10%">Author</th>
							<th width="7%">Tags</th>
							<th width="15%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 

							$query="SELECT post.*,category.name FROM post INNER JOIN category ON post.cat_id=category.id ORDER BY post.title DESC";

							$result=$db->select($query);
							if ($result) {
								$i=0;

								while ($row=$result->fetch_assoc()) {
									
									$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $fm->text_shorten($row['title'],20) ?></td>
							<td><?php echo $fm->text_shorten($row['body'],30) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><img width="40px" height="30px" src="<?php echo $row['images'];?>"></td>
							<td><?php echo $row['author'] ?></td>
							<td><?php echo $row['tags'] ?></td>
							<td><?php echo $fm->formatDate($row['date']) ?></td>
							<td>
								<a href="edit_post.php?edit_post_id=<?php echo $row['id']; ?>">Edit</a> || 
								<a onclick="return confirm('Are you sure to delete??')" href="delete_post.php?delete_post_id=<?php echo $row['id']; ?>">Delete</a>
							</td>
						</tr>
						
						<?php }} ?>

					</tbody>
				</table>
	
               </div>
            </div>
        </div>
   <script type="text/javascript">

     $(document).ready(function () {
         setupLeftMenu();

         $('.datatable').dataTable();
			setSidebarHeight();


     });
     </script>         
 <?php include 'footer.php'; ?>       
 