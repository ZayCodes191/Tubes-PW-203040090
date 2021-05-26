<?php
include_once dirname(__DIR__, 2).'/business/models/Items.php';
include_once 'utils/response.php';
include_once 'utils/uploadImage.php';

function propertyCreate($payload = []){
    $auth = getDataFromToken(isLoginGetToken());
    $model = new Item;
    $payload['user_id'] = $auth['id'];
    $uploadImage = uploadImage($payload['image']);
    if(!$uploadImage['success']){
        return responseJSON([], $uploadImage['msg'], 500);
    }
    $payload['image'] = $uploadImage['image'];
    $res = $model->insert($payload);
    if(!$res){
        return responseJSON([], "Failed", 500);
    }
    return responseJSON($res, "Created", 201);
}

function propertyUpdate($payload = []){
    $model = new Item;
    if($payload['image']['name'] == ""){
        unset($payload['image']);
    }else{
        $uploadImage = uploadImage($payload['image']);
        if(!$uploadImage['success']){
            return responseJSON([], $uploadImage['msg'], 500);
        }
        $payload['image'] = $uploadImage['image'];
    }
    
    $res = $model->update($payload, "id= ".$payload['id']);
    if(!$res){
        return responseJSON([], "Failed", 500);
    }
    return responseJSON($res, "Updated", 200);
}

function propertyDelete($payload = []){
    $model = new Item;
    $res = $model->delete("id = ".$payload['id']);
    if(!$res){
        return responseJSON([], "Failed", 500);
    }
    return responseJSON($res, "Updated", 200);
}

function propertyGetAll(){
    $model = new Item;
    $res = $model->getAll();
    return $res;
}

function propertyGetAllWhere($where, $sort){
    $model = new Item;
    if(!$where){
        $where = "1=1";
    }
    if(!$sort){
        $sort = "created_at DESC";
    }
    return $model->getAllWhere($where, $sort);
    
}
?>