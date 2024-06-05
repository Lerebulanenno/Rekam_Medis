<?php
    // Include file konfigurasi untuk koneksi ke database
    include 'config.php';

    // Inisialisasi variabel untuk nilai default
    $pasien_id = $dokter_id = $tanggal_kunjungan = $keluhan = '';
    $pasien_id_err = $dokter_id_err = $tanggal_kunjungan_err = $keluhan_err = '';

    // Jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi nama
        if (empty(trim($_POST["pasien_id"]))) {
            $pasien_id_err = "Id pasien harus diisi";
        } else {
            $pasien_id = trim($_POST["pasien_id"]);
        }

        // Validasi 
        if (empty(trim($_POST["dokter_id"]))) {
            $dokter_id_err = "Id dokter harus diisi";
        } else {
            $dokter_id = trim($_POST["dokter_id"]);
        }

        // Validasi 
        if (empty(trim($_POST["tanggal_kunjungan"]))) {
            $tanggal_kunjungan_err = "Jenis kelamin harus dipilih";
        } else {
            $tanggal_kunjungan = trim($_POST["tanggal_kunjungan"]);
        }

        // Validasi 
        if (empty(trim($_POST["keluhan"]))) {
            $keluhan_err = "Keluhan harus diisi";
        } else {
            $alamat = trim($_POST["keluhan"]);
        }


        // Jika tidak ada error validasi, tambahkan data ke database
        if (empty($pasien_id_err) && empty($dokter_id_err) && empty($tanggal_kunjungan_err) && empty($keluhan_err) ) {
            // Prepare statement
            $sql_insert = "INSERT INTO visits (pasien_id, dokter_id, tanggal_kunjungan, keluhan) VALUES (?, ?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql_insert)) {
                // Bind parameter ke statement
                $stmt->bind_param("sssss", $pasien_id, $dokter_id, $tanggal_kunjungan, $keluhan);
                
                // Eksekusi statement
                if ($stmt->execute()) {
                    // Redirect ke halaman data pasien setelah berhasil tambah data
                    header("location: tampil_kunjungan.php");
                    exit();
                } else {
                    echo "Terjadi kesalahan. Silakan coba lagi nanti.";
                }
                
                // Tutup statement
                $stmt->close();
            }
        }
        
        // Tutup koneksi database
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pasien</title>
    <!-- Sertakan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-bmI1jZx7I25zB0wq0TsNuK3InxWYFnbV1KRNp5C9ZVPHR0d4z8jk83QlVt4e53D7rkx2t3YtwUesJx86u4o5Cg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Gaya CSS Anda */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group .error-message {
            color: #DC3545;
            font-size: 12px;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border-radius: 3px;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Data Pasien</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="pasien_id">ID PASIEN</label>
                <input type="int" id="pasien_id" name="pasien_id" value="<?php echo $pasien_id; ?>">
                <span class="error-message"><?php echo $pasien_id_err; ?></span>
            </div>
            <div class="form-group">
                <label for="dokter_id">ID DOKTER</label>
                <input type="int" id="dokter_id" name="dokter_id" value="<?php echo $dokter_id; ?>">
                <span class="error-message"><?php echo $dokter_id_err; ?></span>
            </div>
            <div class="form-group">
                <label for="tanggal_kunjungan">TANGGAL KUNJUNGAN</label>
                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" value="<?php echo $tanggal_kunjungan; ?>">
                <span class="error-message"><?php echo $tanggal_kunjungan_err; ?></span>
            </div>
            
            <div class="form-group">
                <label for="keluhan">KELUHAN</label>
                <input type="text" id="keluhan" name="keluhan" value="<?php echo $keluhan; ?>">
                <span class="error-message"><?php echo $keluhan_err; ?></span>
            </div>
        
            <div class="form-group">
                <button type="submit" class="btn"><i class="fas fa-plus"></i> Tambah Data Kunjungan</button>
                <button type="submit" class="btn"><i class="fas fa-plus"></i>Kembali</button>
            </div>
        </form>
    </div>
</body>
</html>
