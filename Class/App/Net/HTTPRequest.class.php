<?php

namespace App\Net;

class HTTPRequest {

    private $uri;
    private $json = false;
    private $method, $accept, $referer, $contentType;


    public function __construct() {

        $this->uri = $_SERVER['REQUEST_URI'];
        $this->uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $this->uri);
        $this->uri = preg_replace('#.html?#', '', $this->uri);
        $this->uri = trim($this->uri, '/');
        $this->referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
        $this->accept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : null;
        $this->contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : null;
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;
        $this->json = (bool) $this->contentType === 'application/json';

        $this->readInputs();

    }


    public function method() {

        return $this->method;

    }

    public function accept() {

        return $this->accept;

    }

    public function referer() {

        return $this->referer;

    }

    public function uri() {

        return $this->uri;

    }

    private function readInputs() {

        $input = file_get_contents("php://input");

        switch($this->method) {

            case "POST":

            case "PUT":

                if ($this->json)

                    $_POST = json_decode($input, true);

                else {

                    parse_str($input, $input);

                    $_POST = $this->cleanInputs($input);
                }

                break;

            case "GET":

            case "DELETE":

                $_GET = $this->cleanInputs($_GET);

                break;

        }

    }

    private function cleanInputs($data){

        $clean_input = array();

        if(is_array($data)){

            foreach($data as $k => $v){

                $clean_input[$k] = $this->cleanInputs($v);

            }

        }else{

            if(get_magic_quotes_gpc()){

                $data = trim(stripslashes($data));

            }

            $data = strip_tags($data);

            $clean_input = trim($data);

        }

        return $clean_input;

    }

}