<!-- menampilkan data dokter -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>

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
