<?php
$servername = "localhost";
$username = "root";
$password = "181022";
$databasename = "pertemuan5_07617";

$koneksi = new mysqli($servername, $username, $password, $databasename);
#echo "database terkoneksi";
$sql = "SELECT * FROM transaksi";
$result = $koneksi->query($sql);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Tabel Transaksi_07617</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: large;
    }

    table {
        width: 55%;
        border-collapse: separate;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: cenbter;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <h2>Tabel transaksi</h2>
    <table>
        <tr>
            <th>ID transaksi</th>
            <th>ID Barang</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_transaksi"] . "</td>";
                    echo "<td>" . $row["id_barang"] . "</td>";
                    echo "<td>" . $row["tanggal"] . "</td>";
                    echo "<td>" . $row["total"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
            }
            $koneksi->close();
            ?>

    </table>
</body>

</html>