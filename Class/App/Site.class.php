<?php

namespace App;

use App\Layout\Layout;
use App\Net\HTTPRequest;
use App\Router;
use App\Route;
use App\Store\Database;

class Site {
    private $req;
    private $db;
    private $layout;

    function __construct(){

        $this->db = new Database(MYSQL_HOST, MYSQL_DB, MYSQL_USER, MYSQL_PWD);
        $this->req = new HTTPRequest();
        $this->layout = new Layout('layout');

        // Accueil
        Router::addRoute(new Route('homepage', 'GET', '/', 'Home', 'show'));

        // Films

        /* CREATE */
        Router::addRoute(new Route('movie_add', 'POST', '/movie/add', 'Movie', 'createMovie'));

        /* UPDATE */
        Router::addRoute(new Route('movie_edit', 'PUT', '/movie/edit', 'Movie', 'updateMovie'));
//        Router::addRoute(new Route('POST', '/movie/delete/{id:\d+}', 'Movie', 'updateMovie'));

        /* READ */
        Router::addRoute(new Route('movies_list', 'GET', '/movies', 'Movie', 'showList'));
        Router::addRoute(new Route('movie_show', 'GET', '/movie/{id:\d+}', 'Movie', 'showOne'));

        /* DELETE */
//        Router::addRoute(new Route('DELETE', '/movies', 'Movie', 'deleteMovie'));
        Router::addRoute(new Route('movie_delete', 'DELETE', '/movie/delete/{id:\d+}', 'Movie', 'deleteMovie'));
    }

    function run() {

        list($name, $action) = Router::getController($this->req);

        if(!empty($name) && !empty($action)) {
            $class = 'App\Controllers\\' . $name . 'Controller';
            $ctrl = new $class($this->db, $this->layout);
            $ctrl->{$action}();
        } else {
            $class = 'App\Controllers\ErrorController';
            $ctrl = new $class($this->db, $this->layout);
            $ctrl->render404();
        }
    }
}

