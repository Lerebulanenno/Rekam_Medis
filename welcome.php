<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Sistem Informasi Kesehatan</title>
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
        .container {
            max-width: 800px;
            margin: auto;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow: hidden; /* Menambahkan overflow: hidden untuk clear floats */
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .intro {
            text-align: center;
            margin-bottom: 30px;
        }
        .intro p {
            font-size: 18px;
            line-height: 1.6;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .feature {
            width: calc(33.33% - 20px);
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease; /* Efek transisi ketika hover */
        }
        .feature:hover {
            transform: translateY(-5px); /* Menggeser sedikit ke atas saat hover */
        }
        .feature h3 {
            color: #007BFF;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .feature p {
            font-size: 14px;
            line-height: 1.4;
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
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #333;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Sistem Informasi Kesehatan</h1>
        <div class="intro">
            <p>Di sini Anda dapat mengelola informasi terkait pasien, dokter, kunjungan, dan rekam medis dengan mudah dan efisien.</p>
        </div>

        <div class="features">
            <div class="feature">
                <h3>Data Pasien</h3>
                <p>Melihat dan mengelola informasi pasien, termasuk tambah data pasien baru dan edit data yang ada.</p>
                <a href="tampil_pasien.php" class="btn"><i class="fas fa-user"></i> Kelola Data Pasien</a>
            </div>
            <div class="feature">
                <h3>Data Dokter</h3>
                <p>Informasi tentang dokter, termasuk spesialisasi dan jadwal praktek.</p>
                <a href="tampil_dokter.php" class="btn"><i class="fas fa-user-md"></i> Lihat Data Dokter</a>
            </div>
            <div class="feature">
                <h3>Kunjungan Pasien</h3>
                <p>Mencatat kunjungan pasien, termasuk jadwal kunjungan dan riwayat kunjungan pasien.</p>
                <a href="tampil_kunjungan.php" class="btn"><i class="fas fa-calendar-check"></i> Lihat Kunjungan</a>
            </div>
            <div class="feature">
                <h3>Rekam Medis</h3>
                <p>Menyimpan rekam medis pasien, termasuk diagnosa, pengobatan, dan hasil tes medis lainnya.</p>
                <a href="tampil_rekam_medis.php" class="btn"><i class="fas fa-file-medical"></i> Lihat Rekam Medis</a>
            </div>
        </div>

        <div class="footer">
            <p>© 2024 Sistem Informasi Kesehatan. All rights reserved.<p>
        </div>
    </div>
</body>
</html>
