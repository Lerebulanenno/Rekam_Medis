<?php
    // Include file konfigurasi untuk koneksi ke database
    include 'config.php';

    // Inisialisasi variabel
    $kunjungan_id = $diagnosa = $perawatan = $resep = $catatan = '';
    $kunjungan_id_err = $diagnosa_err = $perawatan_err = $resep_err = $catatan_err = '';
    
    // Mendapatkan ID pasien dari parameter URL
    $id = $_GET["id"];

    // Jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi nama
        if (empty(trim($_POST["kunjungan_id"]))) {
            $nama_err = "Kunjungan pasien harus diisi";
        } else {
            $nama = trim($_POST["kunjungan"]);
        }

        // Validasi tanggal lahir
        if (empty(trim($_POST["diagnosa"]))) {
            $tanggal_lahir_err = "diagnosa harus diisi";
        } else {
            $tanggal_lahir = trim($_POST["diagnosa"]);
        }

        // Validasi jenis kelamin
        if (empty(trim($_POST["perawatan"]))) {
            $jenis_kelamin_err = "perawatan harus diisi";
        } else {
            $jenis_kelamin = trim($_POST["perawatan"]);
        }

        // Validasi alamat
        if (empty(trim($_POST["resep"]))) {
            $alamat_err = "resep harus diisi";
        } else {
            $alamat = trim($_POST["resep"]);
        }

        // Validasi telepon
        if (empty(trim($_POST["catatan"]))) {
            $telepon_err = "catatan harus diisi";
        } else {
            $telepon = trim($_POST["catatan"]);
        }

        // Jika tidak ada error validasi, update data ke database
        if (empty($kunjungan_id_err) && empty($diagnosa_err) && empty($perawatan_err) && empty($resep_err) && empty($catatan_err)) {
            // Prepare statement
            $sql_update = "UPDATE medical_records SET kunjungan_id=?, diagnosa=?, perawatan=?, resep=?, catatan=? WHERE id=?";
            
            if ($stmt = $conn->prepare($sql_update)) {
                // Bind parameter ke statement
                $stmt->bind_param("iissss", $id, $id_kunjungan, $diagnosa, $perawatan, $resep, $catatan);
                
                // Eksekusi statement
                if ($stmt->execute()) {
                    // Redirect ke halaman tampil_pasien.php setelah berhasil update data
                    header("location: tampil_rekammedis.php");
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
    } else {
        // Query untuk mengambil data pasien berdasarkan ID
        $sql_select = "SELECT id, kunjungan_id, diagnosa, perawatan, resep, catatan FROM medical_records WHERE id=?";
        
        if ($stmt = $conn->prepare($sql_select)) {
            // Bind parameter ke statement
            $stmt->bind_param("i", $id);
            
            // Eksekusi statement
            if ($stmt->execute()) {
                // Simpan hasil query dalam variabel
                $stmt->store_result();
                
                // Jika ditemukan data, ambil nilai kolom dan masukkan ke variabel
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $id_kunjungan, $diagnosa, $perawatan, $resep, $catatan);
                    $stmt->fetch();
                } else {
                    // Redirect ke halaman tampil_pasien.php jika data tidak ditemukan
                    header("location: tampil_rekammedis.php");
                    exit();
                }
            } else {
                echo "Terjadi kesalahan. Silakan coba lagi nanti.";
            }
            
            // Tutup statement
            $stmt->close();
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
    <title>Edit Data Rekam Medis</title>
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
        <h2>Edit Data Kunjungan</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
            <div class="form-group">
                <label for="kunjungan_id">kunjungan_id</label>
                <input type="int" id="kunjungan_id" name="kunjungan_id" value="<?php echo $kunjungan_id; ?>">
                <span class="error-message"><?php echo $kunjungan_id_err; ?></span>
            </div>
            <div class="form-group">
                <label for="diagnosa">Diagnosa</label>
                <input type="text" id="diagnosa" name="diagnosa" value="<?php echo $diagnosa; ?>">
                <span class="error-message"><?php echo $diagnosa_err; ?></span>
            </div>
            <div class="form-group">
                <label for="perawatan">Perawatan</label>
                <input type="text" id="perawatan" name="perawatan" value="<?php echo $perawatan; ?>">
                <span class="error-message"><?php echo $perawatan_err; ?></span>
            </div>
            <div class="form-group">
                <label for="resep">Resep</label>
                <input type="text" id="resep" name="resep" value="<?php echo $resep; ?>">
                <span class="error-message"><?php echo $resep_err; ?></span>
            </div>
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <input type="text" id="catatan" name="catatan" value="<?php echo $catatan; ?>">
                <span class="error-message"><?php echo $catatan_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>