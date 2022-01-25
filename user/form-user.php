<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form User</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<?php include("../home.php")?>
<div class="container">
        <div class="card-header bg-dark">
            <h4 class="text-white">Form user</h4>
        </div>

        <div class="card-body">
            <?php
            if (isset($_GET["id_user"])) {
                // memeriksa ketika load file ini,
                // apakah membawa data GET dgn nama_user "id_anggota'
                // jika true, maka form anggota digunakan utk edit

                # mengakses data anggota dari id_anggota yg dikirim
                include "../connection.php";
                $id_user = $_GET["id_user"];
                $sql = "select * from user where id_user='$id_user'";
                # eksekusi perintah SQL
                $hasil = mysqli_query($connect, $sql);
                # konversi ke bentuk array
                $user = mysqli_fetch_array($hasil);
                ?>

                <form action="process-user.php" method="post"
                onsubmit ="return confirm('Apakah anda yakin ingin mengubah data ini?')">
                ID user
                <input type="text" name="id_user"
                class="form-control mb-2" required
                value="<?=$user["id_user"];?>" readonly/>

                Nama
                <input type="text" name="nama_user"
                class="form-control mb-2" required
                value="<?=$user["nama_user"];?>"/>

                Password
                <input type="password" name="password"
                class="form-control mb-2s"/>

                Username
                <input type="text" name="username"
                class="form-control mb-2" required
                value="<?=$user["username"];?>"/>


                Role
                <select name="role" class="form-control mb-2" required>
                        <option value="<?=$user["role"]?>" selected>
                           <?=$user["role"]?>
                        </option>
                        <option value="admin">admin</option>
                        <option value="kasir">kasir</option>
                </select>

                <button type="submit" class="btn btn-info btn-block"
                name="edit_user">
                    Simpan
                </button>
            </form>
                <?php
            }else {
                // jika felse maka form anggota digunakan utk insert
                // atau tambah data baru
                ?>
                <form action="process-user.php" method="post">
                Id user
                <input type="text" name="id_user"
                class="form-control mb-2" required/>

                Nama
                <input type="text" name="nama_user"
                class="form-control mb-2" required/>

                Password 
                <input type="password" name="password"
                class="form-control mb-2" required/>

                Username
                <input type="text" name="username"
                class="form-control mb-2" required/>

                Role
                <select name="role" class="form-control mb-2" required>
                        <option value="admin">admin</option>
                        <option value="kasir">kasir</option>
                </select>

                <button type="submit" class="btn btn-info btn-block"
                name="simpan_user">
                    Simpan
                </button>
            </form>
                <?php
            }
            ?>
            
        </div>
    </div>
</body>
</html>