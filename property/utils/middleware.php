<?php

    function isLoginGetToken(){
        $token = null;
        if(isset($_COOKIE['authToken'])){
            $token = $_COOKIE['authToken'];
        }else if(isset($_SESSION['authToken'])){
            $token = $_SESSION['authToken'];
        }
        return $token;
    }

    function getDataFromToken($token){
        $payload = base64_decode($token);
        $payload = json_decode($payload, true);
        return $payload;
    }

    function isAdmin(){
        if(isset($_COOKIE['authToken'])){
            $token = $_COOKIE['authToken'];
        }else if(isset($_SESSION['authToken'])){
            $token = $_SESSION['authToken'];
        }
        $payload = base64_decode($token);
        $payload = json_decode($payload, true);
        if($payload['role'] == "Admin") return true;
        return false;
    }
?>