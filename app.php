<?php

function router($routes){
    $request_uri = $_SERVER["REQUEST_URI"];
$request_uri = preg_replace("/".BASE_URL."/","",$request_uri,1);
$request_path = getRequestedPath($request_uri);
    $request_method = $_SERVER['REQUEST_METHOD'];
    foreach ($routes[$request_method] as $path => $handlers) {
        if($path == $request_path){
            $param_arr = [];
            include 'Controllers/'.$handlers["controller_name"].".php";
            include 'utils.php';
            include 'guards.php';
            if(array_key_exists('guards',$handlers)){
                foreach($handlers['guards'] as $guard){
                    $res = $guard();
                    if(!$res){
                        http_response_code(401);
                        echo 'Auth error';
                        die();
                    }
                }
            }
            if(array_key_exists('functional_params', $handlers)){
                foreach($handlers['functional_params'] as $func){
                $res = $func();
                array_push($param_arr,$res);
            }
        }
            $response = $handlers['handler'](...$param_arr);
            echo json_encode($response);
            die();
        }
    }
    http_response_code(404);
    echo "not matched";
}

function getRequestedPath($path){
    $arr = explode("?",$path);
    $path = trim($arr[0],"/");
    return $path;
}