<?php
$conn = new mysqli("localhost", "root", "", "toko_serba_guna");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah Barang
if (isset($_POST['add_barang'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    $sql = "INSERT INTO barang (kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan)
            VALUES ('$kode_barang', '$nama_barang', $harga_beli, $harga_jual, $stok, '$satuan')";

    if ($conn->query($sql) === TRUE) {
        echo "Data barang berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update Barang
if (isset($_POST['update_barang'])) {
    $id = $_POST['id'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    $sql = "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', harga_beli=$harga_beli, harga_jual=$harga_jual, stok=$stok, satuan='$satuan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data barang berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Barang
if (isset($_POST['delete_barang'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM barang WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data barang berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tambah Penjualan
if (isset($_POST['add_penjualan'])) {
    $no_penjualan = $_POST['no_penjualan'];
    $nama_kasir = $_POST['nama_kasir'];
    $tgl_penjualan = $_POST['tgl_penjualan'];
    $jam_penjualan = $_POST['jam_penjualan'];
    $total = $_POST['total'];

    $sql = "INSERT INTO penjualan (no_penjualan, nama_kasir, tgl_penjualan, jam_penjualan, total)
            VALUES ('$no_penjualan', '$nama_kasir', '$tgl_penjualan', '$jam_penjualan', $total)";

    if ($conn->query($sql) === TRUE) {
        echo "Data penjualan berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update Penjualan
if (isset($_POST['update_penjualan'])) {
    $id = $_POST['id'];
    $no_penjualan = $_POST['no_penjualan'];
    $nama_kasir = $_POST['nama_kasir'];
    $tgl_penjualan = $_POST['tgl_penjualan'];
    $jam_penjualan = $_POST['jam_penjualan'];
    $total = $_POST['total'];

    $sql = "UPDATE penjualan SET no_penjualan='$no_penjualan', nama_kasir='$nama_kasir', tgl_penjualan='$tgl_penjualan', jam_penjualan='$jam_penjualan', total=$total WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data penjualan berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Penjualan
if (isset($_POST['delete_penjualan'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM penjualan WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data penjualan berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tambah Detail Penjualan
if (isset($_POST['add_detail_penjualan'])) {
    $no_penjualan = $_POST['no_penjualan'];
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan = $_POST['satuan'];
    $sub_total = $_POST['sub_total'];

    $sql = "INSERT INTO detail_penjualan (no_penjualan, nama_barang, harga_barang, jumlah_barang, satuan, sub_total)
            VALUES ('$no_penjualan', '$nama_barang', $harga_barang, $jumlah_barang, '$satuan', $sub_total)";

    if ($conn->query($sql) === TRUE) {
        echo "Detail penjualan berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update Detail Penjualan
if (isset($_POST['update_detail_penjualan'])) {
    $id = $_POST['id'];
    $no_penjualan = $_POST['no_penjualan'];
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan = $_POST['satuan'];
    $sub_total = $_POST['sub_total'];

    $sql = "UPDATE detail_penjualan SET no_penjualan='$no_penjualan', nama_barang='$nama_barang', harga_barang=$harga_barang, jumlah_barang=$jumlah_barang, satuan='$satuan', sub_total=$sub_total WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Detail penjualan berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Detail Penjualan
if (isset($_POST['delete_detail_penjualan'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM detail_penjualan WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Detail penjualan berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
