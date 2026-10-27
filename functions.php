<?php

$conn = mysqli_connect("localhost", "root", "", "depot_air");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_pelanggan($data) {
    global $conn;

    $nama   = $data["nama_pelanggan"];
    $alamat = $data["alamat"];
    $telp   = $data["no_telepon"];

    $query = "INSERT INTO pelanggan (nama_pelanggan, alamat, no_telepon)
              VALUES ('$nama', '$alamat', '$telp')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_pelanggan($data) {
    global $conn;

    $id     = $data["id_pelanggan"];
    $nama   = $data["nama_pelanggan"];
    $alamat = $data["alamat"];
    $telp   = $data["no_telepon"];

    $query = "UPDATE pelanggan SET
                nama_pelanggan = '$nama',
                alamat = '$alamat',
                no_telepon = '$telp'
              WHERE id_pelanggan = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_pelanggan($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pesanan WHERE id_pelanggan = $id");
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan = $id");
    return mysqli_affected_rows($conn);
}


function tambah_pesanan($data) {
    global $conn;

    $id_pelanggan = $data["id_pelanggan"];
    $jumlah       = $data["jumlah_galon"];
    $tanggal      = $data["tanggal_pesan"];
    $status       = $data["status"];

    $query = "INSERT INTO pesanan (id_pelanggan, jumlah_galon, tanggal_pesan, status)
              VALUES ('$id_pelanggan', '$jumlah', '$tanggal', '$status')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_pesanan($data) {
    global $conn;

    $id           = $data["id_pesanan"];
    $id_pelanggan = $data["id_pelanggan"];
    $jumlah       = $data["jumlah_galon"];
    $tanggal      = $data["tanggal_pesan"];
    $status       = $data["status"];

    $query = "UPDATE pesanan SET
                id_pelanggan = '$id_pelanggan',
                jumlah_galon = '$jumlah',
                tanggal_pesan = '$tanggal',
                status = '$status'
              WHERE id_pesanan = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_pesanan($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = $id");
    return mysqli_affected_rows($conn);
}


function registrasi($data) {

    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string ($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM registrasi WHERE username= '$username'");

    if (mysqli_fetch_assoc($result)) {

        echo "<script>
        alert('username sudah terdaftar!');
        </script>";
        return false;

    }

    if ($password !== $password2) {
        echo "<script>
            alert('konfitmasi password tidak sesuai');
            </script>";
            return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO registrasi (username, password) VALUES ('$username', '$password')");

    if(mysqli_affected_rows($conn) <= 0) {
        echo "<script>
        alert ('Registrasi gagal!');
        </script>";
        return false;
    }

    return mysqli_affected_rows($conn);


}
?>