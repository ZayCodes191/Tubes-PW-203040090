<?php
    function responseJSON($array = [], $msg = "", $code = 200){
        return [
            'message' => $msg,
            'data' => $array,
            'code' => $code
        ];
    }
?>