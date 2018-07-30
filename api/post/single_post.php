<?php

use Restful\Models\Post;

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/start.php';

// Instantiate Blog Post object
$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// get post
$post->single_post();

// create array
$post_arr = [
	'id'			=> $post->id,
	'title'			=> $post->title,
	'body'			=> html_entity_decode($post->body),
	'author'		=> $post->author,
	'category_id'	=> $post->category_id,
	'category_name'	=> $post->category_name,
	'created_at'	=> $post->created_at
];

// make JSON
print_r(json_encode($post_arr));