<?php

$sname= "localhost";
$unmae= "root";
$bangou= "";

$db_name = "mydb";

$conn = mysqli_connect($sname, $unmae, $bangou, $db_name);

if (!$conn) {
    echo "Connection failed!";
}