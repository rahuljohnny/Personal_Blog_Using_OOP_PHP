 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>   

        <div class="grid_10">	
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                 <?php 
            if ($_SERVER['REQUEST_METHOD']=="POST") {
               
               $title=$fm->validation($_POST['copyright']);
               $title=mysqli_real_escape_string($db->link, $title);

               if (!empty($title)) {
                   $query="UPDATE footer SET 
                   copyright='$title'
                   WHERE id='1' ";
                   $footer_note=$db->update($query);
                   if ($footer_note) {
                       echo "Data Updated successfully";
                   }
                   else{
                    echo "Data not Updated";
                   }
               }
}
             ?>

            <div class="block copyblock"> 
                
     <?php 

        $query="SELECT * FROM footer WHERE id='1' ";
        $query=$db->select($query);
        if ($query) {
            while ($row=$query->fetch_assoc()) {
                
      ?>   
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $row['copyright']; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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
 