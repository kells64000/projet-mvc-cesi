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

        Router::addRoute(new Route('GET', '/', 'Home', 'show'));
        Router::addRoute(new Route('GET', '/movies', 'Movie', 'showList'));

        Router::addRoute(new Route('GET', '/movies/{id:\d+}', 'Movie', 'showOne'));
    }

    function run() {

        list($name, $action) = Router::getController($this->req);

        if(!empty($name) && !empty($action)) {
            $class = 'App\Controllers\\' . $name . 'Controller';
            $ctrl = new $class($this->db, $this->layout);
            $ctrl->{$action}();
        } else {
            echo 'Page - 404';
        }
    }
}
