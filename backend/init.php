<?php 
$servername = 'localhost';
$username = 'root';
$pass = '';
$dbname = 'vue_api';

//Creating Connection
$conn = new mysqli($servername , $username , $pass , $dbname);
if ($conn -> connect_error) {
	die( "Connection to Database Failed");
	# code...
}

?>