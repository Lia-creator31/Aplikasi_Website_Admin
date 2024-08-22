<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_serba_guna";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute query and handle errors
function executeQuery($conn, $query, $successMsg, $errorMsg) {
    if ($conn->query($query) === TRUE) {
        echo "<div class='alert alert-success'>$successMsg</div>";
    } else {
        echo "<div class='alert alert-danger'>$errorMsg: " . $conn->error . "</div>";
    }
}

// Handle add, edit, delete actions for barang
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add_barang') {
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok'];
        $satuan = $_POST['satuan'];

        $query = "INSERT INTO barang (kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan) VALUES ('$kode_barang', '$nama_barang', $harga_beli, $harga_jual, $stok, '$satuan')";
        executeQuery($conn, $query, "Barang berhasil ditambahkan", "Error menambah barang");
    } elseif ($_POST['action'] == 'edit_barang') {
        $id = $_POST['id'];
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok'];
        $satuan = $_POST['satuan'];

        $query = "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', harga_beli=$harga_beli, harga_jual=$harga_jual, stok=$stok, satuan='$satuan' WHERE id=$id";
        executeQuery($conn, $query, "Barang berhasil diupdate", "Error mengedit barang");
    } elseif ($_POST['action'] == 'delete_barang') {
        $id = $_POST['id'];
        $query = "DELETE FROM barang WHERE id=$id";
        executeQuery($conn, $query, "Barang berhasil dihapus", "Error menghapus barang");
    }
}

// Handle add, edit, delete actions for penjualan
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add_penjualan') {
        $no_penjualan = $_POST['no_penjualan'];
        $nama_kasir = $_POST['nama_kasir'];
        $tgl_penjualan = $_POST['tgl_penjualan'];
        $jam_penjualan = $_POST['jam_penjualan'];
        $total = $_POST['total'];

        $query = "INSERT INTO penjualan (no_penjualan, nama_kasir, tgl_penjualan, jam_penjualan, total) VALUES ('$no_penjualan', '$nama_kasir', '$tgl_penjualan', '$jam_penjualan', $total)";
        executeQuery($conn, $query, "Penjualan berhasil ditambahkan", "Error menambah penjualan");
    } elseif ($_POST['action'] == 'edit_penjualan') {
        $id = $_POST['id'];
        $no_penjualan = $_POST['no_penjualan'];
        $nama_kasir = $_POST['nama_kasir'];
        $tgl_penjualan = $_POST['tgl_penjualan'];
        $jam_penjualan = $_POST['jam_penjualan'];
        $total = $_POST['total'];

        $query = "UPDATE penjualan SET no_penjualan='$no_penjualan', nama_kasir='$nama_kasir', tgl_penjualan='$tgl_penjualan', jam_penjualan='$jam_penjualan', total=$total WHERE id=$id";
        executeQuery($conn, $query, "Penjualan berhasil diupdate", "Error mengedit penjualan");
    } elseif ($_POST['action'] == 'delete_penjualan') {
        $id = $_POST['id'];
        $query = "DELETE FROM penjualan WHERE id=$id";
        executeQuery($conn, $query, "Penjualan berhasil dihapus", "Error menghapus penjualan");
    }
}

// Handle add, edit, delete actions for detail_penjualan
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add_detail_penjualan') {
        $no_penjualan = $_POST['no_penjualan'];
        $nama_barang = $_POST['nama_barang'];
        $harga_barang = $_POST['harga_barang'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $satuan = $_POST['satuan'];
        $sub_total = $_POST['sub_total'];

        $query = "INSERT INTO detail_penjualan (no_penjualan, nama_barang, harga_barang, jumlah_barang, satuan, sub_total) VALUES ('$no_penjualan', '$nama_barang', $harga_barang, $jumlah_barang, '$satuan', $sub_total)";
        executeQuery($conn, $query, "Detail penjualan berhasil ditambahkan", "Error menambah detail penjualan");
    } elseif ($_POST['action'] == 'edit_detail_penjualan') {
        $id = $_POST['id'];
        $no_penjualan = $_POST['no_penjualan'];
        $nama_barang = $_POST['nama_barang'];
        $harga_barang = $_POST['harga_barang'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $satuan = $_POST['satuan'];
        $sub_total = $_POST['sub_total'];

        $query = "UPDATE detail_penjualan SET no_penjualan='$no_penjualan', nama_barang='$nama_barang', harga_barang=$harga_barang, jumlah_barang=$jumlah_barang, satuan='$satuan', sub_total=$sub_total WHERE id=$id";
        executeQuery($conn, $query, "Detail penjualan berhasil diupdate", "Error mengedit detail penjualan");
    } elseif ($_POST['action'] == 'delete_detail_penjualan') {
        $id = $_POST['id'];
        $query = "DELETE FROM detail_penjualan WHERE id=$id";
        executeQuery($conn, $query, "Detail penjualan berhasil dihapus", "Error menghapus detail penjualan");
    }
}

// Fetch all data for display
$barang_result = $conn->query("SELECT * FROM barang");
$penjualan_result = $conn->query("SELECT * FROM penjualan");
$detail_penjualan_result = $conn->query("SELECT * FROM detail_penjualan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page - Toko Serba Guna</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="laporan.php">PENJUALAN</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1 class = "agak-lain">Admin Page - Toko Serba Guna</h1>

        <!-- Form for Barang -->
        <h2 class="new-title">Barang</h2>
        <form method="post">
            <input type="hidden" name="action" value="add_barang">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </form>

        <!-- Table for Barang -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $barang_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['kode_barang']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo $row['harga_beli']; ?></td>
                    <td><?php echo $row['harga_jual']; ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td><?php echo $row['satuan']; ?></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="action" value="delete_barang">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <button class="btn btn-warning btn-sm" onclick="editBarang(<?php echo $row['id']; ?>, '<?php echo $row['kode_barang']; ?>', '<?php echo $row['nama_barang']; ?>', <?php echo $row['harga_beli']; ?>, <?php echo $row['harga_jual']; ?>, <?php echo $row['stok']; ?>, '<?php echo $row['satuan']; ?>')">Edit</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Form for Penjualan -->
        <h2 class="new-title">Penjualan</h2>
        <form method="post">
            <input type="hidden" name="action" value="add_penjualan">
            <div class="form-group">
                <label for="no_penjualan">No Penjualan</label>
                <input type="text" class="form-control" id="no_penjualan" name="no_penjualan" required>
            </div>
            <div class="form-group">
                <label for="nama_kasir">Nama Kasir</label>
                <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" required>
            </div>
            <div class="form-group">
                <label for="tgl_penjualan">Tanggal Penjualan</label>
                <input type="date" class="form-control" id="tgl_penjualan" name="tgl_penjualan" required>
            </div>
            <div class="form-group">
                <label for="jam_penjualan">Jam Penjualan</label>
                <input type="time" class="form-control" id="jam_penjualan" name="jam_penjualan" required>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" class="form-control" id="total" name="total" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Penjualan</button>
        </form>

        <!-- Table for Penjualan -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No Penjualan</th>
                    <th>Nama Kasir</th>
                    <th>Tanggal Penjualan</th>
                    <th>Jam Penjualan</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $penjualan_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['no_penjualan']; ?></td>
                    <td><?php echo $row['nama_kasir']; ?></td>
                    <td><?php echo $row['tgl_penjualan']; ?></td>
                    <td><?php echo $row['jam_penjualan']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="action" value="delete_penjualan">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <button class="btn btn-warning btn-sm" onclick="editPenjualan(<?php echo $row['id']; ?>, '<?php echo $row['no_penjualan']; ?>', '<?php echo $row['nama_kasir']; ?>', '<?php echo $row['tgl_penjualan']; ?>', '<?php echo $row['jam_penjualan']; ?>', <?php echo $row['total']; ?>)">Edit</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Form for Detail Penjualan -->
        <h2 class="new-title">Detail Penjualan</h2>
        <form method="post">
            <input type="hidden" name="action" value="add_detail_penjualan">
            <div class="form-group">
                <label for="no_penjualan">No Penjualan</label>
                <input type="text" class="form-control" id="no_penjualan" name="no_penjualan" required>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="harga_barang">Harga Barang</label>
                <input type="number" class="form-control" id="harga_barang" name="harga_barang" required>
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Jumlah Barang</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" required>
            </div>
            <div class="form-group">
                <label for="sub_total">Sub Total</label>
                <input type="number" class="form-control" id="sub_total" name="sub_total" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Detail Penjualan</button>
        </form>

        <!-- Table for Detail Penjualan -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No Penjualan</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Satuan</th>
                    <th>Sub Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $detail_penjualan_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['no_penjualan']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo $row['harga_barang']; ?></td>
                    <td><?php echo $row['jumlah_barang']; ?></td>
                    <td><?php echo $row['satuan']; ?></td>
                    <td><?php echo $row['sub_total']; ?></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="action" value="delete_detail_penjualan">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <button class="btn btn-warning btn-sm" onclick="editDetailPenjualan(<?php echo $row['id']; ?>, '<?php echo $row['no_penjualan']; ?>', '<?php echo $row['nama_barang']; ?>', <?php echo $row['harga_barang']; ?>, <?php echo $row['jumlah_barang']; ?>, '<?php echo $row['satuan']; ?>', <?php echo $row['sub_total']; ?>)">Edit</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Forms -->
    <div class="modal" id="editBarangModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit_barang">
                        <input type="hidden" name="id" id="editBarangId">
                        <div class="form-group">
                            <label for="editKodeBarang">Kode Barang</label>
                            <input type="text" class="form-control" id="editKodeBarang" name="kode_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editNamaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="editNamaBarang" name="nama_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editHargaBeli">Harga Beli</label>
                            <input type="number" class="form-control" id="editHargaBeli" name="harga_beli" required>
                        </div>
                        <div class="form-group">
                            <label for="editHargaJual">Harga Jual</label>
                            <input type="number" class="form-control" id="editHargaJual" name="harga_jual" required>
                        </div>
                        <div class="form-group">
                            <label for="editStok">Stok</label>
                            <input type="number" class="form-control" id="editStok" name="stok" required>
                        </div>
                        <div class="form-group">
                            <label for="editSatuan">Satuan</label>
                            <input type="text" class="form-control" id="editSatuan" name="satuan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="editPenjualanModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit_penjualan">
                        <input type="hidden" name="id" id="editPenjualanId">
                        <div class="form-group">
                            <label for="editNoPenjualan">No Penjualan</label>
                            <input type="text" class="form-control" id="editNoPenjualan" name="no_penjualan" required>
                        </div>
                        <div class="form-group">
                            <label for="editNamaKasir">Nama Kasir</label>
                            <input type="text" class="form-control" id="editNamaKasir" name="nama_kasir" required>
                        </div>
                        <div class="form-group">
                            <label for="editTglPenjualan">Tanggal Penjualan</label>
                            <input type="date" class="form-control" id="editTglPenjualan" name="tgl_penjualan" required>
                        </div>
                        <div class="form-group">
                            <label for="editJamPenjualan">Jam Penjualan</label>
                            <input type="time" class="form-control" id="editJamPenjualan" name="jam_penjualan" required>
                        </div>
                        <div class="form-group">
                            <label for="editTotal">Total</label>
                            <input type="number" class="form-control" id="editTotal" name="total" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="editDetailPenjualanModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Detail Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit_detail_penjualan">
                        <input type="hidden" name="id" id="editDetailPenjualanId">
                        <div class="form-group">
                            <label for="editDetailNoPenjualan">No Penjualan</label>
                            <input type="text" class="form-control" id="editDetailNoPenjualan" name="no_penjualan" required>
                        </div>
                        <div class="form-group">
                            <label for="editDetailNamaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="editDetailNamaBarang" name="nama_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editDetailHargaBarang">Harga Barang</label>
                            <input type="number" class="form-control" id="editDetailHargaBarang" name="harga_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editDetailJumlahBarang">Jumlah Barang</label>
                            <input type="number" class="form-control" id="editDetailJumlahBarang" name="jumlah_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editDetailSatuan">Satuan</label>
                            <input type="text" class="form-control" id="editDetailSatuan" name="satuan" required>
                        </div>
                        <div class="form-group">
                            <label for="editDetailSubTotal">Sub Total</label>
                            <input type="number" class="form-control" id="editDetailSubTotal" name="sub_total" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editBarang(id, kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan) {
            document.getElementById('editBarangId').value = id;
            document.getElementById('editKodeBarang').value = kode_barang;
            document.getElementById('editNamaBarang').value = nama_barang;
            document.getElementById('editHargaBeli').value = harga_beli;
            document.getElementById('editHargaJual').value = harga_jual;
            document.getElementById('editStok').value = stok;
            document.getElementById('editSatuan').value = satuan;
            $('#editBarangModal').modal('show');
        }

        function editPenjualan(id, no_penjualan, nama_kasir, tgl_penjualan, jam_penjualan, total) {
            document.getElementById('editPenjualanId').value = id;
            document.getElementById('editNoPenjualan').value = no_penjualan;
            document.getElementById('editNamaKasir').value = nama_kasir;
            document.getElementById('editTglPenjualan').value = tgl_penjualan;
            document.getElementById('editJamPenjualan').value = jam_penjualan;
            document.getElementById('editTotal').value = total;
            $('#editPenjualanModal').modal('show');
        }

        function editDetailPenjualan(id, no_penjualan, nama_barang, harga_barang, jumlah_barang, satuan, sub_total) {
            document.getElementById('editDetailPenjualanId').value = id;
            document.getElementById('editDetailNoPenjualan').value = no_penjualan;
            document.getElementById('editDetailNamaBarang').value = nama_barang;
            document.getElementById('editDetailHargaBarang').value = harga_barang;
            document.getElementById('editDetailJumlahBarang').value = jumlah_barang;
            document.getElementById('editDetailSatuan').value = satuan;
            document.getElementById('editDetailSubTotal').value = sub_total;
            $('#editDetailPenjualanModal').modal('show');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>