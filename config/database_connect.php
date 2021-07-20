<?php

//connect to database
$conn=mysqli_connect('localhost','nimis','mountabu','banking_system');

if(!$conn)
{
	echo'Connection error:'.mysqli_connect_error();
}

?>
