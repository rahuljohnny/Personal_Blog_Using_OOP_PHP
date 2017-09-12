<?php 
	include '../lib/session.php';
	session:: check_login(); 

?>
<?php include '../config/config.php' ?>
<?php include '../lib/Database.php' ?>
<?php include '../helpers/format.php' ?>

<?php 
	$db= new Database();
	$fm= new format();
 ?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php 

			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$username= $fm->validation($_POST['username']);
				$password= md5($fm->validation($_POST['password']));
				
				$username=mysqli_real_escape_string($db->link, $username);
				$password=mysqli_real_escape_string($db->link, $password);

				$query="SELECT * FROM user WHERE username='$username' AND password='$password' ";
				$query=$db->select($query);

				if ($query!=false) {
					$value=mysqli_fetch_array($query);
					$row=mysqli_num_rows($query);

					if ($row>0) {
						session::set("login",true);
						session::set("username",$value['username']);
						session::set("id",$value['id']);
						header("Location: index.php");
					}
					else{
						echo "No result Found";
					}
				}
				else{
					echo "Password or Username are not Matched";
				}
			}

		 ?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" name="login" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Dynaminc Blog</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>