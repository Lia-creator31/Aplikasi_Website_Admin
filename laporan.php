<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN PENJUALAN</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="laporan.php">PENJUALAN</a></li>
        </ul>
    </nav>
    <h1 class="centered-title">Laporan Penjualan</h1>
    <table border="1">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Jumlah Penjualan</th>
            <th>Satuan</th>
            <th>Total Penjualan</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "toko_serba_guna");
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "SELECT dp.no_penjualan, dp.nama_barang, dp.harga_barang, dp.jumlah_barang, dp.satuan, dp.sub_total
                FROM detail_penjualan dp
                JOIN penjualan p ON dp.no_penjualan = p.no_penjualan";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['no_penjualan']}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>{$row['harga_barang']}</td>
                        <td>{$row['jumlah_barang']}</td>
                        <td>{$row['satuan']}</td>
                        <td>{$row['sub_total']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data penjualan ditemukan</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>