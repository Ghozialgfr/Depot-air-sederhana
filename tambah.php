<?php

require 'functions.php';

$pelanggan = query("SELECT * FROM pelanggan");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["tabel"] == "pelanggan") {
        tambah_pelanggan($_POST);
    } else {
        tambah_pesanan($_POST);
    }
    header("Location: index.php");
    exit;
}

$tabel = isset($_GET["tabel"]) ? $_GET["tabel"] : "";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data</title>
</head>
<body>

    <?php if ($tabel == "pelanggan"): ?>

    <h1>tambah data pelanggan</h1>
    <a href="index.php">kembali</a>
    <br><br>

    <form method="POST">
        <input type="hidden" name="tabel" value="pelanggan">
        <table>
            <tr>
                <td>nama pelanggan</td>
                <td><input type="text" name="nama_pelanggan"></td>
            </tr>
            <tr>
                <td>alamat</td>
                <td><textarea name="alamat"></textarea></td>
            </tr>
            <tr>
                <td>no. telepon</td>
                <td><input type="text" name="no_telepon"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan"></td>
            </tr>
        </table>
    </form>

    <?php elseif ($tabel == "pesanan"): ?>

    <h1>tambah data pesanan</h1>
    <a href="index.php">kembali</a>
    <br><br>

    <form method="POST">
        <input type="hidden" name="tabel" value="pesanan">
        <table>
            <tr>
                <td>pelanggan</td>
                <td>
                    <select name="id_pelanggan">
                        <?php foreach ($pelanggan as $row): ?>
                        <option value="<?= $row["id_pelanggan"]; ?>"><?= $row["nama_pelanggan"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>jumlah galon</td>
                <td><input type="number" name="jumlah_galon" min="1"></td>
            </tr>
            <tr>
                <td>tanggal pesan</td>
                <td><input type="date" name="tanggal_pesan" value="<?= date('Y-m-d'); ?>"></td>
            </tr>
            <tr>
                <td>status</td>
                <td>
                    <select name="status">
                        <option value="pending">pending</option>
                        <option value="dikirim">dikirim</option>
                        <option value="selesai">selesai</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan"></td>
            </tr>
        </table>
    </form>

    <?php else: ?>
        <p>tabel tidak ditemukan</p>
    <?php endif; ?>

</body>
</html>