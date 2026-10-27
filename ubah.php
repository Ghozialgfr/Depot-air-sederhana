<?php

require 'functions.php';

$tabel = isset($_GET["tabel"]) ? $_GET["tabel"] : "";
$pelanggan = query("SELECT * FROM pelanggan");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["tabel"] == "pelanggan") {
        ubah_pelanggan($_POST);
    } else {
        ubah_pesanan($_POST);
    }
    header("Location: index.php");
    exit;
}

if ($tabel == "pelanggan") {
    $id   = $_GET["id"];
    $data = query("SELECT * FROM pelanggan WHERE id_pelanggan = $id");
    $row  = $data[0];
} elseif ($tabel == "pesanan") {
    $id   = $_GET["id"];
    $data = query("SELECT * FROM pesanan WHERE id_pesanan = $id");
    $row  = $data[0];
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah data</title>
</head>
<body>

    <?php if ($tabel == "pelanggan"): ?>

    <h1>ubah data pelanggan</h1>
    <a href="index.php">kembali</a>
    <br><br>

    <form method="POST">
        <input type="hidden" name="tabel" value="pelanggan">
        <input type="hidden" name="id_pelanggan" value="<?= $row["id_pelanggan"]; ?>">
        <table>
            <tr>
                <td>nama pelanggan</td>
                <td><input type="text" name="nama_pelanggan" value="<?= $row["nama_pelanggan"]; ?>"></td>
            </tr>
            <tr>
                <td>alamat</td>
                <td><textarea name="alamat"><?= $row["alamat"]; ?></textarea></td>
            </tr>
            <tr>
                <td>no. telepon</td>
                <td><input type="text" name="no_telepon" value="<?= $row["no_telepon"]; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan"></td>
            </tr>
        </table>
    </form>

    <?php elseif ($tabel == "pesanan"): ?>

    <h1>ubah data pesanan</h1>
    <a href="index.php">kembali</a>
    <br><br>

    <form method="POST">
        <input type="hidden" name="tabel" value="pesanan">
        <input type="hidden" name="id_pesanan" value="<?= $row["id_pesanan"]; ?>">
        <table>
            <tr>
                <td>pelanggan</td>
                <td>
                    <select name="id_pelanggan">
                        <?php foreach ($pelanggan as $p): ?>
                        <option value="<?= $p["id_pelanggan"]; ?>" <?= $p["id_pelanggan"] == $row["id_pelanggan"] ? "selected" : ""; ?>>
                            <?= $p["nama_pelanggan"]; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>jumlah galon</td>
                <td><input type="number" name="jumlah_galon" value="<?= $row["jumlah_galon"]; ?>" min="1"></td>
            </tr>
            <tr>
                <td>tanggal pesan</td>
                <td><input type="date" name="tanggal_pesan" value="<?= $row["tanggal_pesan"]; ?>"></td>
            </tr>
            <tr>
                <td>status</td>
                <td>
                    <select name="status">
                        <option value="pending" <?= $row["status"] == "pending" ? "selected" : ""; ?>>pending</option>
                        <option value="dikirim" <?= $row["status"] == "dikirim" ? "selected" : ""; ?>>dikirim</option>
                        <option value="selesai" <?= $row["status"] == "selesai" ? "selected" : ""; ?>>selesai</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan"></td>
            </tr>
        </table>
    </form>

    <?php endif; ?>

</body>
</html>