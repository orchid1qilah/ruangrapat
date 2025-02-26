<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/home', 'Home::index');

//routes input layout
$routes->get('/inputlayout', 'InputLayoutController::index');
$routes->post('/inputlayoutcontroller/upload','InputLayoutController::upload');
$routes->get('/inputlayout/list', 'InputLayoutController::list');


$routes->group('inputlayout', function ($routes) {
$routes->get('delete/(:num)', 'InputLayoutController::delete/$1');
$routes->get('edit/(:num)', 'InputLayoutController::edit/$1');
$routes->post('update/(:num)', 'InputLayoutController::update/$1');
});

// Routtes u ruang rapat
$routes->get('/ruangrapat', 'RuangRapatController::index');
$routes->get('/ruangrapat/create', 'RuangRapatController::create');
$routes->post('/ruangrapat/store', 'RuangRapatController::store');
$routes->get('/ruangrapat/list', 'RuangRapatController::list');
$routes->get('/ruangrapat/show/(:num)', 'RuangRapatController::show/$1');

$routes->group('ruangrapat', function ($routes) {
$routes->get('delete/(:num)', 'RuangRapatController::delete/$1');
//edit update
$routes->get('edit/(:num)', 'RuangRapatController::edit/$1');
$routes->post('update/(:num)', 'RuangRapatController::update/$1');
});


//Routes u perlengkapan
$routes->get('/perlengkapan', 'PerlengkapanController::index');
$routes->get('/perlengkapan/create', 'PerlengkapanController::create');
$routes->post('/perlengkapan/store', 'PerlengkapanController::store');
$routes->get('/perlengkapan/edit/(:num)', 'PerlengkapanController::edit/$1');
$routes->post('/perlengkapan/update/(:num)', 'PerlengkapanController::update/$1');

//Routes u Form Peminjaman 
//$routes->get('peminjaman', 'PeminjamanController::create');
///$routes->post('peminjaman/store', 'PeminjamanController::store');

// Routes untuk form peminjaman
$routes->post('/peminjaman/store', 'PeminjamanController::store');
$routes->get('/peminjaman', 'PeminjamanController::index'); 
$routes->get('/peminjaman/create', 'PeminjamanController::create');

//Routes u antrian
$routes->get('/antrian', 'AntrianController::index');
$routes->get('antrian/change_status/(:num)/(:alpha)', 'AntrianController::change_status/$1/$2');
$routes->get('antrian/filter', 'AntrianController::filter');



$routes->setAutoRoute(false);