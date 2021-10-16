<?php
/**
 * This class will register and validate routes
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
namespace APIBase\URL;

defined("ROUTE") || define("ROUTE", "route");
defined("METHOD") || define("METHOD", "method");
defined("HANDLER") || define("HANDLER", "handler");

class Router {
    public static $ROUTES = array();
    private function __construct() {}
    private static function getInstance(){
        return new self();
    }
    
    public static function registerRoutes($routePrefix = "", array $routes = array()) {
        $router = self::getInstance();
        $router->validateRoutes($routes);
        $router->makeHandlers($routePrefix, $routes);
    }
    private function validateRoutes($routes) {
        foreach($routes as $route){
            if(!isset($route[METHOD]) || empty($route[METHOD])){
                throw new \Exception("Undefined method!");
            } if(!isset($route[ROUTE]) || empty($route[ROUTE])){
                throw new \Exception("Undefined route!");
            } if(!isset($route[HANDLER]) || empty($route[HANDLER])){
                throw new \Exception("Undefined handler!");
            } if(!is_callable($route[HANDLER])){
                throw new \Exception("Non-invokable method!");
            }
        }
    }
    private function makeHandlers($routePrefix, $routes) {
        foreach($routes as $route) {
            $routeURI = sprintf("%s%s", $routePrefix, $route[ROUTE]);
            $routeMethod = $route[METHOD];
            if(!isset(self::$ROUTES[$routeURI])){
                self::$ROUTES[$routeURI] = array();
            }

            self::$ROUTES[$routeURI][$routeMethod] = $route[HANDLER];
        }
    }
}