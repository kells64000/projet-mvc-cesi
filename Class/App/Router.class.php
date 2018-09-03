<?php

namespace App;

use App\Net\HTTPRequest;

class Route {

    private $name;
    private $method;
    private $uri;
    private $controller;
    private $action;
    private $pattern;

    public function __construct(string $n, string $m, string $u, string $c, string $a) {
        $this->name = $n;
        $this->method = $m;
        $this->uri = trim($u, '/');
        $this->controller = $c;
        $this->action = $a;
        $this->pattern = preg_replace('@/\{(\w+):([\[\]\w\+\*\\\]*)\}/?@', '/(?<$1>$2)/?', $this->uri);
    }

    public function match(HTTPRequest $req) : bool {
        if ($this->method !== $req->method())
            return false;

        if ($this->uri === $req->uri())
            return true;

        if (!empty($this->uri)) {
            preg_match('@^'.$this->pattern.'$@', $req->uri(), $match);

            if (count($match) > 0) {
                $this->storeParameters($match);

                return true;
            }
        }
        return false;
    }

    private function storeParameters($match) : void
    {

        foreach ($match as $key => $value) {

            if (is_string($key)) $_GET[$key] = $value;
        }
    }


    public function getController() : string {

        return $this->controller;
    }


    public function getAction() : string {

        return $this->action;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getUri($hostIncluded = false) : string {
        return ($hostIncluded ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' : '') . $this->uri;
    }
}



class Router {

    private static $routes;

    public static function addRoute(Route $route) : void {

        self::$routes[] = $route;
    }

    public static function getController(HTTPRequest $req) : array {

        foreach (self::$routes as $route) {

            if ($route->match($req)) {

                return [$route->getController(), $route->getAction()];
            }
        }

        return [null, null];
    }

    public static function getByName(string $name) : Route {
        foreach (self::$routes as $route) {
            if ($route->getName() === $name) {
                return $route;
            }
        }

        return null;
    }
}