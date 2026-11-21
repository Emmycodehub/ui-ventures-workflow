<?php
$host="localhost"; $user="root"; $pass=""; $dbname="ui_ventures";
$conn = new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error){ die("DB Error: ".$conn->connect_error); }
?>