<?php
namespace Router;

interface IERoute {
    public function getPath() : string;
    public function activate() : void;
}

class Route implements IERoute {

    /*
     * FUNCTIONAL PATH FOR STARTING ACTION
     * **/
    private $_path;

    /*
     * ACTION TO START
     * **/
    private $_action;

    /*
     * @param string $path
     * @param function $action
     * **/
    public function __construct(string $path, $action)
    {
        $this->_path = $path;
        $this->_action = $action;
    }

    /*
     *
     * FOR GETTING CURRENT PATH
     * return string
     */
    public function getPath() : string {
        return $this->_path;
    }

    /*
     *FOR STARTING CURRENT ACTION
     *
     */
    public function activate() : void{
        $this->_action->call($this);
    }



}