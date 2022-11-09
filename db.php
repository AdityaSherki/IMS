<?php 
$servername = "localhost";
$username ="root";
$password ="";
$db_name ="ims_db";

$con = mysqli_connect($servername,$username,$password,$db_name) or die("database connection failed".mysqli_error($con));
?>