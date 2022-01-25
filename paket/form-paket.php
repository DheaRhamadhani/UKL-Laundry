<?php
session_start();
# jika saat load halaman ini, pastikan telah login sebagai paket
if (!isset($_SESSION["user"])) {
    header("Location:../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wid_paketth=device-wid_paketth, initial-scale=1.0">
    <title>Form paket</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("../home.php") ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-danger">
                <h4 class="text-white">
                    Form paket
                </h4>
            </div>

            <div class="card-body">
            <?php
                if (isset($_GET["id_paket"])) {
                    $id_paket = $_GET["id_paket"];
                    $sql = "select * from paket where id_paket='$id_paket'";

                    include("../connection.php");

                    #eksekusi
                    $hasil = mysqli_query($connect, $sql);

                    #konversi
                    $paket = mysqli_fetch_array($hasil);
            ?>
                        <form action="process-paket.php" method="post"
                        enctype="multipart/form-data">

                            id_paket paket
                            <input type="text" name="id_paket"
                            class="form-control mb-2" required
                            value="<?=$paket["id_paket"];?>" readonly>

                            Jenis
                            <select name="jenis" class="form-control mb-2" required>
                             <option value="<?=$paket["jenis"];?>" selected><?=$paket["jenis"];?></option>
                             <option value="Kiloan">Kiloan</option>
                             <option value="Selimut">Selimut</option>
                             <option value="Bed_Cover">Bed Cover</option>
                             <option value="Kaos">kaos</option>
                            </select>

                            Harga
                            <input type="text" name="harga"
                            class="form-control mb-2" required
                            value="<?=$paket["harga"];?>">

                            <button type="submit" class="btn btn-info btn-block"
                            name="update">
                                Simpan
                            </button>
                        </form>
            <?php
                }else{
                    #form untuk insert
            ?>
                    <form action="process-paket.php" method="post"
                    enctype="multipart/form-data">

                            id_paket paket
                            <input type="text" name="id_paket"
                            class="form-control mb-2" required>

                            Jenis
                            <select name="jenis" class="form-control mb-2" required>
                             <option value="Kiloan">Kiloan</option>
                             <option value="Selimut">Selimut</option>
                             <option value="Bed_Cover">Bed Cover</option>
                             <option value="Kaos">kaos</option>
                            </select>

                            Harga
                            <input type="text" name="harga"
                            class="form-control mb-2" required>
                            

                        <button type="submit" class="btn btn-info btn-block"
                        name="simpan">
                            Simpan
                        </button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>