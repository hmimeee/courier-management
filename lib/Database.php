<?php
namespace Model;
/**
 * 
 */
class Database
{
	function __construct()
	{
		
	}

	public function connect()
	{
		$this->db_host = 'localhost';
		$this->db_user = 'root';
		$this->db_pass = '';
		$this->db_name = 'courier';

		$this->connect = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
		if ($this->connect->connect_error) {
			echo "Connection failed: " . $this->connect->connect_error;
		} else {
			return $this->connect;
		}
	}

	//Insert data into a table
	public function add($request)
	{
		$this->data = new Request($request);
		$this->values = "'". implode("','", $this->data->values())."'";
		$this->keys = implode(',', $this->data->keys());
		$this->query = "INSERT INTO $this->table ($this->keys) VALUES ($this->values)";
		$this->result = mysqli_query($this->connect(), $this->query);
		return $this->result;
	}

	//Update data in a table
	public function change($request, $id)
	{
		$this->data = new Request($request);
		$this->values = $this->data->values();
		$this->keys = $this->data->keys();
		$this->combine = '';
		for ($i=0; $i < count($this->keys); $i++) { 
			$this->combine .= $this->keys[$i]."='".$this->values[$i]."',";
		}
		$this->combine = rtrim($this->combine, ',');
		if (isset($this->userId)) {
			echo $this->query = "UPDATE $this->table SET $this->combine WHERE id=$id AND user_id='$this->userId'";
		} else {
			$this->query = "UPDATE $this->table SET $this->combine WHERE id=$id";
		}
		$this->result = mysqli_query($this->connect(), $this->query);
		return $this->result;
	}

	//Get all data from a table
	public function all($limit = null)
	{
		if ($limit !=null) {
			if (isset($this->userId)) {
				$this->query = "SELECT * FROM $this->table WHERE user_id='$this->userId' LIMIT 10";
			} else {
				$this->query = "SELECT * FROM $this->table LIMIT 10";
			}

		} else {
			if (isset($this->userId)) {
			$this->query = "SELECT * FROM $this->table WHERE user_id='$this->userId'";
		} else {
			$this->query = "SELECT * FROM $this->table";
		}
		}
		$this->result = mysqli_query($this->connect(), $this->query);
		return $this->result;
	}

	//Get a row data from a table
	public function find($id)
	{
		if (isset($this->userId)) {
			$this->query = "SELECT * FROM $this->table WHERE id=$id AND user_id='$this->userId'";
		} else {
			$this->query = "SELECT * FROM $this->table WHERE id=$id";
		}
		$this->result = mysqli_query($this->connect(), $this->query);
		$this->result = mysqli_fetch_assoc($this->result);
		return $this->result;
	}

	//Delete a row from a table
	public function delete($id)
	{
		if (isset($this->userId)) {
			$this->query = "DELETE FROM $this->table WHERE id=$id AND user_id='$this->userId'";
		} else {
			$this->query = "DELETE FROM $this->table WHERE id=$id";

			$this->result = mysqli_query($this->connect(), $this->query);
		}
	}

	//Where function in database
		public function where($key, $value)
		{
			if (isset($this->userId)) {
				$this->query = "SELECT * FROM $this->table WHERE $key='$value' AND user_id='$this->userId'";
			} else {
				$this->query = "SELECT * FROM $this->table WHERE $key='$value'";
			}
			$this->result = mysqli_query($this->connect(), $this->query);
			return $this->result;
		}
	}