<?php
namespace Router;

class Router {

    const HTTP_GET = "GET";
    const HTTP_POST = "POST";
    const HTTP_DELETE = "DELETE";
    const HTTP_PUT = "PUT";

    /*
     * CURRENT URL
     * **/
    private $_url;
    /*
     * FOR STORING ALL ROUTES
     * */
    private $store = [
        self::HTTP_GET => [],
        self::HTTP_POST => [],
        self::HTTP_DELETE => [],
        self::HTTP_PUT => []
    ];


    public function __construct( string $url )
    {
        $this->_url = $url;
    }

    /*
     * CATCH HTTP GET REQUEST
     * @param string $path
     * @param function $action
     * **/
    public function get (string $path, $action) : void {
        $this->createRoute(self::HTTP_GET,$path, $action);
    }

    /*
     * CATCH HTTP POST REQUEST
     * **/
    public function post (string $path, $action) : void {
        $this->createRoute(self::HTTP_POST, $path, $action);
    }

    /*
     * CATCH HTTP DELETE REQUEST
     * **/
    public function delete (string $path, $action) {
        $this->createRoute(self::HTTP_DELETE, $path, $action);
    }

    /*
     *CATCH PUT REQUEST
     *  **/
    public function update (string $path, $action) {
        $this->createRoute(self::HTTP_PUT, $path, $action);
    }

    private function createRoute( string $method, string $path, $action) {

        $parts = explode(DynamicRoute::DELIMITER, $path);

        if(count($parts) > 1) {
            $this->store[$method][] = new DynamicRoute($path, $action);
        }
        else
        {
            $this->store[$method][] = new Route($path, $action);
        }
    }

    /*
     * FOR PARSING URL AND USING CORRECT FUNCTION
     * **/
    public function parse () {

        $httpMethod = $_SERVER["REQUEST_METHOD"];

        $currentRoute = $this->parseRoutes($this->store[$httpMethod]);

        if (!$currentRoute) {
            throw new \Exception("404 ERROR");
            return;
        }

        $currentRoute->activate();
    }

    /*
     * FOR PARSING ROUTES COLLECTION
     * **/
    private function parseRoutes($routeCollection)   {

        $currentRoute = null;
        $dynamicPath = null;

        foreach ($routeCollection as $route) {

            $path = $route->getPath();
            $find = explode($path, $this->_url);

            if(count($find) === 2) {
                $currentRoute = $route;
                $dynamicPath = $find[1];
                break;
            }
        }

        if(!$currentRoute) {
            return null;
        }

        //TEMPORARY
        if(method_exists($currentRoute,"transformDynamicPathToParams")) {

            $state = $currentRoute->transformDynamicPathToParams($dynamicPath);

            return $state ? $currentRoute : null;
        }

        return $currentRoute;
    }
}