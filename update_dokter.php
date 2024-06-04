<?php
include 'config.php';

// Memeriksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    // Mengambil data dokter berdasarkan ID
    $sql = "SELECT * FROM doctors WHERE id_dokter = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Dokter tidak ditemukan";
        exit();
    }
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $spesialisasi = $_POST["spesialisasi"];
    $telepon = $_POST["telepon"];

}
?>

<!-- menampilkan form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Dokter</title>
</head>
<body>
    <div class="container">
        <h2>Update Data Dokter</h2>
        <form action="update_dokter.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id_dokter']; ?>">

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>

            <label for="spesialisasi">Spesialisasi:</label>
            <input type="text" id="spesialisasi" name="spesialisasi" value="<?php echo $row['spesialisasi']; ?>" required>

            <label for="telepon">Telepon:</label>
            <input type="tel" id="telepon" name="telepon" value="<?php echo $row['telepon']; ?>" required>

            <input type="submit" value="Update Data Dokter">
        </form>
    </div>
</body>
</html>