 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>  

<?php 

    if (!isset($_GET['cat_id']) || ($_GET['cat_id'])=="NULL") {
        echo "<script>window.location='catlist.php';</script>";
    }
    else{
        $id=$_GET['cat_id'];
    }
 ?>
 
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 

                <?php 

                    if ($_SERVER['REQUEST_METHOD']== 'POST') {
                        $name=$_POST['name'];
                        $name=mysqli_real_escape_string($db->link, $name);
                        if (empty($name)) {
                            echo "<span class='error'>Field Must not be empty !! </span>";
                        }
                        else{
                            $query="UPDATE category SET name='$name' WHERE id='$id' ";
                            $update=$db->update($query);  
                            if ($update) {
                                 echo "<span class='success'>Data Update Successfully </span>";
                             } 
                             else
                             {
                                 echo "<span class='error'> Data not Updated.. </span>";
                             }

                        }
                    }

                 ?>

                 <?php 

                     $query="SELECT * FROM category WHERE id='$id' ";
                     $query=$db->select($query);
                     if ($query) {
                         while ($row=$query->fetch_assoc()) {
                       
                  ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input name="name" value="<?php echo $row['name']; ?>" type="text" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }} ?>
                </div>
            </div>
        </div>
<?php include 'footer.php'; ?>       
