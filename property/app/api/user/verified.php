<?php
    include '../../../utils/response.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $payload = base64_decode($token);
    $json = json_decode($payload, true);

    if($json==null){
        echo responseJSON(null, "Token not valid", 400);    
        return ;
    }
    // is type 'Register'?
    if($json['type'] != "Register"){
        echo responseJSON(null, "Token not valid", 400);    
        return ;
    }
    // is expired ?
    $dateNow = new DateTime(date('Y-m-d H:i:s'));
    $expiredAt = new DateTime($json['expired']);
    if($dateNow > $expiredAt){
        echo responseJSON(null, "Token not valid", 400);    
        return ;
    }

    // update table verified_at dengan waktu sekarang
    // expected result user berhasil terverified
}
?>