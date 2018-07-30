<?php

class Category
{
	// DB properties
	private $conn;

	private $table = 'categories';

	// category properties
	public $id;

	public $name;

	public $created_at;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function categories()
	{
		$query = 'SELECT * FROM ' . $this->table;

		// prepare query
		$stmt = $this->conn->prepare($query);

		// execute query
		$stmt->execute();

		return $stmt;
	}

	public function category()
	{
		$query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id', $this->id);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		$this->name = $row['name'];
		$this->created_at = $row['created_at'];
	}

	public function create()
	{
		$query = 'INSERT INTO ' . $this->table . ' SET name = :name';

		$stmt = $this->conn->prepare($query);

		// clean data
		$this->name = htmlspecialchars(strip_tags($this->name));

		$stmt->bindParam(':name', $this->name);

		//execute query
		if($stmt->execute()){
			return true;
		}

		// print error if something goes wrong
		printf("Error: %s.\n", $stmt->error);

		return false;
	}

	public function delete()
	{
		$query = 'DELETE FROM ' . $this->table .' WHERE id = :id';

		$stmt = $this->conn->prepare($query);

		$this->id = htmlspecialchars(strip_tags($this->id));
		$stmt->bindParam(':id', $this->id);

		//execute query
		if($stmt->execute()){
			return true;
		}

		// print error if something goes wrong
		printf("Error: %s.\n", $stmt->error);

		return false;
	}
}