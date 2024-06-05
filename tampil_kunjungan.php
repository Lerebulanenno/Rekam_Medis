<?php
    // Include file konfigurasi untuk koneksi ke database
    include 'config.php';

    // Query untuk mengambil semua data pasien dari tabel patients
    $sql_select = "SELECT id, pasien_id, dokter_id, tanggal_kunjungan, keluhan FROM visits";
    $result = $conn->query($sql_select);

    // Menutup koneksi database hanya setelah selesai menggunakan hasil query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kunjungan</title>
    <!-- Sertakan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-bmI1jZx7I25zB0wq0TsNuK3InxWYFnbV1KRNp5C9ZVPHR0d4z8jk83QlVt4e53D7rkx2t3YtwUesJx86u4o5Cg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Gaya CSS Anda */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            border-radius: 3px;
            display: inline-block;
            margin-bottom: 5px;
        }
        .btn-info {
            background-color: #17A2B8;
        }
        .btn-edit {
            background-color: #FFC107;

        }
        .btn-delete {
            background-color: #DC3545;
            margin-left: 5px;
        }
        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h2>Data Kunjungan</h2>
    <!-- Tombol untuk tambah data pasien -->
    <a href="tambah_kunjungan.php" class="btn btn-info"><i class="fas fa-plus"></i> Tambah Data Kunjungan</a>

    <!-- Tabel untuk menampilkan data pasien -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID PASIEN</th>
                <th>ID DOKTER</th>
                <th>TANGGAL KUNJUNGAN</th>
                <th>KELUHAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Memeriksa apakah hasil query mengembalikan lebih dari 0 baris
            if ($result->num_rows > 0) {
                // Loop untuk menampilkan setiap baris data 
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>"; // Menampilkan ID
                    echo "<td>" . $row["pasien_id"] . "</td>"; // Menampilkan 
                    echo "<td>" . $row["dokter_id"] . "</td>"; // Menampilkan 
                    echo "<td>" . $row["tanggal_kunjungan"] . "</td>"; // Menampilkan 
                    echo "<td>" . $row["keluhan"] . "</td>"; // Menampilkan
                    echo "<td>";
                    // Tombol edit dengan ikon edit
                    echo "<a href='update_kunjungan.php?id=" . $row["id"] . "' class='btn btn-edit'><i class='fas fa-edit'></i> Edit</a>";
                    // Tombol hapus dengan ikon delete dan konfirmasi JavaScript
                    echo "<a href='hapus_kunjungan.php?id=" . $row["id"] . "' class='btn btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pasien ini?\")'><i class='fas fa-trash'></i> Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // Jika tidak ada data, tampilkan pesan
                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
        // Menutup koneksi database setelah selesai menggunakan hasil query
        $conn->close();
    ?>
</body>
</html>
