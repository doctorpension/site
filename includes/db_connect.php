<?php

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
 
?>
