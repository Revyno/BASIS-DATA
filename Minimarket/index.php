<?php
include 'config.php';

// Inisialisasi atribut
$id_produk = $nama_produk = $harga = '';
$id_pelanggan = $nama_pelanggan =  '';
$id_penjualan = $id_produk_fk = $id_pelanggan_fk = $jumlah = '';
$id_pembayaran = $id_penjualan_fk = $metode = $total = $waktu =$jam = '';

$edit_state = false;

// Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    if (isset($_POST['nama_produk'])) {
        $nama_produk = $_POST["nama_produk"];
        $harga = $_POST["harga"];
        $sql = "INSERT INTO produk (nama, harga) VALUES ('$nama_produk', '$harga')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['nama_pelanggan'])) {
        $nama_pelanggan = $_POST["nama_pelanggan"];
        $sql = "INSERT INTO pelanggan (nama) VALUES ('$nama_pelanggan')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['id_produk_fk'])) {
        $id_produk_fk = $_POST["id_produk_fk"];
        $id_pelanggan_fk = $_POST["id_pelanggan_fk"];
        $jumlah = $_POST["jumlah"];
        $sql = "INSERT INTO penjualan (id_produk, id_pelanggan, jumlah) VALUES ('$id_produk_fk', '$id_pelanggan_fk', '$jumlah')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['id_penjualan_fk'])) {
        $id_penjualan_fk = $_POST["id_penjualan_fk"];
        $metode = $_POST["metode"];
        $total = $_POST["total"];
        $waktu = $_POST["waktu"];
        #$jam = $_POST["jam"];
        $sql = "INSERT INTO pembayaran (id_penjualan, metode, total, waktu) VALUES ('$id_penjualan_fk', '$metode', '$total', '$waktu'#'$jam')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    if (isset($_POST['id_produk'])) {
        $id_produk = $_POST["id_produk"];
        $nama_produk = $_POST["nama_produk"];
        $harga = $_POST["harga"];
        $sql = "UPDATE produk SET nama='$nama_produk', harga='$harga' WHERE id_produk='$id_produk'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['id_pelanggan'])) {
        $id_pelanggan = $_POST["id_pelanggan"];
        $nama_pelanggan = $_POST["nama_pelanggan"];
        $sql = "UPDATE pelanggan SET nama='$nama_pelanggan' WHERE id_pelanggan='$id_pelanggan'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['id_penjualan'])) {
        $id_penjualan = $_POST["id_penjualan"];
        $id_produk_fk = $_POST["id_produk_fk"];
        $id_pelanggan_fk = $_POST["id_pelanggan_fk"];
        $jumlah = $_POST["jumlah"];
        $sql = "UPDATE penjualan SET id_produk='$id_produk_fk', id_pelanggan='$id_pelanggan_fk', jumlah='$jumlah' WHERE id_penjualan='$id_penjualan'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['id_pembayaran'])) {
        $id_pembayaran = $_POST["id_pembayaran"];
        $id_penjualan_fk = $_POST["id_penjualan_fk"];
        $metode = $_POST["metode"];
        $total = $_POST["total"];
        $waktu = $_POST["waktu"];
        $jam = $_POST["jam"];
        $sql = "UPDATE pembayaran SET id_penjualan='$id_penjualan_fk', metode='$metode', total='$total', waktu='$waktu',jam='$jam' WHERE id_pembayaran='$id_pembayaran'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

//  Delete
if (isset($_GET['delete'])) {
    if (isset($_GET['delete_produk'])) {
        $id_produk = $_GET['delete'];
        $sql = "DELETE FROM produk WHERE id_produk='$id_produk'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_GET['delete_pelanggan'])) {
        $id_pelanggan = $_GET['delete'];
        $sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_GET['delete_penjualan'])) {
        $id_penjualan = $_GET['delete'];
        $sql_pembayaran = "DELETE FROM pembayaran WHERE id_penjualan='$id_penjualan'";
        if ($conn->query($sql_pembayaran) === TRUE) {
            // Setelah menghapus entri terkait di tabel pembayaran, hapus entri di tabel penjualan
            $sql_penjualan = "DELETE FROM penjualan WHERE id_penjualan='$id_penjualan'";
            if ($conn->query($sql_penjualan) === TRUE) {
                header("Location: index.php");
            } else {
                echo "Error: " . $sql_penjualan . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_pembayaran . "<br>" . $conn->error;
        }
    } elseif (isset($_GET['delete_pembayaran'])) {
        $id_pembayaran = $_GET['delete'];
        $sql = "DELETE FROM pembayaran WHERE id_pembayaran='$id_pembayaran'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


// Menampilkan data
$sql_produk = "SELECT * FROM produk";
$result_produk = $conn->query($sql_produk);

$sql_pelanggan = "SELECT * FROM pelanggan";
$result_pelanggan = $conn->query($sql_pelanggan);

$sql_penjualan = "SELECT penjualan.*, produk.nama AS nama_produk, pelanggan.nama AS nama_pelanggan FROM penjualan 
                  JOIN produk ON penjualan.id_produk = produk.id_produk 
                  JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan";
$result_penjualan = $conn->query($sql_penjualan);

$sql_pembayaran = "SELECT pembayaran.*, penjualan.id_produk, penjualan.id_pelanggan, produk.nama AS nama_produk, pelanggan.nama AS nama_pelanggan 
                   FROM pembayaran 
                   JOIN penjualan ON pembayaran.id_penjualan = penjualan.id_penjualan 
                   JOIN produk ON penjualan.id_produk = produk.id_produk 
                   JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan";
$result_pembayaran = $conn->query($sql_pembayaran);

if (isset($_GET['edit'])) {
    if (isset($_GET['edit_produk'])) {
        $id_produk = $_GET['edit'];
        $edit_state = true;
        $sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
        $record = $conn->query($sql)->fetch_assoc();
        $nama_produk = $record['nama'];
        $harga = $record['harga'];
    } elseif (isset($_GET['edit_pelanggan'])) {
        $id_pelanggan = $_GET['edit'];
        $edit_state = true;
        $sql = "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
        $record = $conn->query($sql)->fetch_assoc();
        $nama_pelanggan = $record['nama'];
        
    } elseif (isset($_GET['edit_penjualan'])) {
        $id_penjualan = $_GET['edit'];
        $edit_state = true;
        $sql = "SELECT * FROM penjualan WHERE id_penjualan='$id_penjualan'";
        $record = $conn->query($sql)->fetch_assoc();
        $id_produk_fk = $record['id_produk'];
        $id_pelanggan_fk = $record['id_pelanggan'];
        $jumlah = $record['jumlah'];
    } elseif (isset($_GET['edit_pembayaran'])) {
        $id_pembayaran = $_GET['edit'];
        $edit_state = true;
        $sql = "SELECT * FROM pembayaran WHERE id_pembayaran='$id_pembayaran'";
        $record = $conn->query($sql)->fetch_assoc();
        $id_penjualan_fk = $record['id_penjualan'];
        $metode = $record['metode_pembayaran'];
        $total = $record['jumlah_bayar'];
        $waktu = $record['tanggal_pembayaran'];
        $jam   = $record['Waktu_pembayaran'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimarket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Data Minimarket</h1>

        <!-- Produk Form -->
        <form method="post" action="index.php" class="mb-4">
            <input type="hidden" name="id_produk" value="<?php echo isset($id_produk) ? $id_produk : ''; ?>">
            <div class="mb-3">
                <h4 class="text-left">Edit Produk</h4>
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" id="nama_produk"
                    value="<?php echo isset($nama_produk) ? $nama_produk : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga"
                    value="<?php echo isset($harga) ? $harga : ''; ?>" required>
            </div>
            <?php if ($edit_state == false): ?>
            <button type="submit" name="create" class="btn btn-primary">Tambah Produk</button>
            <?php else: ?>
            <button type="submit" name="update" class="btn btn-warning">Edit Produk</button>
            <?php endif ?>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <!-- Pelanggan Form -->
        <form method="post" action="index.php" class="mb-4">
            <input type="hidden" name="id_pelanggan" value="<?php echo isset($id_pelanggan) ? $id_pelanggan : ''; ?>">
            <div class="mb-3">
                <h5 class="text-left">Edit Pelanggan</h5>
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan"
                    value="<?php echo isset($nama_pelanggan) ? $nama_pelanggan : ''; ?>" required>
            </div>
            <?php if ($edit_state == false): ?>
            <button type="submit" name="create" class="btn btn-primary">Tambah Pelanggan</button>
            <?php else: ?>
            <button type="submit" name="update" class="btn btn-warning">Edit Pelanggan</button>
            <?php endif ?>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <!-- Penjualan Form -->
        <form method="post" action="index.php" class="mb-4">
            <input type="hidden" name="id_penjualan" value="<?php echo isset($id_penjualan) ? $id_penjualan : ''; ?>">
            <div class="mb-3">
                <h6 class="text-left">Edit Penjualan</h5>

                    <label for="id_produk_fk" class="form-label">ID Produk</label>
                    <input type="number" name="id_produk_fk" class="form-control" id="id_produk_fk"
                        value="<?php echo isset($id_produk_fk) ? $id_produk_fk : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_pelanggan_fk" class="form-label">ID Pelanggan</label>
                <input type="number" name="id_pelanggan_fk" class="form-control" id="id_pelanggan_fk"
                    value="<?php echo isset($id_pelanggan_fk) ? $id_pelanggan_fk : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" id="jumlah"
                    value="<?php echo isset($jumlah) ? $jumlah : ''; ?>" required>
            </div>
            <?php if ($edit_state == false): ?>
            <button type="submit" name="create" class="btn btn-primary">Tambah Penjualan</button>
            <?php else: ?>
            <button type="submit" name="update" class="btn btn-warning">Edit Penjualan</button>
            <?php endif ?>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <!-- Pembayaran Form -->
        <form method="post" action="index.php" class="mb-4">
            <input type="hidden" name="id_pembayaran"
                value="<?php echo isset($id_pembayaran) ? $id_pembayaran : ''; ?>">
            <h7 class="text-left">Edit Pembayaran</h7>
            <div class="mb-3">
                <label for="id_penjualan_fk" class="form-label">ID Penjualan</label>
                <input type="number" name="id_penjualan_fk" class="form-control" id="id_penjualan_fk"
                    value="<?php echo isset($id_penjualan_fk) ? $id_penjualan_fk : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="metode" class="form-label">Metode Pembayaran</label>
                <input type="text" name="metode" class="form-control" id="metode"
                    value="<?php echo isset($metode) ? $metode : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" name="total" class="form-control" id="total"
                    value="<?php echo isset($total) ? $total : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">Tanggal pembayaran</label>
                <input type="date" name="waktu" class="form-control" id="waktu"
                    value="<?php echo isset($waktu) ? $waktu : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">waktu pembayaran</label>
                <input type="time" name="waktu" class="form-control" id="jam"
                    value="<?php echo isset($waktu) ? $jam : ''; ?>" required>
            </div>
            <?php if ($edit_state == false): ?>
            <button type="submit" name="create" class="btn btn-primary">Tambah Pembayaran</button>
            <?php else: ?>
            <button type="submit" name="update" class="btn btn-warning">Edit Pembayaran</button>
            <?php endif ?>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <!-- Tabel Produk -->
        <h2 class="text-center">Data Produk</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_produk->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_produk']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['harga']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id_produk']; ?>&edit_produk=1"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id_produk']; ?>&delete_produk=1"
                            class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tabel Pelanggan -->
        <h2 class="text-center">Data Pelanggan</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_pelanggan->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_pelanggan']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id_pelanggan']; ?>&edit_pelanggan=1"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id_pelanggan']; ?>&delete_pelanggan=1"
                            class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tabel Penjualan -->
        <h2 class="text-center">Data Penjualan</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Penjualan</th>
                    <th>Nama Produk</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_penjualan->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_penjualan']; ?></td>
                    <td><?php echo $row['nama_produk']; ?></td>
                    <td><?php echo $row['nama_pelanggan']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id_penjualan']; ?>&edit_penjualan=1"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id_penjualan']; ?>&delete_penjualan=1"
                            class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tabel Pembayaran -->
        <h2 class="text-center">Data Pembayaran</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Pembayaran</th>
                    <th>ID Penjualan</th>
                    <th>Nama Produk</th>
                    <th>Nama Pelanggan</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_pembayaran->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_pembayaran']; ?></td>
                    <td><?php echo $row['id_penjualan']; ?></td>
                    <td><?php echo $row['nama_produk']; ?></td>
                    <td><?php echo $row['nama_pelanggan']; ?></td>
                    <td><?php echo $row['metode_pembayaran']; ?></td>
                    <td><?php echo $row['jumlah_bayar']; ?></td>
                    <td><?php echo $row['tanggal_pembayaran']; ?></td>
                    <td><?php echo $row['Waktu_pembayaran']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id_pembayaran']; ?>&edit_pembayaran=1"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id_pembayaran']; ?>&delete_pembayaran=1"
                            class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>