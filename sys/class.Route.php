<?php
// Router funkció
class Route {
    private $_url;
    function __construct() {
        if(isset($_GET['url'])) {
            $this->_url = 'contr/' . $_GET['url'] . '.php';
            include_once($this->_url);        
        }
        else {
            include_once('contr/home.php');
        }        
    }
    function fileError() {
        if((!empty($_GET['url'])) && (!file_exists($this->_url))) {
           include_once('contr/error.php');            
        }
    }
}