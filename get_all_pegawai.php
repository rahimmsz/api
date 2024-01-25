<?php
include "config.php";
header('Access-Control-Allow-Origin: *');
header("Allow-Control-Allow-Credentials: true");
header("Access-Control-Allow-Header: Origin, Content-Type, Authorization, Accept, X-Requested-with, x-xsrf-token");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Content-Type: application/json; charset = utf-8");

$data = [];
$query = mysqli_query($conn, "SELECT * FROM pegawai");

while ($row = mysqli_fetch_object($query)) {
	$data[] = $row;
}

echo json_encode($data);
echo mysqli_error($conn);
