<?php


namespace Router;

interface IEDynamicRoute extends IERoute {
     public function transformDynamicPathToParams();
}

class DynamicRoute extends Route
{
    /*
     * SEPARATOR FOR DYNAMIC PATH
     * @string
     * */
    const DELIMITER = ":";

    /*
     * KEYS FROM DYNAMIC PATH
     * */
    private $keys = [];

    /*
     * STORE PARAMS FROM DYNAMIC PATH
     * **/
    private $params = [];

    public function __construct(string $path, $action)
    {
        $parts = explode("/".self::DELIMITER, $path);

        parent::__construct(array_shift($parts), $action);

        array_map(function ($v) {
            $this->keys[]= $v;
        }, $parts);

    }

    /*
     * GET ALL DYNAMIC DATA
     * return array $dynamicData
     * **/
    public function getParams () : array{
        return $this->params;
    }

    /*
     * TRANSFORM DYNAMIC STRING PATH TO USEFUL VARIABLES IN THE ARRAY OF DYNAMIC DATA
     * @param string $path
     *
     * return true if all variables have value, otherwise return false
     * **/
    public function transformDynamicPathToParams (string $dynamicPath) {
        $params = explode("/", $dynamicPath);

        $params = array_values(array_filter($params,function ($v){return $v ? true : false;}));

        if(count($params) !== count($this->keys)) {
            return false;
        }

        for($i = 0, $c = count($params), $k = count($this->keys); $i < $c && $i < $k ; $i++) {

            $this->params[] = $params[$i];
        }

        return true;
    }

    public function activate(): void
    {
        call_user_func_array( $this->_action , $this->params ) ;
    }


}