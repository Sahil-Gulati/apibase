<?php
namespace APIBase\URL;
/**
 * This class will handle URL related functionality
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
class Invoker {
    private function __construct() {}
    private static function getInstance(){
        return new self();
    }
    public static function processRequest(){
        $invoker = self::getInstance();
        $invoker->validateRequest();
        $invoker->makeVariables();
        $invoker->invoke();
    }
    
    public function validateRequest() {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = $_SERVER["SCRIPT_URI"];
        if(!isset(\APIBase\URL\Router::$ROUTES[$uri])){
            throw new \APIBase\Exceptions\HTTPException("File not found!", 404);
        } if(!isset(\APIBase\URL\Router::$ROUTES[$uri][$method])){
            throw new \APIBase\Exceptions\HTTPException("Method not allowed!", 405);
        }
    }
    public function makeVariables() {
        \APIBase\Parameters::setPageVariables();
    }
    public function invoke() {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = $_SERVER["SCRIPT_URI"];
        call_user_func(\APIBase\URL\Router::$ROUTES[$uri][$method]);
    }
}