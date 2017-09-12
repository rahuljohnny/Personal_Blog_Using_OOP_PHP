<?php 
    include '../lib/session.php';
    session:: check_session(); 
?>

<?php include '../config/config.php' ?>
<?php include '../lib/Database.php' ?>
<?php include '../helpers/format.php' ?>

<?php 
    $db=new Database();
 ?>

 <?php 

 	if (!isset($_GET['delete_post_id']) || $_GET['delete_post_id']== NULL) {
 		echo "<script>window.location='404.php';</script>";
 	}
 	else{
 		$del_id=$_GET['delete_post_id'];

 		$query="SELECT * FROM post WHERE id='$del_id' ";
 		$query=$db->select($query);
 		if ($query) {
 			while ($row=$query->fetch_assoc()) {
 				$delete_img=$row['images'];
 				unlink($delete_img);
 			}
 		}

 		$del_query="DELETE FROM post WHERE id='$del_id' ";
 		$delete_data=$db->delete($del_query);
 		if ($delete_data) {
 			 echo "<span class='success'>Data Deleted Successfully </span>";
 			 echo "<script>window.location='postlist.php';</script>";
 		}
 		else{
 			 echo "<span class='error'>Data not Deleted </span>";
 			 echo "<script>window.location='postlist.php';</script>";
 		}
 	}

  ?>
