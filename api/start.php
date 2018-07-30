<?php

use Restful\Config\Database;

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Category.php';

// Instantiate dbase
$database = new Database();
$db = $database->connect();