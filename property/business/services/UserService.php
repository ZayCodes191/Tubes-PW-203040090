<?php
    $root = dirname(__DIR__, 2);
    include_once $root.'/business/models/User.php';
    include_once 'utils/response.php';

    function userCreate($payload = []){
        $user = new User;
        $payload['password'] = password_hash($payload['password'], PASSWORD_BCRYPT);
        $res = $user->insert($payload);
        if(!$res){
            return responseJSON([], "Failed", 500);
        }
        return responseJSON($res, "Created", 201);
    }

    function createAdmin(){
        $model = new User;
        $user = $model->read("email = 'admin@admin.admin'");
        if(!$user){
            $payload = [
                'email' => 'admin@admin.admin',
                'password' => password_hash('passwordAdmin', PASSWORD_BCRYPT)
            ];
            $user = $model->insert($payload);
            return $user;
        }else{
            echo "Admin sudah ada!";
        }
    }

    function sendEmailVerification($to, $link){
        sendEmail($to, "", "COMPLETE YOUR SIGNUP", "Please click or copy url below: <p>$link</p>");
    }

    function userGetOneByID($id){
        $model = new User;
        $res = $model->read("id = $id");
        return $res;
    }

    function userGetAll(){
        $model = new User;
        $res = $model->getAll();
        return $res;
    }
    
    function userUpdate($payload = []){
        $model = new User;
        $payload['password'] = password_hash($payload['password'], PASSWORD_BCRYPT);
        $res = $model->update($payload, "id = ".$payload['id']);
        if(!$res){
            return responseJSON([], "Failed", 500);
        }
        return responseJSON($res, "Updated", 200);
    }
    
    function userDelete($payload = []){
        $model = new User;
        $res = $model->delete("id = ".$payload['id']);
        if(!$res){
            return responseJSON([], "Failed", 500);
        }
        return responseJSON($res, "Updated", 200);
    }
?>