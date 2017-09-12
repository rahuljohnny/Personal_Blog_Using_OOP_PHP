 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?> 

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>

    <?php 

       if ($_SERVER['REQUEST_METHOD']=="POST") {
           
           $fb=$fm->validation($_POST['fb']);
           $tw=$fm->validation($_POST['tw']);
           $ln=$fm->validation($_POST['ln']);
           $gp=$fm->validation($_POST['gp']);

           $fb=mysqli_real_escape_string($db->link, $fb);
           $tw=mysqli_real_escape_string($db->link, $tw);
           $ln=mysqli_real_escape_string($db->link, $ln);
           $gp=mysqli_real_escape_string($db->link, $gp);

           if ($fb=="" || $tw=="" || $ln=="" || $gp=="") {
               
               echo "Field Must not be Empty";
           }
           else{
               $query="UPDATE social SET
               fb='$fb',
               tw='$tw',
               ln='$ln',
               gp='$gp'
               WHERE id='1'
               ";
               $query=$db->update($query);
               if ($query) {
                  echo "Data Updated Successfully";
               }
               else{
               echo "Data not Updated";
               }
           }
           
       }


     ?>  

                <div class="block">  
                <?php 

                    $query="SELECT * FROM social WHERE id='1' ";
                    $link=$db->select($query);
                    if ($link) {
                       while ($row=$link->fetch_assoc()) {
                      

                 ?>             
                 <form action="social.php" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $row['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $row['tw']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $row['ln']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $row['gp']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php }} ?>
                </div>
            </div>
        </div>
 <?php include 'footer.php'; ?>       
 