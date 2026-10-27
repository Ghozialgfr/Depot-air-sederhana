<?php


// set session_start();

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$pesanan = query("SELECT pesanan.id_pesanan, pesanan.jumlah_galon, pesanan.tanggal_pesan, pesanan.status, pelanggan.nama_pelanggan, pelanggan.no_telepon FROM pesanan JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>depot air galon</title>
</head>
<body>

    <h1>DEPOT AIR GALON G AND G</h1>

    <h2>Data pelanggan</h2>
    <a href="logout.php">Logout</a>
    <br> <br>
    <a href="tambah.php?tabel=pelanggan">tambah data pelanggan</a>
    <br><br>
    

    <?php $pelanggan = query("SELECT * FROM pelanggan"); ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>no.</th>
            <th>aksi</th>
            <th>nama pelanggan</th>
            <th>alamat</th>
            <th>no. telepon</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($pelanggan as $row): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id_pelanggan"]; ?>&tabel=pelanggan">ubah</a>
                <a href="hapus.php?id=<?= $row["id_pelanggan"]; ?>&tabel=pelanggan" onclick="return confirm('anda ingin menghapus data ini?')">hapus</a>
            </td>
            <td><?= $row["nama_pelanggan"]; ?></td>
            <td><?= $row["alamat"]; ?></td>
            <td><?= $row["no_telepon"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>

    <br>
    <h2>Data pesanan</h2>
    <a href="tambah.php?tabel=pesanan">tambah data pesanan</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>no.</th>
            <th>aksi</th>
            <th>nama pelanggan</th>
            <th>jumlah galon</th>
            <th>tanggal pesan</th>
            <th>status</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($pesanan as $row): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id_pesanan"]; ?>&tabel=pesanan">ubah</a>
                <a href="hapus.php?id=<?= $row["id_pesanan"]; ?>&tabel=pesanan" onclick="return confirm('anda ingin menghapus data ini?')">hapus</a>
            </td>
            <td><?= $row["nama_pelanggan"]; ?></td>
            <td><?= $row["jumlah_galon"]; ?> galon</td>
            <td><?= $row["tanggal_pesan"]; ?></td>
            <td><?= $row["status"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>