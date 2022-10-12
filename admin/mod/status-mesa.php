<?php

include '../../config.php';

$id = $_GET['id'];
$status = $_GET['status'];

$select = "UPDATE mesas SET status = '$status' WHERE id = '$id'";
mysqli_query($conn, $select);

header('location: ../mesas');

?>