<?php
include('./db.php');
if(isset($_POST['submit'])){
	$temp=explode(":", $_POST['starttime']);
	$hour=$temp[0];
	if(isset($temp[1])){
		$minute=$temp[1];
	}else{
		$minute=0;
	}

	$break=300;
	$longbreak=900;
	$pomo=1800;
	$starttime=mktime($hour, $minute, 0, 0, 0, 0);
	/*$query="UPDATE calendar SET setTime='".$starttime."' limit 1";
	$setRes=mysqli_query($con, $query);
	if(!$setRes){
		die("Failed");
	}else {
		echo '<h1>Successfully changed start time</h1>';
	}*/
	$query="UPDATE calendar SET setTime=NULL";
	$setRes=mysqli_query($con, $query);
	$query="UPDATE calendar SET setTime='".$starttime."' where setTime IS NULL LIMIT 1";
		// echo $query;
	$setRes=mysqli_query($con, $query);
	$starttime+=$pomo+$break;
	for($i=1;$i<=41;$i++){
		$query="UPDATE calendar SET setTime='".$starttime."' where setTime IS NULL LIMIT 1";
		// echo $query;
		$setRes=mysqli_query($con, $query);
		if($i%4==0){
			$starttime+=$pomo+$longbreak;
		}else {
			$starttime+=$pomo+$break;
		}
	}
	
}

$query="SELECT * FROM calendar WHERE Saturday IS NOT NULL";
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
		<form action="new.php" method="POST">
			<p>Start-time:</p>
			<input type="text" name="starttime" placeholder="HH:MM">
			<input type="submit" name="submit" value="submit">
		</form>
		<ul>
			<p>Time:</p>
			<?php for($i=0;$i<count($posts);$i++) : ?>
				<li><?php echo date("h:i", (int)$posts[$i]['setTime'])." - ".date("h:i A", (int)$posts[$i]['setTime']+1800); ?></li>
				<small><li>break: <?php echo isset($posts[$i+1]) ? date("i", $posts[$i+1]['setTime']-$posts[$i]['setTime']+1800) : date("i", $posts[$i]['setTime']-$posts[$i]['setTime']) ?> minutes</li></small>
				<hr>
			<?php endfor; ?>
		</ul>
		<ul>
			<p>Routine:</p>
			<?php foreach($posts as $post) : ?>
				<li class="tasklist"><?php echo $post['Saturday']?></li>
				<hr>
			<?php endforeach; ?>
		</ul>
		<!-- <ul>
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
		</ul> -->
		<!-- <ul>
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
		</ul> -->
	</div>
</body>
</html>