<?php

    include 'Koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //Data
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $response = [];

        //Cek username
        $userQuery = $connect->prepare("SELECT * FROM user WHERE username = ?");
        $userQuery->execute(array($username));
        $getResult = $userQuery->get_result();
        $query = $getResult->fetch_all(MYSQLI_ASSOC);

        if($getResult->num_rows == 0){
            $response['status']  = false;
            $response['message'] = " Username Tidak Terdaftar";   
        } else {
            $passwordDB = $query[0]['password'];

            if(strcmp(md5($password), $passwordDB) === 0){
                $response['status']     = true;
                $response['message']    = "Login Berhasil";
                $response['data'] = [
                    'iduser'        => $query[0]['iduser'],
                    'idpetugas'     => $query[0]['idpetugas'],
                    'username'      => $query[0]['username']
                ];
            } else {
                $response['status'] = false;
                $response['message'] = "Password anda salah";
            }
        }

        $json = json_encode($response, JSON_PRETTY_PRINT);

        echo $json;
}

?>