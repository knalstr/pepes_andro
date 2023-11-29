<?php
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $namasiswa  = $_POST['namasiswa'];
        $tingkat    = $_POST['tingkat'];
        $jurusan    = $_POST['jurusan'];
        $rombel     = $_POST['rombel'];
        $keterangan = $_POST['keterangan'];
        $point      = $_POST['point'];
        $tanggal    = $_POST['tanggal'];

        $sql = "INSERT INTO tbl_pelanggar (namasiswa,tingkat,jurusan,rombel,keterangan,point,tanggal) VALUES ('$namasiswa','$tingkat','$jurusan','$rombel','$keterangan','$point','$tanggal')";

        require_once('../Koneksi.php');

        if(mysqli_query($connect,$sql))
        {
            echo 'Berhasil Menambahkan Data Siswa langgar';
        }
        else
        {
            echo 'Gagal Menambahkan Data Siswa langgar';
        }

        mysqli_close($connect);
    }
?>