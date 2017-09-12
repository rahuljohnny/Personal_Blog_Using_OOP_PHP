 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>   


 <style type="text/css">
.left_side{
    float: left;
    width: 70%;
}
.right_side{
    float: left;
    width: 30%;
}
.right_side img{
    height: 150px;
    width: 150px;
}

 </style>

        <div class="grid_10">
	<?php 

        $query="SELECT * FROM title_slogan WHERE id='1' ";
        $update_logo=$db->select($query);
        if ($update_logo) {
            while ($row=$update_logo->fetch_assoc()) {
                 
    ?>
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock"> 
 <?php 

      if ($_SERVER['REQUEST_METHOD']=="POST") {
        $permited= array('png');
        
        $title=$fm->validation($_POST['title']);
        $slogan=$fm->validation($_POST['slogan']);
        
        $title=mysqli_real_escape_string($db->link, $title);
        $slogan=mysqli_real_escape_string($db->link, $slogan);

        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_tmp  = $_FILES['logo']['tmp_name'];

        $img_explode=explode('.', $file_name);
        $file_exit=strtolower(end($img_explode));
        $same_image = 'logo'.'.'.$file_exit;
        $uploaded_image = "upload/".$same_image;

        if ($title=="" || $slogan=="") {
          echo "Please Select All Field";
        }
        else{
        if (!empty($file_name)) {
           
            if($file_size>1048567){
              echo "Image size should be 1kb";
            }
            elseif (in_array($file_exit, $permited)===false) {
              echo "You can upload only".implode(', ', $permited);
            }
            else{

            move_uploaded_file($file_tmp, $uploaded_image);

            $query="UPDATE title_slogan
            SET
            title  ='$title',
            slogan ='$slogan'
            WHERE id='1' ";

            $result=$db->update($query);
            if ($result) {
              echo "Data updated successfully";
            }
            else{
              echo "Data not updated";
            }
          }
        }
          else{
            $query="UPDATE title_slogan
            SET
            title  ='$title',
            slogan ='$slogan'
            WHERE id='1' ";

            $result=$db->update($query);
            if ($result) {
              echo "Data updated successfully";
            }
            else{
              echo "Data not updated";
            }
          }
    }
}
?>         
                 <div class="left_side">

                 <form action="titleslogan.php" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Website Title..." value="<?php echo $row['title']; ?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Website Slogan..." value="<?php echo $row['slogan'] ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 
                         <tr>
                             <td>
                                 <label>Upload Image</label>
                             </td>
                             <td>
                                 <input type="file" name="logo"/>
                             </td>
                         </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

        
                    </div>

                    <div class="right_side">
                        <img src="<?php echo $row['logo']; ?>">
                        Logo

                    </div>

            </div>
        </div>
<?php }} ?>

 <?php include 'footer.php'; ?>       
