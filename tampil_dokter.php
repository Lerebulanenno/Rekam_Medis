<?php
include 'config.php';

//Menambahkan query untuk mengambil detail dokter
$sql = "SELECT id, nama, spesialisasi, telepon FROM doctors";
$result = $conn->query($sql);
?>

<!-- menampilkan data dokter -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
    <!-- styling css pada tampilan data dokter -->
    <style>
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
            margin-bottom: 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border-radius: 3px;
            display: inline-block;
            
        }
        .btn-edit {
            background-color: #FFC107;
        }
        .btn-delete {
            background-color: #DC3545;
        }
    </style>
</head>
<body>
    <h2>Data Dokter</h2>
    <a href="tambah_dokter.php" class="btn"><i class="fas fa-plus"></i>Tambah Data Dokter</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Spesialisasi</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_dokter"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td>" . $row["spesialisasi"] . "</td>"; 
                    echo "<td>" . $row["telepon"] . "</td>";
                    echo "<td>";
                    echo "<a href='update_dokter.php?id=" . $row["id_dokter"] . "' class='btn btn-edit'>Edit</a> ";
                    echo "<a href='hapus_dokter.php?id=" . $row["id_dokter"] . "' class='btn btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pasien ini?\")'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php $conn->close(); ?>
</body>
</html>
