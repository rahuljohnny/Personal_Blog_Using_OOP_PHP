 <?php include 'header.php'; ?>       
 <?php include 'sidebar.php'; ?>  

 
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
                            $query="INSERT INTO category (name) VALUES ('$name')";
                            $insert=$db->insert($query);  
                            if ($insert) {
                                 echo "<span class='success'>Data Insert Successfully </span>";
                             } 
                             else
                             {
                                 echo "<span class='error'> Data not Inserted.. </span>";
                             }

                        }
                    }

                 ?>

                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input name="name" type="text" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'footer.php'; ?>       
