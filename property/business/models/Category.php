<?php
    $root = dirname(__DIR__, 2);
    require_once 'Models.php';

    class Category extends Models{
        protected $table = "Category";
    }
?>