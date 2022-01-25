<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Member</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="font.css">
</head>
<body>
<?php include("../home.php")?>
<div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">Form member</h4>
            </div>

            <div class="card-body">
                <?php
                if(isset($_GET["id_member"])){
                  // jika true, maka form member digunakan utk edit

                # mengakses data member dari id_member yg dikirim
                include "../connection.php";
                $id_member = $_GET["id_member"];
                $sql = "select * from member where id_member='$id_member'";
                # eksekusi perintah SQL
                $hasil = mysqli_query($connect, $sql);
                # konversi ke bentuk array
                $member = mysqli_fetch_array($hasil);
                ?>

                <form action="process-member.php" method="post"
                onsubmit ="return confirm('Apakah anda yakin ingin mengubah data ini?')">
                ID Member
                <input type="text" name="id_member"
                class="form-control mb-2" required
                value="<?=$member["id_member"];?>" readonly/>

                Nama
                <input type="text" name="nama_member"
                class="form-control mb-2" required
                value="<?=$member["nama_member"];?>"/>

                Alamat
                <input type="text" name="alamat"
                class="form-control mb-2" required
                value="<?=$member["alamat"];?>"/>

                Jenis Kelamin
                <select name="jenis_kelamin" class="form-control mb-2" required>
                        <option value="<?=$member["jenis_kelamin"]?>" selected>
                           <?=$member["jenis_kelamin"]?>
                        </option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                Telepon
                <input type="text" name="tlp"
                class="form-control mb-2" required
                value="<?=$member["tlp"];?>"/>

                <button type="submit" class="btn btn-info btn-block"
                name="edit_member">
                    Simpan
                </button>
            </form>
                <?php
                }else{
                    // jika false, maka form member digunakan untuk insert
                    ?>
                    <form action="process-member.php" method="post">
                    ID Member
                    <input type="text" name="id_member" 
                    class="form-control mb-2" required />

                    Nama 
                    <input type="text" name="nama_member" 
                    class="form-control mb-2" required />

                    Alamat 
                    <input type="text" name="alamat" 
                    class="form-control mb-2" required />

                    Jenis Kelamin
                    <select name="jenis_kelamin" class="form-control mb-2" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    Telepon
                    <input type="text" name="tlp" 
                    class="form-control mb-2" required />

                    <button type="submit"
                    class="btn btn-info btn-block"
                    name="simpan_member">
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