<?php
include "config.php";
header('Access-Control-Allow-Origin: *');
header("Allow-Control-Allow-Credentials: true");
header("Access-Control-Allow-Header: Origin, Content-Type, Authorization, Accept, X-Requested-with, x-xsrf-token");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Content-Type: application/json; charset = utf-8");


$input = file_get_contents('php://input');
$data = json_encode($input, true);
$pesan = [];
$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM department WHERE id = '$id'");

if ($query) {
	http_response_code(201);
	$pesan['status'] = "Sukses";
} else {
	http_response_code(422);
	$pesan['status'] = "Gagal";
}

echo json_encode($pesan);
echo mysqli_error($conn);
