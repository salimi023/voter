<?php
// Setting deafult timezone
$timezone = 'Europe/Budapest';
date_default_timezone_set($timezone);

// Database connection (PDO)
$dns = 'mysql:dbname=voter;host=localhost';
$user = 'root';
$pass = '';

// Base URL
$baseurl = 'http://localhost/voter/';