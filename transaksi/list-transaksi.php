<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg user
if (!isset($_SESSION["user"])) {
    header("location:../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Transaksi</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="font.css">
</head>
<body>
    <?php include("../home.php")?>
<div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Transaksi
                </h4>
            </div>

            <div class="card-body">
                <ul class="list-group">
                    <?php
                    include "../connection.php";
                    $sql = "select 
                    transaksi.*,member.*,user.*
                    from 
                    transaksi inner join member
                    on member.id_member=transaksi.id_member
                    inner join user 
                    on transaksi.id_user=user.id_user
                    order by transaksi.tgl desc";

                    $hasil = mysqli_query($connect, $sql);
                    while ($transaksi = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-2 col-md-5">
                                    <small class="text-info">Kode transaksi</small>
                                    <h5><?=($transaksi["id_transaksi"])?></h5>
                                </div>

                                <div class="col-lg-2 col-md-5">
                                <small class="text-info">Member</small>
                                    <h5><?=($transaksi["nama_member"])?></h5>
                                </div>

                                <div class="col-lg-2 col-md-5">
                                <small class="text-info">User</small>
                                    <h5><?=($transaksi["nama_user"])?></h5>
                                </div>

                                <div class="col-lg-2 col-md-5">
                                <small class="text-info">Tgl. transaksi</small>
                                    <h5><?=($transaksi["tgl"])?></h5>
                                </div>

                                <div class="col-lg-2 col-md-5">
                                <small class="text-info">Tgl. bayar</small>
                                    <h5><?=($transaksi["tgl_bayar"])?></h5>
                                </div>

                                <div class="col-lg-2 col-md-5">
                                <small class="text-info">Waktu ambil</small>
                                    <h5><?=($transaksi["batas_waktu"])?></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <h6>
                                        Status : 
                                        <?php if($transaksi["status"] == 'baru'){?>
                                            <div class="badge badge-info">
                                                <?=($transaksi["status"])?>
                                            </div>
                                        <?php }
                                        if($transaksi["status"] == 'proses'){?>
                                            <div class="badge badge-warning">
                                                <?=($transaksi["status"])?>
                                            </div>
                                        <?php }
                                        if($transaksi["status"] == 'selesai'){?>
                                            <div class="badge badge-primary">
                                                <?=($transaksi["status"])?>
                                            </div>
                                        <?php }
                                        if($transaksi["status"] == 'diambil'){?>
                                            <div class="badge badge-success">
                                                <?=($transaksi["status"])?>
                                            </div>
                                        <?php } 

                                        if($transaksi["dibayar"] == 'dibayar'){?>
                                            <div class="badge badge-success">
                                                <?=($transaksi["dibayar"])?>
                                            </div>
                                        <?php } 
                                        if($transaksi["dibayar"] == 'belum_bayar'){?>
                                            <div class="badge badge-danger">
                                                <?=($transaksi["dibayar"])?>
                                            </div>
                                        <?php } ?>
                                    </h6>
                                </div>
                            </div>
                            <a href="form-transaksi.php?id_transaksi=<?=$transaksi["id_transaksi"]?>">
                               <button class="btn btn-sm btn-outline-info mx-2">
                                  Edit Status
                               </button>
                            </a>
                            
                            <br>
                            <small class="text-success">
                                <b>
                                Jenis Laundry :
                                </b>
                            </small>
                                <?php
                                $id_transaksi = $transaksi["id_transaksi"];
                                $sql = "select * from detil_transaksi 
                                inner join paket 
                                on detil_transaksi.id_paket = paket.id_paket
                                where id_transaksi = '$id_transaksi'";

                                $hasil_paket = mysqli_query($connect, $sql);
                                while ($paket = mysqli_fetch_array($hasil_paket)) {
                                    ?>
                                        <small>
                                            <?=($paket["jenis"]) ?>
                                            <?=($paket["qty"])?>kg
                                            <i class="text-primary">
                                                (Total Rp<?=($paket["harga"]) * ($paket["qty"]) ?>)
                                            </i>
                                        </small>
                                    
                                    <?php
                                }
                                ?>
                        </li>
                        <?php }
                    ?>
                </ul>
            </div>
            <div class="card-footer">
                <a href="form-transaksi.php"> 
                    <button class="btn btn-success">
                        Tambah Data paket
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>