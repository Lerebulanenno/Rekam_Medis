<?php
// Mengatur informasi koneksi database
$servername = "localhost"; // Nama server database (localhost jika server database berada di mesin yang sama)
$username = "root";        // Username untuk mengakses database
$password = "";            // Password untuk username yang diberikan
$dbname = "db_rekammedis"; // Nama database yang akan digunakan

// Membuat koneksi ke database menggunakan objek mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi ke database
if ($conn->connect_error) { 
    // Jika terjadi error saat mencoba untuk terhubung, keluarkan pesan error dan hentikan eksekusi script
    die("Connection failed: " . $conn->connect_error);
}

// Jika koneksi berhasil, script akan berlanjut tanpa mengeluarkan pesan error
?>