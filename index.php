<?php
include('./db.php');
if(isset($_POST['submit'])){
	$temp=explode(":", $_POST['starttime']);
	$hour=$temp[0];
	$minute=$temp[1];
	$refresh=mysqli_query($con, "UPDATE calendar SET setTime = NULL");
	$q=mktime($hour, $minute, 0, 0, 0, 0);
	for($i=1;$i<=48;$i++){
		//echo date("H:i", $q);
		// echo $dateInsert."<br>";
		$query="INSERT INTO calendar(setTime) Values('". $q."')";
		//echo $query."<br>";
		$setRes=mysqli_query($con, $query);
		$q+=1800;
	}
	if(!$setRes){
		echo '<h1>Failed to insert</h1>';
	}else {
		'<h1>Successfully changed start time</h1>';
	}
}

$query="SELECT * FROM calendar WHERE setTime IS NOT NULL";
$res=mysqli_query($con, $query);
if(!$res) {
	die("Unable to fetch stuff");
}
$posts=mysqli_fetch_all($res, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Routine</title>
	<link rel="stylesheet" href="./style.css">
</head>
<body>
	<div>
		<form action="index.php" method="POST">
			<p>Start-time:</p>
			<input type="text" name="starttime" placeholder="HH:MM">
			<input type="submit" name="submit" value="submit">
		</form>
		<ul>
			<p>Time:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo date("h:i A", (int)$post['setTime']); ?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<ul>
			<p>Saturday:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo $post['Saturday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<ul>
			<p>Sunday:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo $post['Sunday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<ul>
			<p>Monday:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo $post['Monday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<ul>
			<p>Tuesday:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo $post['Tuesday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<ul>
			<p>Wednesday:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo $post['Wednesday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<ul>
			<p>Thursday:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo $post['Thursday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<ul>
			<p>Friday:</p>
			<?php foreach($posts as $post) : ?>
				<li><?php echo $post['Friday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
	</div>
</body>
</html>