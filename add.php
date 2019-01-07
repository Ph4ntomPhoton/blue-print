<?php
include('./db.php');
// var_dump($_REQUEST);
if(isset($_POST['submit'])){
	$query="UPDATE calendar SET Saturday ='".$_POST['adddata']."' WHERE setTime='".$_POST['timeslot']."'";
	// echo $query;
	$setRes=mysqli_query($con, $query);
	if(!$setRes){
		echo '<h1>Failed</h1>';
	}else {
		echo '<h1>Successful</h1>';
	}

	//2nd query to equalise all

	$query="UPDATE calendar 
	SET Sunday=Saturday, Monday=Saturday , Tuesday=Saturday , Wednesday=Saturday , Thursday=Saturday , Friday=Saturday
	WHERE setTime='".$_POST['timeslot']."'";
	// echo $query;
	$setRes=mysqli_query($con, $query);
	if(!$setRes){
		echo '<h1>Failed</h1>';
	}else {
		echo '<h1>Successful</h1>';
	}
}
$query="SELECT setTime FROM calendar WHERE setTime IS NOT NULL";
$res=mysqli_query($con, $query);
if(!$res){
	die("Failed");
}
$timeslots=mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Routine</title>
	<link rel="stylesheet" href="./style.css">
</head>
<body>
	<div>
		<form action="add.php" method="POST">
			<p>Add stuff:</p>
			<select name="timeslot">
				<?php foreach ($timeslots as $timeslot): ?>
					<option value=<?php echo $timeslot['setTime']?>><?php echo date("h:i A", (int)$timeslot['setTime']) ?></option>
				<?php endforeach; ?>
			</select>
			<input type="text" name="adddata">
			<input type="submit" name="submit" value="submit">
		</form>
	</div>
</body>
</html>