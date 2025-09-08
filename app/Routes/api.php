<?php

//------ AuthController ---------------
$router->post('/login', 'AuthController@login');

//$router->post('/createUser', 'AuthController@Create');

// ------ CurrenciesController --------------

$router->get('/currencies','CurrenciesController@getCurrenciesHistory');