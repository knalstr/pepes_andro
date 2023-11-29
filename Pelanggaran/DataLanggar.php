<?php
    require_once('../Koneksi.php');
    if(isset($_GET['idpelanggar']))
    {
        $idpelanggar = $_GET['idpelanggar'];
    }

    function getnotes_byNama()
    {
        global $connect;
        $namasiswa = $_GET['name'];
    //nama like $namasiswa
    $query = $connect->query("SELECT * FROM coffee_notes_gmbr WHERE `name` LIKE '%$namasiswa%' ");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'success',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
    }

?>