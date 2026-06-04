<?php
session_start();
include 'koneksi.php';

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,
        "SELECT * FROM user
         WHERE username='$username'
         AND password='$password'"
    );

    if(mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];

        header("Location: dashboard.php");
        exit;

    }else{

        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <head>
    <title>Login User</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#111;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
        }

        .container{
            width:400px;
            background:#1a1a1a;
            border:3px solid #ffd700;
            border-radius:15px;
            padding:30px;
            box-shadow:0 0 25px rgba(255,215,0,0.3);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            color:#ffd700;
            text-transform:uppercase;
            letter-spacing:2px;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#ffd700;
            font-weight:bold;
        }

        input{
            width:100%;
            padding:12px;
            margin-bottom:18px;
            border:2px solid #444;
            border-radius:8px;
            background:#222;
            color:white;
        }

        input:focus{
            outline:none;
            border-color:#ffd700;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#ffd700;
            color:black;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            background:#ffea61;
            transform:translateY(-2px);
        }

        .error{
            background:#4d0000;
            color:#ff9d9d;
            padding:10px;
            margin-bottom:15px;
            border-radius:8px;
            border:1px solid red;
            text-align:center;
        }

        .footer{
            text-align:center;
            margin-top:15px;
            color:#aaa;
            font-size:13px;
        }

    </style>

</head>
</head>
<body>
<body>

<div class="container">

    <h2>🎮 RPG Login</h2>

    <?php if($error){ ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">
            ⚔ Login
        </button>

    </form>

    <div class="footer">
        Sistem Login PHP & Session
    </div>

</div>

</body>
</body>
</html>