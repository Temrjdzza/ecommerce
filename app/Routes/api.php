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

// ------ TrafficSourceController -------------

$router->get('/storeVisits','TrafficSourceController@traffic');

// ------ ReferralsController --------------

$router->get('/referrals','ReferralsController@referrals');

// ----------- PortfolioController --------------

$router->get('/portfolio','PortfolioController@getPortfolio');