<?php
include('./db.php');
$query="CREATE TABLE IF NOT EXISTS calendar (
    setTime LONGTEXT, 
    Saturday VARCHAR(255), 
    Sunday VARCHAR(255), 
    Monday VARCHAR(255), 
    Tuesday VARCHAR(255), 
    Wednesday VARCHAR(255), 
    Thursday VARCHAR(255), 
    Friday VARCHAR(255)
)";
$res=mysqli_query($con, $query);
if(!$res){
	die("Unable to create table.");
}
else {
	echo "<h1>The setup was succesful</h1>";
}
?>