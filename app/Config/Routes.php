<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Usuarios
$routes->resource('usuarios', ['placeholder' => '(:num)', 'except' => 'show']);
$routes->post('usuarios/logout', 'Usuarios::logout');
$routes->post('usuarios/login', 'Usuarios::login');
$routes->get('usuarios/log', 'Usuarios::log');
$routes->get('usuarios/perfil', 'Usuarios::perfil');
$routes->get('usuarios/validation', 'Usuarios::validation');
$routes->get('usuarios/news', 'Usuarios::news');
$routes->get('usuarios/view', 'Usuarios::view');
$routes->get('usuarios/finish', 'Usuarios::finish');
$routes->get('usuarios/publicated', 'Usuarios::publicated');


// Noticias
$routes->get('/', 'Noticias::index');
$routes->get('noticias/index', 'Noticias::index');
$routes->resource('noticias', ['placeholder' => '(:num)', 'except' => 'show']);
$routes->post('noticias/news', 'Noticias::news');
$routes->get('noticias/edit/(:num)', 'Noticias::edit/$1');
$routes->post('noticias/update/(:num)', 'Noticias::update/$1', ['as' => 'noticias.update']);
$routes->get('noticias/show/(:segment)', 'Noticias::show/$1');

$routes->get('noticias/activar/(:num)', 'Noticias::activar/$1');
$routes->get('noticias/desactivar/(:num)', 'Noticias::desactivar/$1');
$routes->get('noticias/descart/(:num)', 'Noticias::descart/$1');
$routes->get('noticias/publication/(:num)', 'Noticias::publication/$1');
$routes->get('noticias/correction/(:num)', 'Noticias::correction/$1');
$routes->get('noticias/deshacer/(:num)', 'Noticias::deshacer/$1');
$routes->get('usuarios/views', 'Noticias::views');







