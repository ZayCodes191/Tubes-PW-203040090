<?php
    function uploadImage($files, $dir = "public/img/"){
        $return = [
            'success' => 0,
            'msg' => null,
            "image" => null,
        ];
        $type = explode('/', $files['type']);
        $fileName = $dir.time().".".$type[1];
        if($type[1] != "jpg" && $type[1] != "png" && $type[1] != "jpeg"){
            $return["msg"] = "Image must be jpg/png/jpeg";
            return $return;
        }
        try{
            if (move_uploaded_file($files["tmp_name"], $fileName)) {
                    $return = [
                        'success' => 1,
                        'msg' => 'Success',
                        'image' => $fileName
                    ];
            } else {
                $return['msg'] = "Failed to save image!";
            }

        }catch(\Exception $e){
            $return['msg'] = $e;
        }

        return $return;
    }
?>