<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Category.php';

$database = new Database();
$db = $database->connect();

// instantiate Category model
$category = new Category($db);

$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category->category();

// create array
$post_arr = [
	'id'			=> $category->id,
	'name'			=> $category->name,
	'created_at'	=> $category->created_at
];

// make JSON
print_r(json_encode($post_arr));