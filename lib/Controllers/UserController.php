<?php

use Model\User;
use Model\Request;

/**
 * 
 */
class UserController extends User
{	
	function __construct()
	{
		$this->connect = User::connect();
		parent::__construct();
	}

	//Regster new user
	public function register($request)
	{
		$request = new Request($request);

		if (!filter_var($request->email, FILTER_VALIDATE_EMAIL) && $request->name !="" && $request->password !="") {
			return message(0, "Please fill all the field properly!");
		} else {
			$this->query = "INSERT INTO $this->table (name, email, password, role) VALUES ('$request->name', '$request->email', '$request->password', 'marchant')";
			$this->result = mysqli_query($this->connect, $this->query);

			if ($this->result) {
				return message(1,'Registration successful, please login now!');
			} else {
				return message(0,"Failed to register: ".mysqli_error($this->connect));
			}
		}
	}


	//Login to a user
	public function login($request)
	{
		$request = new Request($request);
		$this->query = "SELECT * FROM $this->table WHERE email='$request->email' AND password='$request->password'";
		$this->result = mysqli_query($this->connect, $this->query);

		if (mysqli_num_rows($this->result) > 0) {
			$this->data = mysqli_fetch_assoc($this->result);
			$userData = new Request($this->data);
			return $userData;
		} else {
			return 0;
		}
	}

	//Get user details
	public function view($id)
	{
		$this->data = $this->find($id);
		return $this->data;
	}

	//Update user data
	public function update($request, $id)
	{
		$request = new Request($request);
		if ($this->find($id)['role'] =='admin' && $request->role !='admin' && $this->where('role','admin')->num_rows < 2) {
				return 0;
			} else {
				return $this->change($request, $id);
			}
	}

	//Delete user data
	public function destroy($id)
	{
		if ($this->find($id)['role'] !='admin') {
			$this->delete($id);
			return true;
		} else {
			return false;
		}
	}
}