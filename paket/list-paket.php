<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location:.../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wid_paketth=device-wid_paketth, initial-scale=1.0">
    <title>List Paket</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include("../home.php"); ?>
<div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Paket Laundry
                </h4>
            </div>

            <div class="card-body">
                <form action="list-paket.php" method ="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Masukkan Keyword Pencarian" />
                </form>

                <ul class="list-group">
                    <?php
                    include "../connection.php";
                    if (isset($_GET["search"])) {
                        $search = $_GET["search"];
                        $sql = "select * from paket 
                        where jenis like '%$search%' 
                        or harga like '%$search%' 
                        or id_paket like '%$search%'";
                    }else {
                        $sql = "select * from paket";
                    }
                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);
                    while ($paket = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- untuk deskripsi paket -->
                                    <h5><?=$paket["jenis"]?></h5>
                                    <h6>id_paket paket : <?=$paket["id_paket"]?></h6>
                                    <h6>Harga : <?=$paket["harga"]?></h6>
                                </div>
                                <div class="col-lg-4">
                                    <a href="form-paket.php?id_paket=<?=$paket["id_paket"]?>">
                                        <button class="btn btn-info btn-block">
                                         Edit
                                         </button>
                                    </a>

                                    <div class="card-footer">
                                      <a href="process-paket.php?id_paket=<?=$paket["id_paket"]?>"
                                         onclick="return confirm('Are you sure?')">
                                    </div>
                                        <button class="btn btn-danger btn-block">
                                          Hapus
                                        </button>
                                      </a>
                                    
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="card-footer">
                <a href="form-paket.php"> 
                    <button class="btn btn-success">
                        Tambah Data paket
                    </button>
                </a>
            </div>

        </div>
    </div>
</body>
</html>