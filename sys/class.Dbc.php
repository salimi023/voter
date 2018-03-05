<?php
final class Dbc {
    public $dbc = null;
    public function __construct() {
        require_once('config.php');
        try {
        $this->dbc = new PDO($dns, $user, $pass);
        $this->dbc->exec("SET CHARACTER SET UTF8");
        $this->dbc->exec("SET NAMES UTF8");
        return $this->dbc;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}