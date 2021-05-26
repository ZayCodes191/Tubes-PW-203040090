<?php
    $root = dirname(__DIR__, 2);
    require_once 'Models.php';

    class User extends Models{
        protected $table = "users";
    }
?>