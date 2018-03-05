<?php
session_start();
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
error_reporting();
require_once('sys/class.Route.php');
$route = new Route;
$route->fileError();
unset($route);