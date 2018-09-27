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

        /* READ */
        Router::addRoute(new Route('movie_show', 'GET', '/movie/{id:\d+}', 'Movie', 'showOne'));
        Router::addRoute(new Route('movies_list', 'GET', '/movies', 'Movie', 'showAll'));
        Router::addRoute(new Route('movies_paginate', 'GET', '/movies/page', 'Movie', 'showPaginate'));

        /* UPDATE */
        Router::addRoute(new Route('movie_edit', 'POST', '/movie/{id:\d+}/edit', 'Movie', 'updateMovie'));

        /* DELETE */
        Router::addRoute(new Route('movie_delete', 'GET', '/movie/{id:\d+}/delete', 'Movie', 'deleteMovie'));

        /* SEARCH */
        Router::addRoute(new Route('movie_search','GET','movies/search','Movie','searchMovies'));
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

