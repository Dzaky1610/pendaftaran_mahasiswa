<!DOCTYPE html>
<html>
<head>
    <title>Searching dan Sorting Data Barang</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1a0033, #32004d, #ff0066);
            min-height:100vh;
            color:white;
            overflow-x:hidden;
        }

        .container{
            width:90%;
            max-width:1100px;
            margin:40px auto;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border:2px solid rgba(255,255,255,0.2);
            border-radius:25px;
            padding:30px;
            box-shadow:0 0 25px rgba(255,0,102,0.5);
        }

        h1{
            text-align:center;
            margin-bottom:25px;
            font-size:40px;
            color:#ffe600;
            text-shadow:3px 3px 0 #ff0000;
        }

        form{
            display:flex;
            gap:15px;
            flex-wrap:wrap;
            justify-content:center;
            margin-bottom:30px;
        }

        input[type="text"],
        select{
            padding:14px 18px;
            border:none;
            border-radius:15px;
            outline:none;
            background:#fff;
            font-size:16px;
            min-width:250px;
            box-shadow:0 4px 10px rgba(0,0,0,0.3);
        }

        button{
            padding:14px 25px;
            border:none;
            border-radius:15px;
            background:linear-gradient(45deg,#ff0000,#ff9900);
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
            box-shadow:0 4px 12px rgba(0,0,0,0.4);
        }

        button:hover{
            transform:scale(1.08);
            background:linear-gradient(45deg,#00c853,#00e676);
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:20px;
        }

        table th{
            background:linear-gradient(45deg,#ff0000,#ff9800);
            padding:16px;
            text-align:center;
            font-size:18px;
            color:white;
        }

        table td{
            background:rgba(255,255,255,0.12);
            padding:14px;
            text-align:center;
            border-bottom:1px solid rgba(255,255,255,0.1);
            color:white;
        }

        table tr:hover td{
            background:rgba(255,255,255,0.2);
            transition:0.3s;
        }

        .mario-box{
            text-align:center;
            margin-bottom:20px;
            font-size:22px;
            color:#fff;
        }

        .coin{
            font-size:28px;
            animation: bounce 1s infinite;
            display:inline-block;
        }

        @keyframes bounce{
            0%{
                transform:translateY(0);
            }
            50%{
                transform:translateY(-10px);
            }
            100%{
                transform:translateY(0);
            }
        }

        @media(max-width:768px){
            form{
                flex-direction:column;
                align-items:center;
            }

            input[type="text"],
            select,
            button{
                width:100%;
            }

            h1{
                font-size:28px;
            }
        }
    </style>
</head>

<body>

<?php

$conn = mysqli_connect("localhost", "root", "", "db_atk");

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_barang ASC';

$query = "SELECT * FROM barang
          WHERE nama_barang LIKE '%$cari%'
          ORDER BY $sort";

$data = mysqli_query($conn, $query);

if (!$data) {
    die("Query Error : " . mysqli_error($conn));
}

?>

<div class="container">

    <h1>🍄 Mario Inventory Checker🍄</h1>

    <div class="mario-box">
        Kumpulkan Item & Donasi Seru 
        <span class="coin">🪙</span>
    </div>

    <form method="GET">

        <input type="text" name="cari" placeholder="Cari barang..."
        value="<?php echo $cari; ?>">

        <select name="sort">
            <option value="id_barang ASC">Urutkan ID ASC</option>
            <option value="id_barang DESC">Urutkan ID DESC</option>

            <option value="harga ASC">Harga Termurah</option>
            <option value="harga DESC">Harga Termahal</option>

            <option value="stok ASC">Stok Sedikit</option>
            <option value="stok DESC">Stok Terbanyak</option>
        </select>

        <button type="submit">Cari Data</button>

    </form>

    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>

        <tr>
            <td><?php echo $row['id_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($row['harga']); ?></td>
            <td><?php echo $row['stok']; ?></td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>