<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama = $_POST["nama"];
    $spesialisasi = $_POST["spesialisasi"];
    $telepon = $_POST["telepon"];

    // Menambahkan data dokter ke database
    $sql = "INSERT INTO doctors (nama, spesialisasi, telepon) VALUES ('$nama', '$spesialisasi', '$telepon')";

    if ($conn->query($sql) === TRUE) {
        echo "Data dokter berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!-- menampilkan form manambah data dokter -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dokter</title>
    <!-- styling css --> <style>
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
        <h2>Tambah Data Dokter</h2>
        <form action="tambah_dokter.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="spesialisasi">Spesialisasi:</label>
            <input type="text" id="spesialisasi" name="spesialisasi" required>

            <label for="telepon">Telepon:</label>
            <input type="tel" id="telepon" name="telepon" required>

            <input type="submit" value="Tambah Data Dokter">
        </form>
    </div>
</body>
</html>