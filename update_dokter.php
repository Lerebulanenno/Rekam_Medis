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


    // Update data dokter
    $sql = "UPDATE doctors SET nama='$nama', spesialisasi='$spesialisasi', telepon='$telepon' WHERE id_dokter='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Data dokter berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //menutup koneksi ke database
    $conn->close();
    header("Location: tampil_data_dokter.php");
    exit();
}
?>

<!-- menampilkan form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Dokter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
        }
        form {
            padding: 30px;
            background: #fff;
            margin-top: 30px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            display: inline-block;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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