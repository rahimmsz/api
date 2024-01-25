<?php

$server = 'localhost';
$username = 'root';
$password = '';
$nama_db = 'db_praktikum';

$conn = mysqli_connect($server, $username, $password, $nama_db);

if (!$conn) {
	die("Koneksi Gagal" . mysqli_connect_error());
}
