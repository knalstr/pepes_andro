<?php
    require_once('../Koneksi.php');
    if(isset($_GET['idpelanggar']))
    {
        $idpelanggar = $_GET['idpelanggar'];
    }

    function get_notespelanggar()
    {
        //query semua data obat
        global $connect;
        $query = $connect->query("SELECT * FROM tbl_pelanggar");
        while ($row = mysqli_fetch_object($query)) {
            $data[] = $row;
        }
        $response = array(
            'status'    => 1,
            'message'   => 'success',
            'data'      => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function getnotes_byNama()
    {
        global $connect;
        $namasiswa = $_GET['namasiswa'];
    //nama like $namasiswa
    $query = $connect->query("SELECT * FROM tbl_pelanggar WHERE `namasiswa` LIKE '%$namasiswa%' ");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }
    $response = array(
        'status'    => 1,
        'message'   => 'success',
        'data'      => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
    }

    function insert_pelanggarnotes()
    {
        global $connect;   
        $check = array(
            'namasiswa'     => '', 
            'tingkat'       => '', 
            'jurusan'       => '', 
            'rombel'        => '', 
            'angkatan'      => '', 
            'keterangan'    => '', 
            'point'         => '', 
            'tanggal'       => ''
        );

        $check_match = count(
            array_intersect_key($_POST, $check)
        );

        if($check_match == count($check)){
            $result = mysqli_query($connect,
                "INSERT INTO tbl_pelanggar SET
                    namasiswa = '$_POST[namasiswa]',
                    tingkat = '$_POST[tingkat]',
                    jurusan = '$_POST[jurusan]',
                    rombel = '$_POST[rombel]',
                    angkatan = '$_POST[angkatan]',
                    keterangan = '$_POST[keterangan]',
                    point = '$_POST[point]',
                    tanggal = '$_POST[tanggal]'"
                );
            
            if($result) {
            $response=array(
                'status' => 1,
                'message' =>'Insert Success'
            );
            } else {
            $response=array(
                'status' => 0,
                'message' =>'Insert Failed.'
                );
            }
        } else {
        $response=array(
                'status' => 0,
                'message' =>'Wrong Parameter'
                );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>