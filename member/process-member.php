<?php
include("../connection.php");
if (isset($_POST["simpan_member"])) {
    # proses insert new data
    // tampung data input member dari user
    $id_member = $_POST["id_member"];
    $nama_member = $_POST["nama_member"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tlp = $_POST["tlp"];
 

    // membuat perintah SQL utk insert data ke tbl member
    $sql = "insert into member values ('$id_member',
    '$nama_member','$alamat','$jenis_kelamin','$tlp')";

    // eksekusi perintah / menjalankan perintah SQL
    mysqli_query($connect, $sql);

    // direct / dikembalikan ke halaman list member
    header("location:list-member.php");
}

if (isset($_POST["edit_member"])) {
    # tampung data yg akan diupdate
    $id_member = $_POST["id_member"];
    $nama_member = $_POST["nama_member"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tlp = $_POST["tlp"];

    # perintah SQL update ke table member
    $sql = "update member set nama_member='$nama_member',
    alamat='$alamat', jenis_kelamin='$jenis_kelamin',tlp='$tlp' 
    where id_member='$id_member'";

    # eksekusi perintah SQL
    mysqli_query($connect, $sql);

    # direct / dikembalikan ke halaman list member
    header("location:list-member.php");
}
elseif (isset($_GET["id_member"])) {
    $id_member = $_GET["id_member"];
    
    # hapus data yg ada di tabel buku
    $sql = "delete from member where id_member='$id_member'";
    if (mysqli_query($connect, $sql)) {
        header("location:list-member.php");
    } else {
        echo mysqli_error($connect);
    }
}
?>