<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
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
    <h1 class="centered-title">Daftar Barang</h1>
    <form method="GET" action="home.php" class="search-form">
        <input type="text" name="search" placeholder="Nama Barang">
        <input type="submit" value="Cari">
    </form>
    <table border="1">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Satuan</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "toko_serba_guna");
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM barang";
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql .= " WHERE nama_barang LIKE '%$search%'";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['kode_barang']}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>{$row['harga_beli']}</td>
                        <td>{$row['harga_jual']}</td>
                        <td>{$row['stok']}</td>
                        <td>{$row['satuan']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data ditemukan</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>