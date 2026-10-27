<?php

require 'functions.php';

$id    = $_GET["id"];
$tabel = $_GET["tabel"];

if ($tabel == "pelanggan") {
    hapus_pelanggan($id);
} else {
    hapus_pesanan($id);
}

header("Location: ../depot_air/index.php");
exit;

?>