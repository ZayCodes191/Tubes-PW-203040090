<?php
    include dirname(__DIR__).'/models/User.php';
    function login($payload = []){
        $model = new User();
        $user = $model->read("email = '".$payload['email']."'");
        if(!$user){
            return false;
        }
        if(!password_verify($payload['password'], $user['password'])){            
            return false;
        }
        $expired = date_add(new DateTime(date('Y-m-d')), date_interval_create_from_date_string("30 days"));
        $token = [
            'id' => $user['id'],
            'email' => $payload['email'],
            'role' => 'Admin',
            'type' => "auth",
            'expired' =>$expired->format('Y-m-d H:i:s'),
        ];
        $token = json_encode($token);
        $token = base64_encode($token);
        if($payload['remember_me']){
            setcookie("authToken", $token,  time() + (86400 * 30));
        }
        $_SESSION['authToken'] = $token;
        return true;
    }

    function getLogged(){
        $token = $_SESSION['authToken'];
        $payload = base64_decode($token);
        $payload = json_decode($payload, true);
        return $payload;
    }

    function logout(){
        session_destroy();
        if(isset($_COOKIE['authToken'])){
            setcookie("authToken", "", time() - 3600);
        }
        header('location: ?route=/');
    }
?>