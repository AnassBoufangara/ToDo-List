<?php 
 require_once("Config/session.php"); 
require_once("Functions/Infos.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ToDo List</title>
	<meta charest="UTF-8">
	<link rel="stylesheet" type="text/css" href="Style/style.css">
</head>
<body>
	<?php
		if(isset($_POST['submit'])) {
			if(isset($_POST['email']) && isset($_POST['password'])){
				$user = GetUser(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
				if(isset($user)) {
					$_SESSION['id'] = $user['id'];
					$_SESSION['username'] = $user['username'];
					$_SESSION['email'] = $user['email'];
					if(isset($_POST['remember'])) {
						$expireTime = time()+86400;
						setcookie("EmailCo", $user['email'], $expireTime);
						setcookie("UsernameCo", $user['username'], $expireTime);
					}
					header("Location: DoList/Activitie.php");
					exit;
				}else
					echo "<script>"."alert('Email/Password Invalid!');"."</script>";
			}else {
				echo "<script>"."alert('Enter Your Information!');"."</script>";
			}
		}
	?>
	<div class="container">
		<img src="Images/log.png">
		<form action="" method="post">
			<label>Email </label>
			<input type="email" name="email" placeholder="Enter Your Email">
			<label>Password </label>
			<input type="password" name="password" placeholder="Enter Your Password">
			<input type="checkbox" name="remember"><span>Remember Me.</span>
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>

</body>
</html>