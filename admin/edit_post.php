 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>   
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <div class="block">    

        <?php 

            if (!isset($_GET['edit_post_id']) || ($_GET['edit_post_id'])=="NULL") {
                echo "<script>window.location='404.php';</script>";
            }
            else{
                $post_id=$_GET['edit_post_id'];
            }
         ?>

         <?php 

              if ($_SERVER['REQUEST_METHOD']=="POST") {
                $permited= array('jpg','jpeg','png','gif');

                $title=mysqli_real_escape_string($db->link, $_POST['title']);
                $cat_id=mysqli_real_escape_string($db->link, $_POST['cat_id']);
                $body=mysqli_real_escape_string($db->link, $_POST['body']);
                $author=mysqli_real_escape_string($db->link, $_POST['tags']);
                $tags=mysqli_real_escape_string($db->link, $_POST['author']);

                $file_name = $_FILES['images']['name'];
                $file_size = $_FILES['images']['size'];
                $file_tmp  = $_FILES['images']['tmp_name'];

                $img_explode=explode('.', $file_name);
                $file_exit=strtolower(end($img_explode));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_exit;
                $uploaded_image = "upload/".$unique_image;

                if ($title=="" || $cat_id=="" || $body=="" || $tags=="" || $author=="") {
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

                    $query="UPDATE post
                    SET
                    cat_id ='$cat_id',
                    title  ='$title',
                    body   ='$body',
                    images ='$uploaded_image',
                    author ='$author',
                    tags   ='$tags'
                    WHERE id='$post_id' ";

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
            $query="UPDATE post
            SET
            cat_id ='$cat_id',
            title  ='$title',
            body   ='$body',
            author ='$author',
            tags   ='$tags'
            WHERE id='$post_id' ";

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

      
         <?php 

            $query="SELECT * FROM post WHERE id='$post_id'ORDER BY id DESC";
            $result=$db->select($query);
            if ($result) {
                while ($row=$result->fetch_assoc()) {
                    

          ?>

         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $row['title'] ?>" class="medium" />
                    </td>

                </tr>
             
                         
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="cat_id">
                        <?php 

                            $query="SELECT * FROM category";
                            $query=$db->select($query);
                            if ($query) {
                            while ($cat_row=$query->fetch_assoc()) {
                         ?>
                        <option 

                        <?php 

                        if ($row['cat_id']==$cat_row['id']) { ?>

                        selected="selected";
                        <?php } ?>
                      
                        value="<?php echo $cat_row['id']; ?>"> <?php echo $cat_row['name']; ?></option>
                            
                           <?php }} ?>
                        </select>
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img width="150px" height="90px" src="<?php echo $row['images'] ?>"></br>
                        <input type="file" name="images"/>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $row['body']; ?>
                        </textarea>
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                     <td>
                        <input type="text" name="tags" value="<?php echo $row['title'] ?>" class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" name="author" value="<?php echo $row['author'] ?>" placeholder="Enter Author Name..." class="medium" />
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
 <!-- Load TinyMCE -->
 <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
 <script type="text/javascript">
     $(document).ready(function () {
         setupTinyMCE();
         setDatePicker('date-picker');
         $('input[type="checkbox"]').fancybutton();
         $('input[type="radio"]').fancybutton();
     });
 </script>
    <script type="text/javascript">
     $(document).ready(function () {
         setupLeftMenu();
        setSidebarHeight();
     });
 </script>

<?php include 'footer.php' ?>       
