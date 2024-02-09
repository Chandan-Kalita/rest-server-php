<?php

function getQueries(){
    return $_GET;
}

function getBody(){
    $json = file_get_contents("php://input");
    return json_decode($json);
}