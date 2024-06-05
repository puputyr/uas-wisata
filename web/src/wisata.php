<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Sendang Growong</title>
    <link rel="stylesheet" href="style/wisata.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
</head>

<body>
    <div class="desktop">
        <header class="header">
            <div class="header-title">Wisata Sendang Growong</div>
            <nav class="menu">
                <a href="index.php">Home</a>
                <a href="login.php">Log In</a>
                <a href="register.php" class="signup">Sign Up</a>
            </nav>
        </header>
        <main class="main-content">
            <section class="hero">
                <div class="hero-image-container">
                    <form action="proses_book.php" method="post" enctype="multipart/form-data" name="book-now"
                        id="book-now"></form>
                    <img src="img/gunung-biru.jpg" alt="Hero Image" class="hero-image">
                    <button class="back-button" onclick="window.location.href='index.html'">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
                <div class="hero-text">
                    <div class="welcome">Wisata Alam</div>
                    <div class="sumbersawit">Sendang Growong</div>
                    <p class="description">
                        Wisata Alam Sendang Growong, merupakan tempat wisata pemandian dengan kolam renang yang airnya
                        berasal dari sumber mata air setempat, sehingga sangat jernih dan bersih.
                        Untuk mengakses lokasi wisata alam Sendang Growong, tidaklah sulit. Cukup cari di google maps
                        yang ada di handphone dengan kata kunci Sendang Growong, nanti akan muncul rute jalan penunjuk
                        menuju Sendang Growong.
                    </p>
                    <?php
                    session_start();
                    include 'config/koneksi.php';
                    if (isset($_POST['book-now'])) {
                        $harga_per_tiket = 25000;
                        $tanggal_kunjungan = $_POST['visit-date'] ?? '';
                        $jumlah_tiket = $_POST['ticket-quantity'] ?? 1;
                        $total_harga = $harga_per_tiket * $jumlah_tiket;
                        echo '
                        <div class="form-container">
                            <form action="" method="post">
                                <div class="visit-date">
                                    <p class="label">Tanggal Kunjungan</p>
                                    <div class="date-options">
                                        <input type="hidden" name="visit-date" id="visit-date" value="' . htmlspecialchars($tanggal_kunjungan) . '">
                                        <button type="button" class="date-btn" onclick="selectDate(\'2024-05-27\')">Sen 27 Mei</button>
                                        <button type="button" class="date-btn" onclick="selectDate(\'2024-05-28\')">Sel 28 Mei</button>
                                        <button type="button" class="date-btn" onclick="selectDate(\'2024-05-29\')">Rab 29 Mei</button>
                                        <button type="button" class="date-btn" onclick="selectDate(\'2024-05-30\')">Kam 30 Mei</button>
                                        <button type="button" class="date-btn" onclick="selectDate(\'2024-06-03\')">Sen 03 Jun</button>
                                        <button type="button" class="date-btn" onclick="selectDate(\'2024-06-04\')">Sel 04 Jun</button>
                                        <button type="button" class="date-btn" onclick="selectDate(\'2024-06-05\')">Rab 05 Jun</button>
                                    </div>
                                </div>
                                <div class="ticket-info">
                                    <p class="valid-date">Masa Berlaku: <span id="selected-date">' . htmlspecialchars($tanggal_kunjungan) . '</span></p>
                                    <p class="label">Jumlah Tiket</p>
                                    <div class="ticket-quantity">
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                                        <input type="text" name="ticket-quantity" id="ticket-quantity" value="' . htmlspecialchars($jumlah_tiket) . '">
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(1)">+</button>
                                    </div>
                                    <p class="total-price">Total (' . htmlspecialchars($jumlah_tiket) . ' pax): <span id="total-price">IDR ' . number_format($total_harga, 0, ',', '.') . '</span></p>
                                </div>
                                <button type="submit" name="confirm-booking" class="sign-up-button">Pesan</button>
                            </form>
                        </div>
                        ';
                    }
                    else {
                        echo'
                        <form action="" method="post">
                        <button type="submit" name="book-now" class="book-now">Book Now</button>
                        </form>';
                    }
                    if (isset($_POST['confirm-booking'])) {
                        $tanggal_kunjungan = $_POST['visit-date'];
                        $jumlah_tiket = $_POST['ticket-quantity'];
                        $total_harga = 25000 * $jumlah_tiket;
                        $Id_wisatawan = $_SESSION['id'];
                        $anying = intval($Id_wisatawan);
                        $ges = intval($jumlah_tiket);
                        $stmt = $koneksi->prepare("INSERT INTO pemesanan (tanggal_kunjungan, jumlah_tiket, total_harga, Id_wisatawan) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("siii", $tanggal_kunjungan, $ges, $total_harga, $anying);
                   
                        if ($stmt->execute()) {
                            $last_id = $koneksi->insert_id;
                            header("Location: invoice.php?id=$last_id");
                            exit();
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                    }  
                    ?>

                </div>
                <script>
                    function selectDate(date) {
                        document.getElementById('visit-date').value = date;
                        document.getElementById('selected-date').innerText = date;
                    }

                    function changeQuantity(change) {
                        let quantityInput = document.getElementById('ticket-quantity');
                        let currentQuantity = parseInt(quantityInput.value);
                        let newQuantity = currentQuantity + change;
                        if (newQuantity < 1) {
                            newQuantity = 1;
                        }
                        quantityInput.value = newQuantity;
                        updateTotalPrice(newQuantity);
                    }

                    function updateTotalPrice(quantity) {
                        let harga_per_tiket = 25000;
                        let total_harga = harga_per_tiket * quantity;
                        document.getElementById('total-price').innerText = 'IDR ' + total_harga.toLocaleString('id-ID');
                        document.querySelector('.total-price').innerHTML = 'Total (' + quantity + ' pax): <span id="total-price">IDR ' + total_harga.toLocaleString('id-ID') + '</span>';
                    }
                </script>
            </section>

            <section class="sections">
                <div class="gallery-container"></div>
                <div class="section-gallery">
                    <img src="img/gunung-biru.jpg" alt="Gallery Image 1">
                    <img src="img/gunung-biru.jpg" alt="Gallery Image 2">
                    <img src="img/gunung-biru.jpg" alt="Gallery Image 3">
                </div>
            </section>
        </main>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <h3>Profil</h3>
                <p>Desa Sendang Growong<br>Kabupaten Bandung Barat - Jawa Barat</p>
                <p>Website desa dibangun sebagai bagian dari SISTEM INFORMASI DESA yang bertujuan sebagai portal
                    informasi, transparansi, dan sosialisasi pemerintah terkait tata kelola pembangunan kawasan
                    perdesaan yang dirasakan langsung oleh masyarakat sebagai penerima manfaat.</p>
                <a href="#">Selengkapnya &raquo;</a>
            </div>
            <div class="footer-right">
                <h3>Tautan</h3>
                <ul>
                    <li><a href="#">Potensi Desa</a></li>
                    <li><a href="#">Wisata Alam</a></li>
                    <li><a href="#">Produk Unggulan</a></li>
                    <li><a href="#">Berita Terbaru</a></li>
                    <li><a href="#">Galeri Foto</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Kontak Kami</h3>
                <p>Jl. Raya Sendang Growong No. 126<br>Kode Pos 40553</p>
                <p><i class="fas fa-phone"></i> 022-6623181<br><i class="fas fa-envelope"></i>
                    info@sendanggrowong.desa.id</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2020-2024 Desa Sendang Growong</p>
        </div>
    </footer>
</body>

</html>