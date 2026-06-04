<?php
include 'koneksi.php';

echo "<h2>Migrasi Database - Menambah Kolom NIM</h2>";

// Cek apakah kolom nim sudah ada
$check_column = mysqli_query($conn, "SHOW COLUMNS FROM mahasiswa LIKE 'nim'");

if(mysqli_num_rows($check_column) > 0) {
    echo "<p style='color: green;'>✅ Kolom 'nim' sudah ada di tabel mahasiswa.</p>";
} else {
    // Tambahkan kolom nim
    $alter_query = mysqli_query($conn, "ALTER TABLE mahasiswa ADD COLUMN nim VARCHAR(12) UNIQUE NOT NULL AFTER id");
    
    if($alter_query) {
        echo "<p style='color: green;'>✅ Kolom 'nim' berhasil ditambahkan!</p>";
    } else {
        echo "<p style='color: red;'>❌ Gagal menambahkan kolom: " . mysqli_error($conn) . "</p>";
    }
}

// Tampilkan struktur tabel
echo "<h3>Struktur Tabel Mahasiswa:</h3>";
$structure = mysqli_query($conn, "SHOW COLUMNS FROM mahasiswa");
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";

while($row = mysqli_fetch_array($structure)) {
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>" . $row[2] . "</td>";
    echo "<td>" . $row[3] . "</td>";
    echo "<td>" . $row[4] . "</td>";
    echo "<td>" . $row[5] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<p><a href='index.php'>← Kembali ke halaman utama</a></p>";
?>
