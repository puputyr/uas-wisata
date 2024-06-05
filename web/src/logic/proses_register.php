<?php
include '../config/koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['form-nama'];
    $NoTelp = $_POST['NoTelp'];
    $email = $_POST['form-email'];
    $password = $_POST['form-password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO wisatawan (Nama, No_telp, Email, Password) 
    VALUES ('$nama', '$NoTelp', '$email', '$hash')";


    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Anda Berhasil Sign Up');window.location.href='../login.php'</script>";
    }
}
?>