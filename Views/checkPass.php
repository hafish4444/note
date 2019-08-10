<?php
date_default_timezone_set("Asia/Bangkok");
include('config.php');
$con = mysqli_connect($host, $username, $password, $Database);
mysqli_query($con, "SET NAMES UTF8");
$ID_NOTE = $_POST['ID_NOTE'];
$NOTE_PASSWORD = $_POST['PASSWORD'];

$sql = "SELECT * FROM F_NOTE WHERE ID_NOTE = $ID_NOTE AND NOTE_PASSWORD = '$NOTE_PASSWORD' ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    echo "true";
} else {
    echo "false";
}