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
     * STORE GET ROUTES
     * **/
    private $_get = [];

    /*
     * STORE POST ROUTES
     * */
    private $_post = [];

    /*
     * STORE DELETE ROUTES
     * */
    private $_delete = [];

    /*
     * STORE PUT ROUTES
     * */
    private $_put = [];


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
        $this->_get[] = new Route($path, $action);
    }

    /*
     * CATCH HTTP POST REQUEST
     * **/
    public function post (string $path, $action) : void {
        $this->_post[] = new Route($path, $action);
    }

    /*
     * CATCH HTTP DELETE REQUEST
     * **/
    public function delete () {}

    /*
     *CATCH PUT REQUEST
     *  **/
    public function update () {}

    /*
     * FOR PARSING URL AND USING CORRECT FUNCTION
     * **/
    public function parse () {

        $all = [
            self::HTTP_GET => $this->_get,
            self::HTTP_POST => $this->_post,
            self::HTTP_PUT => $this->_put,
            self::HTTP_DELETE => $this->_delete
        ];

        $httpMethod = $_SERVER["REQUEST_METHOD"];

        $currentRoute = array_filter($all[$httpMethod], function (IERoute $value) {
            if($value->getPath() == $this->_url) {
                return true;
            }
            return false;
        });

        $responseLength = count($currentRoute);

        if($responseLength > 1) {
            throw new \Exception("Many path are the same");
            return;
        }
        else if ($responseLength === 0) {
            throw new \Exception("404 ERROR");
            return;
        }

        array_values($currentRoute)[0]->activate();
    }
}