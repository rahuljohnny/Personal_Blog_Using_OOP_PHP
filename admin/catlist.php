 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>   
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php 

                	if (isset($_GET['delete_id'])) {
                		$delete_id=$_GET['delete_id'];

                		$query="DELETE FROM category WHERE id='$delete_id' ";
                		$delete_data=$db->delete($query);

                		if ($delete_data) {
                			echo "<span class='success'> Data Successfully Deleted.. </span>";
                		}else{
                			echo "<span class='error'> Data not Deleted.. </span>";
                		}
                	}

                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 

							$query="SELECT * FROM category ORDER BY id DESC";
							$query=$db->select($query);
							if ($query) {
								$i=0;
								while ($row=$query->fetch_assoc()) {
									$i++;
								

						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><a href="edit_cat.php?cat_id=<?php echo $row['id']; ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete');" href="?delete_id=<?php echo $row['id']; ?>">Delete</a></td>
						</tr>

						<?php } } ?>
					
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
 