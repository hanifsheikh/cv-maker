<?php

class Router
{
    private $controller = 'App\Controllers\HomeController';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        $this->parseUri();
    }

    private function parseUri()
    {
        if (isset(explode(APP_URL, trim("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", '/'))[1])) {
            $uri = explode(APP_URL, trim("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", '/'))[1];
            $request_uri = explode('/', trim($uri, '/'));
        } else {
            $request_uri = '';
        }
        // Controller
        if (!empty($request_uri[0])) {

            $controller = ucfirst($request_uri[0]) . 'Controller';
            unset($request_uri[0]);
            $controller = 'App\Controllers\\' . $controller;

            if (class_exists($controller)) {
                $this->controller = $controller;
            } else {
                abort('404');
            }
        }


        $class = $this->controller;
        $class = new $class;

        $params = null;

        // Method 
        if (isset($request_uri[1])) {
            $method = explode('?', $request_uri[1])[0];
            $params = isset(explode('?', $request_uri[1])[1]) ? explode('?', $request_uri[1])[1] : null;

            if (method_exists($class, $method)) {
                $this->method = $method;
            } else {
                return dd("Method not found!");
            }
        } else {
            if (!method_exists($class, $this->method)) {
                return dd("Method not found!");
            }
        }

        // Query Params 
        if (($params)) {
            parse_str($params, $queryString);
            $this->params = array_values($queryString);
        }

        // Call Controller Method Pass Params
        call_user_func_array([$class, $this->method], $this->params);
    }
}

new Router;
