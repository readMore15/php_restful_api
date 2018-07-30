<?php

use Restful\Models\Category;

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/start.php';

// instantiate Category model
$category = new Category($db);
$result = $category->categories();

$num = $result->rowCount();

if( $num > 0 ){
	$posts_arr = array();
	$posts_arr['status'] = 'success';
	$posts_arr['data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$post_item = [
			'id'			=> $id,
			'name'			=> $name,
			'created_at'	=> $created_at
		];

		array_push($posts_arr['data'], $post_item);
	}

	echo json_encode($posts_arr);
}
else{
	echo json_encode(['status'=>'empty', 'message'=>'No category found']);
}