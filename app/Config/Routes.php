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
$routes->get('/playlists(:any)', 'MainController::playlists/$1');
$routes->post('addToPlaylist', 'MainController::addToPlaylist');
