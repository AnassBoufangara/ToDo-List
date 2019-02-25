<?php 
require_once("../Config/session.php"); 
require_once("../Functions/Infos.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>ToDo List</title>
	<meta charest="UTF-8">
	<link rel="stylesheet" type="text/css" href="../Style/doStyle.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
	<div class="topbar">
		<p>Hello <?php echo $_SESSION["username"]?></p>
		<a href="../Logout.php">Logout</a>
	</div>
	<div class="Box">
		<h1>To Do List</h1>
		<div class="Con">
			<form action="Activitie.php" method="post">
				<input type="text" name="task" value="" placeholder="Task...">
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
		<?php
			if(isset($_GET['delete'])) {
				if(DeleteTasks(htmlspecialchars($_GET['delete']))){
					header("Location: Activitie.php");
				}
			}
		?>
		<div class="list1">
			<h2>Do</h2>
			<ul>
				<?php 
					if(isset($_SESSION['id'])) {
						$tasks = GetTasks($_SESSION['id'], 'Off');
						if(isset($tasks)){
							foreach($tasks as $task){
								echo '<li>
									<p class="title">'.$task['title'].'</p>
									<a class="delete" href="Activitie.php?delete='.$task["id"].'"><i class="fas fa-times-circle"></i></a>
									<a class="add" href="Activitie.php?add='.$task["id"].'"><i class="fas fa-check-circle"></i></a>
								</li>';

							}
						}
					}else{
						header("Location: ../index.php");
					}

					if(isset($_POST['submit'])) {
						if(isset($_POST['task'])){
							InsertTask($_SESSION['id'], htmlspecialchars($_POST['task']));
							header("Location: Activitie.php");
						}
					}
					
				?>
			</ul>
		</div>
		<div class="list2">
			<h2>Done</h2>
			<ul>
				<?php
					if(isset($_SESSION['id'])) {
						$tasks = GetTasks($_SESSION['id'], 'On');
						if(isset($tasks)){
							foreach($tasks as $task){
								echo '<li>
									<p class="title">'.$task["title"].'</p>
									<a class="delete" href="Activitie.php?delete='.$task["id"].'"><i class="fas fa-times-circle"></i></a>
								</li>';

							}
						}
					}else{
						header("Location: ../index.php");
					}

					if(isset($_GET['add'])) {
						if(UpdateTask(htmlspecialchars($_GET['add']))){
							header("Location: Activitie.php");
						}
					}
				?>
			</ul>
		</div>
	</div>

</body>
</html>