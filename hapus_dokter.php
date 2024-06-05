<?php
// Include file konfigurasi untuk koneksi ke database
include 'config.php';

// Mendapatkan ID pasien dari parameter URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Query untuk menghapus data pasien berdasarkan ID
    $sql_delete = "DELETE FROM doctors WHERE id = ?";

    if ($stmt = $conn->prepare($sql_delete)) {
        // Bind parameter ke statement
        $stmt->bind_param("i", $id);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect ke halaman tampil_pasien.php setelah berhasil menghapus data
            header("location: tampil_dokter.php");
            exit();
        } else {
            echo "Terjadi kesalahan. Silakan coba lagi nanti.";
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Terjadi kesalahan. Silakan coba lagi nanti.";
    }
} else {
    // Jika ID tidak ditemukan di URL, redirect ke halaman tampil_pasien.php
    header("location: tampil_dokter.php");
    exit();
}

// Tutup koneksi database
$conn->close();
?>
