<?php

//------ AuthController ---------------
$router->post('/login', 'AuthController@login');

//$router->post('/createUser', 'AuthController@Create');

// ------ CurrenciesController --------------

$router->get('/currencies','CurrenciesController@getCurrenciesHistory');

// --------- DashboardController ----------------
$router->get('/totalProfit','DashboardController@totalProfit');
$router->get('/orderList','DashboardController@ordersList');

// --------- ProductsController ---------------
$router->get('/bestSelling','ProductsController@bestSellingProducts');

// ----------- SellersController ------------

$router->get('/topSellers','SellersController@topSellers');