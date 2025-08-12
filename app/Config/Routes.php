<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Website::index');

$routes->get('/', 'Home::index');
$routes->post('/login_action', 'Home::login');
$routes->get('/logout', 'Home::logout');



$routes->get('/profileuser', 'User::profile',['filter' => 'authfilter']);
$routes->post('/change_profile', 'User::change_profile',['filter' => 'authfilter']);
$routes->post('/change_password', 'User::change_password',['filter' => 'authfilter']);
$routes->post('/upload_ttd', 'User::upload_ttd',['filter' => 'authfilter']);


$routes->get('/user', 'User::index',['filter' => 'authfilter']);
$routes->get('/add_user', 'User::create',['filter' => 'authfilter']);
$routes->post('/add_action_user', 'User::create_action',['filter' => 'authfilter']);
$routes->get('/update_user/(:num)', 'User::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_user', 'User::update_action',['filter' => 'authfilter']);
$routes->get('/hapus_user/(:num)', 'User::delete/$1',['filter' => 'authfilter']);

$routes->get('/level', 'Level::index',['filter' => 'authfilter']);
$routes->get('/add_level', 'Level::create',['filter' => 'authfilter']);
$routes->post('/add_action_level', 'Level::create_action',['filter' => 'authfilter']);
$routes->get('/update_level/(:num)', 'Level::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_level', 'Level::update_action',['filter' => 'authfilter']);
$routes->get('/hapus_level/(:num)', 'Level::delete/$1',['filter' => 'authfilter']);

$routes->get('/product', 'Product::index',['filter' => 'authfilter']);
$routes->get('/add_product', 'Product::create',['filter' => 'authfilter']);
$routes->post('/add_action_product', 'Product::create_action',['filter' => 'authfilter']);
$routes->get('/update_product/(:num)', 'Product::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_product', 'Product::update_action',['filter' => 'authfilter']);
$routes->get('/hapus_product/(:num)', 'Product::delete/$1',['filter' => 'authfilter']);
$routes->get('/laporan_product', 'Product::laporan',['filter' => 'authfilter']);

$routes->get('/masterapproval', 'Masterapproval::index',['filter' => 'authfilter']);
$routes->get('/add_masterapproval', 'Masterapproval::create',['filter' => 'authfilter']);
$routes->post('/add_action_masterapproval', 'Masterapproval::create_action',['filter' => 'authfilter']);
$routes->get('/hapus_masterapproval/(:num)', 'Masterapproval::delete/$1',['filter' => 'authfilter']);

$routes->get('/productin', 'Productin::index',['filter' => 'authfilter']);
$routes->get('/add_productin', 'Productin::create',['filter' => 'authfilter']);
$routes->post('/add_action_productin', 'Productin::create_action',['filter' => 'authfilter']);
$routes->get('/update_productin/(:num)', 'Productin::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_productin', 'Productin::update_action',['filter' => 'authfilter']);
$routes->get('/hapus_productin/(:num)', 'Productin::delete/$1',['filter' => 'authfilter']);
$routes->get('/laporan_productin', 'Productin::laporan',['filter' => 'authfilter']);


$routes->get('/productout', 'Productout::index',['filter' => 'authfilter']);
$routes->get('/productout_app', 'Productout::approval',['filter' => 'authfilter']);
$routes->get('/add_productout/(:any)', 'Productout::create/$1',['filter' => 'authfilter']);
$routes->post('/add_action_productout', 'Productout::create_action',['filter' => 'authfilter']);
$routes->get('/hapus_productout/(:num)', 'Productout::delete/$1',['filter' => 'authfilter']);
$routes->get('/submit_productout/(:num)', 'Productout::submit/$1',['filter' => 'authfilter']);
$routes->get('/approve_productout/(:num)', 'Productout::approve/$1',['filter' => 'authfilter']);
$routes->get('/reject_productout/(:num)', 'Productout::reject/$1',['filter' => 'authfilter']);
$routes->get('/cetak_productout/(:num)', 'Productout::cetak/$1',['filter' => 'authfilter']);
$routes->get('/laporan_productout', 'Productout::laporan',['filter' => 'authfilter']);




$routes->get('/add_listproductout/(:any)', 'Listproductout::create/$1',['filter' => 'authfilter']);
$routes->post('/add_action_listproductout', 'Listproductout::create_action',['filter' => 'authfilter']);
$routes->get('/update_listproductout/(:num)', 'Listproductout::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_listproductout', 'Listproductout::update_action',['filter' => 'authfilter']);
$routes->get('/hapus_listproductout/(:num)', 'Listproductout::delete/$1',['filter' => 'authfilter']);





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
