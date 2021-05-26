<?php
    include '../../../business/services/UserService.php';
    include '../../../utils/response.php';
    if($_POST['email'] && $_POST['password']){
        $res = create([
            "email" => $_POST['email'],
            "password" => $_POST['password']
        ]);
        echo responseJSON($res, "Created", 201);    
    }else{
        echo responseJSON(null, "error", 400);
        return;
    }
?>