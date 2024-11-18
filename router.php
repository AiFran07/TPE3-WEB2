<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/vehicle.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    $router->addMiddleware(new JWTAuthMiddleware());

    #                 endpoint        verbo      controller              metodo
    $router->addRoute('api/vehiculos', 'GET', 'VehicleApiController', 'getAll');
    $router->addRoute('api/vehiculos/:id', 'GET', 'VehicleApiController', 'get');
    $router->addRoute('api/vehiculos/:id', 'DELETE', 'VehicleApiController', 'delete');
    $router->addRoute('api/vehiculos', 'POST', 'VehicleApiController', 'create');
    $router->addRoute('api/vehiculos/:id', 'PUT', 'VehicleApiController', 'update');
    
    
    
    $router->addRoute('usuarios/token'    ,            'GET',     'UserApiController',   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);