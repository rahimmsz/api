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

$filteredData = [];
foreach ($data as $key => $value) {
	if (!is_null($value)) {
		$filteredData[$key] = mysqli_real_escape_string($conn, $value); // Sanitize input
	}
}

$nama = $filteredData['nama'] ?? null;
$posisi = $filteredData['posisi'] ?? null;
$gaji = $filteredData['gaji'] ?? null;
$tgl_masuk = $filteredData['tanggal_masuk'] ?? null;

$columns = array_keys($filteredData);
$placeholders = array_fill(0, count($columns), '?');
$query = "INSERT INTO pegawai (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ssss', $nama, $posisi, $gaji, $tgl_masuk);

if (mysqli_stmt_execute($stmt)) {
	http_response_code(201);
	$pesan['status'] = "Sukses";
} else {
	http_response_code(422);
	$pesan['status'] = "Gagal";
	$pesan['error'] = mysqli_error($conn); 
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo json_encode($pesan);
