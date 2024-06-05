<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['login'])) {
    $email = $_POST['form-email'];
    $password = $_POST['form-password'];

    $query = "SELECT * FROM wisatawan WHERE Email='$email'";


    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result)!=0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["Password"])) {
            $_SESSION['id'] = $row["Id_wisatawan"];
            echo "<script>alert('Anda Berhasil Login');window.location.href='../index.php'</script>";
        } else {
            echo "<script>alert('Password salah!');window.location.href='../login.php'</script>";
        }
    } else {
        echo "<script>alert('email salah!');window.location.href='../login.php'</script>";
    }
}
?>