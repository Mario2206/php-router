<?php
namespace Router;

class RouteManager {

    /*
     * STORE ALL ROUTERS
     * key : string $path
     * value : IERouter $router
     * */
    private $_routers = [];

    /*
     * STORE BASIC URL
     * */
    private $_url = "";

    public function __construct(string $url)
    {
        $this->_url = $url;
    }

    /*
     * FOR CREATING MAIN PATHS
     * @param string $mainPath
     * @param IERouter $router
     * */
    public function use (string $basePath, IERouter $router) {
        $this->_routers[] = [
            "router" =>$router,
            "basePath" =>$basePath
        ];
    }

    /*
     * PARSE AND CHOOSE CORRECT ROUTER ACCORDING THE BASEPATH
     * */
    public function parse() {

        foreach ($this->_routers as $route) {

            $match = explode($route["basePath"], $this->_url);

            if(count($match) === 2 && $match[0] === "") {
                $route["router"]->setUrl($match[1]);
                $route["router"]->parse();
                return;
            }
        }

        throw new \Exception("ERROR 404");

    }
}