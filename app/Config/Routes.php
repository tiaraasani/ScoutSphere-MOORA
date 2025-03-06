<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Home/home', 'Home::index');

//dataalter
$routes->get('dataalter/view', 'altercontroller::viewalter');
$routes->get('dataalter/forminputalter', 'altercontroller::inputalter');
$routes->post('dataalter/simpanalter', 'altercontroller::simpanalter');
$routes->get('dataalter/formeditalter/(:num)', 'altercontroller::formeditalter/$1');
$routes->post('dataalter/editalter/(:num)', 'altercontroller::editalter/$1');
$routes->get('dataalter/hapusalter/(:num)', 'altercontroller::hapusalter/$1');

//data matriks
$routes->get('datamatriks/view', 'matrikscontroller::viewmatriks');
$routes->get('datamatriks/forminputmatriks', 'matrikscontroller::inputmatriks');
$routes->post('datamatriks/simpanmatriks', 'matrikscontroller::simpanmatriks');
$routes->get('datamatriks/formeditmatriks/(:num)', 'matrikscontroller::formeditmatriks/$1');
$routes->post('datamatriks/editmatriks/(:num)', 'matrikscontroller::editmatriks/$1');
$routes->get('datamatriks/hapusmatriks/(:num)', 'matrikscontroller::hapusmatriks/$1');


//data kriteria
$routes->get('datakriteria/view', 'kriteriacontroller::viewkriteria');
$routes->get('datakr/forminputkr', 'kriteriacontroller::inputkr');
$routes->post('datakr/simpankr', 'kriteriacontroller::simpankr');
$routes->get('datakr/formeditkr/(:num)', 'kriteriacontroller::formeditkr/$1');
$routes->post('datakr/editkr/(:num)', 'kriteriacontroller::editkr/$1');
$routes->get('datakr/hapuskr/(:num)', 'kriteriacontroller::hapuskr/$1');

//perhitungan
$routes->get('Home/callviewoptimasi', 'Home::callviewoptimasi');
$routes->get('Home/callviewnormalisasi', 'Home::callviewnormalisasi');
$routes->get('Home/callviewhasil', 'Home::callviewhasil');
$routes->get('Home/callviewkeputusan', 'Home::callviewkeputusan');