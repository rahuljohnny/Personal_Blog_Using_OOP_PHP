 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>   
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">    

            <?php 

              if ($_SERVER['REQUEST_METHOD']=="POST") {
                $permited= array('jpg','jpeg','png','gif');

                $title=$_POST['title'];
                $cat_id=$_POST['cat_id'];
                $body=$_POST['body'];
                $tags=$_POST['tags'];
                $author=$_POST['author'];

                $title=mysqli_real_escape_string($db->link,$title);
                $cat_id=mysqli_real_escape_string($db->link,$cat_id);
                $body=mysqli_real_escape_string($db->link,$body);
                $author=mysqli_real_escape_string($db->link,$author);
                $tags=mysqli_real_escape_string($db->link,$tags);

                $file_name = $_FILES['images']['name'];
                $file_size = $_FILES['images']['size'];
                $file_tmp  = $_FILES['images']['tmp_name'];

                $img_explode=explode('.', $file_name);
                $file_exit=strtolower(end($img_explode));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_exit;
                $uploaded_image = "upload/".$unique_image;

                if ($title=="" || $cat_id=="" || $body=="" || $file_name=="" || $tags=="" || $author=="") {
                  echo "Please Select All Field";
                }
                elseif($file_size>1048567){
                  echo "Image size should be 1kb";
                }
                elseif (in_array($file_exit, $permited)===false) {
                  echo "You can upload only".implode(', ', $permited);
                }
                else{

                move_uploaded_file($file_tmp, $uploaded_image);

                $query="INSERT INTO post(cat_id,title,body,images,author,tags) VALUES('$cat_id','$title','$body','$uploaded_image','$author','$tags')";
                $result=$db->insert($query);
                if ($result) {
                  echo "Image Inserted successfully";
                }
                else{
                  echo "Image not Inserted";
                }
              }
              }

             ?>
         
         <form action="addpost.php" method="POST" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                                       while ($row=$query->fetch_assoc()) {
                                           


                             ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></option>
                            
                           <?php }} ?>
                        </select>
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="images"/>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" name="tags" placeholder="Enter Tags..." class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" name="author" placeholder="Enter Author Name..." class="medium" />
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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
