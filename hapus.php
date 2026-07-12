<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='index.php';</script>";
    }
}
?>