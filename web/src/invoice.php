<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet" href="style/invoice.css"
    />
    <title>Reservasi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    </style>
</head>
<header style="font-family: 'Poppins', sans-serif;">
    <nav>
        <div class="menu-block">
            <h3 id="text-head">Wisata Sendang Growong</h3>
        <ul class="menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="page2.html">Wisata</a></li>
            <li><a href="#">Produk Unggulan</a></li>
            <li><a href="#">Berita</a></li>
            <li><a href="profil.html">Profil</a></li>
        </ul>
        </div>
    </nav>
</header>
<?php
include 'config/koneksi.php';

if (isset($_GET['id'])) {
    $id_pemesanan = $_GET['id'];

        $stmt = $koneksi->prepare("SELECT p.tanggal_kunjungan, p.jumlah_tiket, p.total_harga, w.Nama FROM pemesanan AS p JOIN wisatawan AS w ON w.Id_wisatawan = p.Id_wisatawan WHERE p.Id_pemesanan = $id_pemesanan");
       
    
        if ($stmt->execute()) {
            $stmt->bind_result($tanggal_kunjungan, $jumlah_tiket, $total_harga, $Nama);
            $stmt->fetch();
            echo '<h1>Invoice</h1>';
            echo '<p>Nama: ' .  htmlspecialchars($Nama) . '</p>';
            echo '<p>Tanggal Kunjungan: ' . htmlspecialchars($tanggal_kunjungan) . '</p>';
            echo '<p>Jumlah Tiket: ' . htmlspecialchars($jumlah_tiket) . '</p>';
            echo '<p>Total Harga: IDR ' . number_format($total_harga, 0, ',', '.') . '</p>';
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo '<p>Permintaan tidak valid.</p>';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pemesanan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .invoice-item {
            margin-bottom: 15px;
        }

        .invoice-item span {
            font-weight: bold;
        }
    </style>
</head>
</html>
