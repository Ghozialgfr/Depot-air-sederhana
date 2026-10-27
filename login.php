<?php

require 'functions.php';

session_start();

//  cek cookie enkripsi

if(isset($_COOKIE['id']) && isset($_COOKIE['us'])) {
    $id = $_COOKIE['id'];
    $us = $_COOKIE['us'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM registrasi WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if($us === hash('sha256', $row['username'])) {
        $_SESSION["login"] = true;
    }
}


if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM registrasi WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $heshedpassword = $row["PASSWORD"];
        
        if (password_verify($password, $heshedpassword)) {

        // cek session, set session

            $_SESSION["login"] = true;

            // set cookie ketika klik remember me

            if(isset($_POST["remember"])) {

            // buat cookie

            setcookie('id', $row['id'], time() + 60);
            setcookie('us', hash('sha256', $row['username']), time() + 60);
    
            }

            header("Location: index.php");
            exit;


        } else {
            $erorMessage = "username atau password salah";
        }

        } else {
            $erorMessage = "username atau password tidak ditemukan";

        }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>depot G and G</title>

     <style>

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        form {

            max-width: 200px;
            margin: 30px 50px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;

        }

        h1, h2, h4 {
            margin : 10px 40px;
            color: #269199;
            font-family: Arial, sans-serif;
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
    <h4> Silahkan Login : </h4>
    <?php if (isset($erorMessage)) : ?>
        <p style="color: red; font-style: roboto;"><?= $erorMessage; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </li>
           <li style="flex-direction: row; align-items: center;">
                <label for="remember" style="margin-right: 8px; margin-bottom: 0; font-weight: normal;">Remember Me</label>
                <input type="checkbox" name="remember" id="remember">
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>

</body>
</html>

