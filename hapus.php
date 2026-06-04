<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if($id == 0) {
    header("Location: index.php");
    exit;
}

// Cek data ada atau tidak
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id");
if(mysqli_num_rows($query) == 0) {
    header("Location: index.php");
    exit;
}

// Hapus data
$delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

if($delete) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data: ".mysqli_error($conn);
}
?>
