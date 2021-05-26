<?php
    $root = dirname(__DIR__, 2);
    require_once 'Models.php';

    class Item extends Models{
        protected $table = "items";

        public function getAllWhere($where = "1=1", $sort = "created_at DESC"){
            $query = "SELECT * FROM $this->table WHERE $where ORDER BY $sort";
            $res = $this->conn->query($query);
            $res = $res->fetchAll();
            return $res;
        }
    }
?>