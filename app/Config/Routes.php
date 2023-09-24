<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->post('save', 'MainController::upload');
$routes->get('/searchSong', 'MainController::searchSong');
$routes->post('saveSong', 'MainController::upload');
$routes->post('createPlaylist', 'MainController::createPlaylist');
