<?php
$servername = "localhost";
$username = "root";
$password = "181022";
$databasename = "pertemuan5_07617";

$koneksi = new mysqli($servername, $username, $password, $databasename);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

//  Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $id_barang = $_POST["id_barang"];
    $tanggal = $_POST["tanggal"];
    $total = $_POST["total"];

    $sql = "INSERT INTO transaksi (id_barang, tanggal, total) VALUES ('$id_barang', '$tanggal', '$total')";
    
    if ($koneksi->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id_transaksi = $_POST["id_transaksi"];
    $id_barang = $_POST["id_barang"];
    $tanggal = $_POST["tanggal"];
    $total = $_POST["total"];

    $sql = "UPDATE transaksi SET id_barang='$id_barang', tanggal='$tanggal', total='$total' WHERE id_transaksi='$id_transaksi'";
    
    if ($koneksi->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Delete
if (isset($_GET["delete"])) {
    $id_transaksi = $_GET["delete"];

    $sql = "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

//  Update Form
$update_data = null;
if (isset($_GET["edit"])) {
    $id_transaksi = $_GET["edit"];
    $sql = "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'";
    $result = $koneksi->query($sql);
    $update_data = $result->fetch_assoc();
}

// All Data
$sql = "SELECT * FROM transaksi";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tabel Transaksi_07617</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Tabel Transaksi</h2>

        <?php if ($update_data): ?>
        <h3>Edit Transaksi</h3>
        <form method="POST" action="">
            <input type="hidden" name="id_transaksi" value="<?php echo $update_data['id_transaksi']; ?>">
            <div class="form-group">
                <label>ID Barang</label>
                <input type="text" name="id_barang" class="form-control"
                    value="<?php echo $update_data['id_barang']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo $update_data['tanggal']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label>Total</label>
                <input type="number" name="total" class="form-control" value="<?php echo $update_data['total']; ?>"
                    required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Batal</a>
        </form>
        <?php else: ?>
        <!-- <h3>Tambah Transaksi</h3> -->
        <form method="POST" action="">
            <div class="form-group">
                <label>ID Barang</label>
                <input type="text" name="id_barang" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Total</label>
                <input type="number" name="total" class="form-control" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Simpan</button>
        </form>
        <?php endif; ?>

        <h3 class="mt-4">Daftar Transaksi</h3>
        <table class="table table-bordered">
            <tr>
                <th>ID Transaksi</th>
                <th>ID Barang</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_transaksi"] . "</td>";
                    echo "<td>" . $row["id_barang"] . "</td>";
                    echo "<td>" . $row["tanggal"] . "</td>";
                    echo "<td>" . $row["total"] . "</td>";
                    echo "<td>
                            <a href='?edit=" . $row["id_transaksi"] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='?delete=" . $row["id_transaksi"] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Anda yakin ingin menghapus transaksi ini?')\">Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
            }
            $koneksi->close();
            ?>
        </table>
    </div>
</body>

</html>