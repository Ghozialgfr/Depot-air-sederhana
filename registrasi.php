<?php
require 'functions.php';

if (isset($_POST["tbl_register"])) {
    if(registrasi($_POST) > 0) {
        echo "<script>
                alert('user baru berhasil ditambahkan');
                window.location.href = 'login.php';
            </script>";
    }else {
        echo "Gagal daftar";
        echo mysqli_error($conn);
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman regis</title>

    <style>

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }


        h1, h2, h4 {
            margin : 10px 40px;
            color: #269199;
            font-family: Arial, sans-serif;
        }

        form {

            max-width: 200px;
            margin: 50px 50px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;

        }

        ul {

            list-style-type: none;
            padding: 0;
            margin: 0;

        }

        li {

            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }



        label {

            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }


        input {

            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;

        }


        input:focus {
            outline: none;
            border-color: #007bff;

        }


        button {

            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;

        }

        button:hover {
            background-color: #0056b3; 

        }
    </style>
</head>
<body>
    <h1> Selamat Datang </h1>
    <h2> di Depot Air G and G </h2>
    <h4> Silahkan Registrasi : </h4>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </li>
            
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password2">Konfirmasi Password</label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <button type="submit" name="tbl_register">Register</button>
            </li>
        </ul>
    </form>
</body>
</html>