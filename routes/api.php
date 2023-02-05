<?php 

use App\response\HTTPResponse;
$router = new \Bramus\Router\Router();
 
 
$router->setNamespace('\App');
 
/**
 * Definimos nuestras rutas
 */
$router->get('/', 
    function() {
        HTTPResponse::json(200, 'Bienvenido a la API de peliculas');
    }
);
$router->get('/peliculas', 'controllers\MoviesController@all');
$router->get('/peliculas/pag/(\d+)', 'controllers\MoviesController@allPaginated');
$router->get('/peliculas/(\d+)', 'controllers\MoviesController@find');
$router->get('/peliculas/(\d+)/actores', 'controllers\MoviesController@allActores');
$router->post('/peliculas', 'controllers\MoviesController@insert');
$router->delete('/peliculas/(\d+)', 'controllers\MoviesController@delete');
$router->put('/peliculas/(\d+)', 'controllers\MoviesController@update');
$router->post('/peliculas/login/register', 'controllers\UserController@register');
$router->delete('/peliculas/login/delete/(\d+)', 'controllers\UserController@delete');
$router->get('/peliculas/login/users', 'controllers\UserController@users');
$router->post('/peliculas/login', 'controllers\UserController@login');
$router->post('/peliculas/logout/(\d+)', 'controllers\UserController@logout');
$router->set404(function() { HTTPResponse::json(404,'Página no encontrada');});

$router->run();

?>