<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once "app.php";

define("BASE_URL",'\/rest-server');

$routes = [
    "POST"=>[
        "demo"=>[
            'functional_params'=>['getBody'],
            'guards' => ['isAuthorized'],
            'controller_name'=>'demo',
            'handler' => 'handleDemo'
        ],
    ],
    "GET"=>[
        
        "demo/profile"=> [
            'controller_name'=>'profile',
            'handler'=>"handleProfile"
            ]
    ],
    ];

router($routes);
    






