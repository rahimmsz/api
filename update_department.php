<?php
include "config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Origin, Content-Type, Authorization, Accept, X-Requested-With, x-xsrf-token");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Content-Type: application/json; charset=utf-8");

$input = file_get_contents('php://input');
$data = json_decode($input, true);
$pesan = [];

$id = $_GET['id'];
$nama_department = $data['nama_departemen'];
$lokasi = $data['lokasi'];

$query = mysqli_query($conn, "UPDATE department SET  nama_departemen = '$nama_department', lokasi = '$lokasi' WHERE id = '$id'");

if ($query) {
	http_response_code(201);
	$pesan['status'] = "Sukses";
} else {
	http_response_code(422);
	$pesan['status'] = "Gagal";
}

echo json_encode($pesan);
echo mysqli_error($conn);
