<?php
include 'koneksi.php';

$error = "";
$success = "";
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if($id == 0) {
    header("Location: index.php");
    exit;
}


$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id");
if(mysqli_num_rows($query) == 0) {
    header("Location: index.php");
    exit;
}

$data = mysqli_fetch_array($query);

if(isset($_POST['update'])){
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);
    $alamat = trim($_POST['alamat']);


    if(empty($nim) || empty($nama) || empty($jurusan) || empty($alamat)) {
        $error = "Semua field harus diisi!";
    } elseif(strlen($nim) < 8 || strlen($nim) > 12) {
        $error = "NIM harus antara 8-12 karakter!";
    } else {

        $check = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '".mysqli_real_escape_string($conn, $nim)."' AND id != $id");
        if(mysqli_num_rows($check) > 0) {
            $error = "NIM sudah terdaftar!";
        } else {
            $nim_safe = mysqli_real_escape_string($conn, $nim);
            $nama_safe = mysqli_real_escape_string($conn, $nama);
            $jurusan_safe = mysqli_real_escape_string($conn, $jurusan);
            $alamat_safe = mysqli_real_escape_string($conn, $alamat);

            $update_query = mysqli_query($conn, "UPDATE mahasiswa SET nim='$nim_safe', nama='$nama_safe', jurusan='$jurusan_safe', alamat='$alamat_safe' WHERE id=$id");
            
            if($update_query) {
                $success = "Data berhasil diubah! Mengalihkan...";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 2000);
                </script>";
            } else {
                $error = "Gagal mengubah data: ".mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
    <style>
          *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            background: linear-gradient(135deg, #1f1c2c, #928dab);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            color: white;
        }

        .container{
            width: 100%;
            max-width: 550px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 22px;
            padding: 35px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }

        .header{
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1{
            font-size: 34px;
            margin-bottom: 10px;
            color: white;
        }

        .header p{
            color: #dcdcdc;
            font-size: 15px;
        }

        .alert{
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .alert-error{
            background: rgba(255, 77, 109, 0.15);
            border: 1px solid rgba(255, 77, 109, 0.5);
            color: #ffb3c1;
        }

        .alert-success{
            background: rgba(0, 200, 150, 0.15);
            border: 1px solid rgba(0, 200, 150, 0.5);
            color: #a7ffdd;
        }

        .form-info{
            background: rgba(255,255,255,0.08);
            border-left: 4px solid #ff6ec4;
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 25px;
            color: #f1f1f1;
            font-size: 14px;
        }

        .form-group{
            margin-bottom: 22px;
        }

        label{
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #ffffff;
        }

        input[type="text"],
        textarea{
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.08);
            color: white;
            font-size: 14px;
            transition: 0.3s;
        }

        input[type="text"]::placeholder,
        textarea::placeholder{
            color: #cccccc;
        }

        input[type="text"]:focus,
        textarea:focus{
            outline: none;
            border-color: #ff6ec4;
            box-shadow: 0 0 10px rgba(255,110,196,0.3);
        }

        textarea{
            resize: vertical;
            min-height: 100px;
        }

        .button-group{
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        button,
        .btn{
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit{
            background: yellow;
            color: black;
        }

        .btn-submit:hover{
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,255,255,0.2);
        }

        .btn-cancel{
            background: rgba(255,255,255,0.12);
            color: white;
        }

        .btn-cancel:hover{
            background: rgba(255,255,255,0.2);
        }

        @media(max-width: 600px){

            .container{
                padding: 25px;
            }

            .header h1{
                font-size: 28px;
            }

            .button-group{
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1> Edit Data Mahasiswa</h1>
        <p>Ubah data mahasiswa</p>
    </div>

    <?php if($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="nim">NIM (Nomor Induk Mahasiswa) *</label>
            <input type="text" id="nim" name="nim" placeholder="Contoh: 20230001" value="<?php echo htmlspecialchars($data['nim']); ?>" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama Mahasiswa *</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
        </div>

        <div class="form-group">
            <label for="jurusan">Jurusan *</label>
            <input type="text" id="jurusan" name="jurusan" placeholder="Contoh: Teknik Informatika" value="<?php echo htmlspecialchars($data['jurusan']); ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat *</label>
            <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
        </div>

        <div class="button-group">
            <button type="submit" name="update" class="btn-submit">💾 Perbarui</button>
            <a href="index.php" class="btn btn-cancel">❌ Batal</a>
        </div>
    </form>
</div>

</body>
</html>
