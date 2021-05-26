<?php
include_once dirname(__DIR__, 2).'/business/models/Category.php';
include_once 'utils/response.php';

function categoryCreate($payload = []){
    $model = new Category;
    $payload['slug'] = urlencode($payload['name']);
    $res = $model->insert($payload);
    if(!$res){
        return responseJSON([], "Failed", 500);
    }
    return responseJSON($res, "Created", 201);
}
function categoryUpdate($payload = []){
    $model = new Category;
    $payload['slug'] = urlencode($payload['name']);
    $res = $model->update($payload, "id = ".$payload['id']);
    if(!$res){
        return responseJSON([], "Failed", 500);
    }
    return responseJSON($res, "Updated", 200);
}

function categoryDelete($payload = []){
    $model = new Category;
    $res = $model->delete("id = ".$payload['id']);
    if(!$res){
        return responseJSON([], "Failed", 500);
    }
    return responseJSON($res, "Updated", 200);
}

function categoryGetAll(){
    $model = new Category;
    $res = $model->getAll();
    return $res;
}

function categoryGetOneByID($id){
    $model = new Category;
    $res = $model->read("id = $id");
    return $res;
}
?>