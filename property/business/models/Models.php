<?php   
    $root = dirname(__DIR__, 2);
    include $root.'/database/mysql.php';

    class Models {
        public $conn = null;
        protected $table = null;
        protected $fields = [];

        public function __construct(){
            $db = new Connection();
            $this->conn = $db->getConnection();
            $this->fields = $this->getFields();
        }

        protected function getFields(){
            $fields = [];
            $res = $this->conn->query("DESC $this->table");
            foreach($res->fetchAll() as $value){
                $fields[] = $value['Field'];
            }
            return $fields;
        }


        protected function preparePayloadExecute($payload = []){
            $payloadExec = [];
            foreach($payload as $key => $value){
                $payloadExec[] = $value;
            }
            return $payloadExec;
        }
        
        public function insert($payload = []){
            $fieldString = "created_at, updated_at, ";
            $valueString = "now(), now(), ";
            $size = count($payload);
            $i = 0;
            foreach($payload as $key => $value){
                $fieldString = $fieldString.$key;
                $valueString = $valueString.":$key";
                // $valueString = $valueString."?";
                if ($i != $size-1){
                    $fieldString = $fieldString. ", ";
                    $valueString = $valueString.", ";
                }
                $i++;
            }            
            $query = "INSERT INTO $this->table ($fieldString) VALUES ($valueString)";

            $stmt = $this->conn->prepare($query);
            try{
                $isInsert = $stmt->execute($payload);
            }catch(\PDOException $e){
                return null;
            }
            // get inserted data
            $insertID = $this->conn->lastInsertId();
            $query = "SELECT * FROM $this->table where id = $insertID";
            $res = $this->conn->query($query);
            $res = $res->fetch(PDO::FETCH_ASSOC);
            return $res;
        }

        public function update($payload = [], $where = " 1=1 "){
            $query = "UPDATE $this->table SET ";
            $size = count($payload);
            $i = 0;
            $query = $query."updated_at=now(), ";
            foreach($payload as $key => $value){
                $query = $query."$key=:$key";
                if ($i != $size-1){
                    $query = $query.", ";
                }
                $query = $query." ";
                $i++;
            }
            $query = $query."WHERE $where";
            try{
                $this->conn->prepare($query)->execute($payload);
            }catch(\PDOexception $e){
                return $e;
            }

             // get inserted data
             $query = "SELECT * FROM $this->table where $where";
             $res = $this->conn->query($query);
             $res = $res->fetch(PDO::FETCH_ASSOC);
             return $res;
            
        }

        public function read($where =" 1=1 "){
            $query = "SELECT * FROM $this->table where $where";
            $res = $this->conn->query($query);
            $res = $res->fetch(PDO::FETCH_ASSOC);
            return $res;
        }

        public function getAll(){
            $query = "SELECT * FROM $this->table";
            $res = $this->conn->query($query);
            $res = $res->fetchAll();
            return $res;
        }

        public function delete($where){
            $query = "DELETE FROM $this->table WHERE $where";
            $res = $this->conn->prepare($query)->execute();
            return $res;
        }
    }
?>