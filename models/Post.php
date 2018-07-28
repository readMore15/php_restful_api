<?php

class Post{
	// DB
	private $conn;

	private $table = 'posts';

	//Post properties
	public $id;
	
	public $category_id;

	public $category_name;

	public $title;

	public $body;

	public $author;

	public $created_at;

	// dbase connect
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// get posts
	public function read()
	{
		$query = 'SELECT
					c.name as category_name,
					p.id,
					p.category_id,
					p.title,
					p.body,
					p.author,
					p.created_at
				FROM
					' . $this->table . ' p
				LEFT JOIN
					categories c ON p.category_id = c.id
				ORDER BY
					p.created_at DESC';

		// prepare query
		$stmt = $this->conn->prepare($query);

		// execute statement
		$stmt->execute();

		return $stmt;
	}

	// get single post
	public function single_post()
	{
		$query = 'SELECT
					c.name as category_name,
					p.id,
					p.category_id,
					p.title,
					p.body,
					p.author,
					p.created_at
				FROM
					' . $this->table . ' p
				LEFT JOIN
					categories c ON p.category_id = c.id
				WHERE
					p.id = ?
				LIMIT 0,1';

		//prepare query
		$stmt = $this->conn->prepare($query);

		// bind p.id to $this->id
		$stmt->bindParam(1, $this->id);

		//execute query
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		$this->title = $row['title'];
		$this->body = $row['body'];
		$this->author = $row['author'];
		$this->category_id = $row['category_id'];
		$this->category_name = $row['category_name'];
		$this->created_at = $row['created_at'];
	}

}