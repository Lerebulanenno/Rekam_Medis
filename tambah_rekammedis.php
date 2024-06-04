<?php
    // Include file konfigurasi untuk koneksi ke database
    include 'config.php';

    // Inisialisasi variabel untuk nilai default
    $nama = $tanggal_lahir = $jenis_kelamin = $alamat = $telepon = '';
    $nama_err = $tanggal_lahir_err = $jenis_kelamin_err = $alamat_err = $telepon_err = '';

    // Jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi nama
        if (empty(trim($_POST["nama"]))) {
            $nama_err = "Nama pasien harus diisi";
        } else {
            $nama = trim($_POST["nama"]);
        }

        // Validasi tanggal lahir
        if (empty(trim($_POST["tanggal_lahir"]))) {
            $tanggal_lahir_err = "Tanggal lahir harus diisi";
        } else {
            $tanggal_lahir = trim($_POST["tanggal_lahir"]);
        }

        // Validasi jenis kelamin
        if (empty(trim($_POST["jenis_kelamin"]))) {
            $jenis_kelamin_err = "Jenis kelamin harus dipilih";
        } else {
            $jenis_kelamin = trim($_POST["jenis_kelamin"]);
        }

        // Validasi alamat
        if (empty(trim($_POST["alamat"]))) {
            $alamat_err = "Alamat harus diisi";
        } else {
            $alamat = trim($_POST["alamat"]);
        }

        // Validasi telepon
        if (empty(trim($_POST["telepon"]))) {
            $telepon_err = "Nomor telepon harus diisi";
        } else {
            $telepon = trim($_POST["telepon"]);
        }

        // Jika tidak ada error validasi, tambahkan data ke database
        if (empty($nama_err) && empty($tanggal_lahir_err) && empty($jenis_kelamin_err) && empty($alamat_err) && empty($telepon_err)) {
            // Prepare statement
            $sql_insert = "INSERT INTO patients (nama, tanggal_lahir, jenis_kelamin, alamat, telepon) VALUES (?, ?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql_insert)) {
                // Bind parameter ke statement
                $stmt->bind_param("sssss", $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $telepon);
                
                // Eksekusi statement
                if ($stmt->execute()) {
                    // Redirect ke halaman data pasien setelah berhasil tambah data
                    header("location: tampil_pasien.php");
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
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                <span class="error-message"><?php echo $nama_err; ?></span>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>">
                <span class="error-message"><?php echo $tanggal_lahir_err; ?></span>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" <?php if ($jenis_kelamin === 'L') echo 'selected'; ?>>Laki-laki</option>
                    <option value="P" <?php if ($jenis_kelamin === 'P') echo 'selected'; ?>>Perempuan</option>
                </select>
                <span class="error-message"><?php echo $jenis_kelamin_err; ?></span>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
                <span class="error-message"><?php echo $alamat_err; ?></span>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" id="telepon" name="telepon" value="<?php echo $telepon; ?>">
                <span class="error-message"><?php echo $telepon_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn"><i class="fas fa-plus"></i> Tambah Data Pasien</button>
            </div>
        </form>
    </div>
</body>
</html>
