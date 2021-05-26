<?php

class Connection{
    public $config = [
        "host" => "localhost",
        "port" => "3306",
        "username" => "root",
        "password" => "",
        "database" => "property"
    ];

    public function getConnection(){
        $conn = new PDO("mysql:host=" . $this->config['host'] . ":" . $this->config['port'] . ";dbname=" . $this->config['database'], $this->config['username'], $this->config['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(!$conn){
            return null;
        }
        return $conn;
    }
}

?>
