<?php

use Model\Request;
use Model\OrderAdmin;

/**
 * 
 */
class OrderAdminController extends OrderAdmin
{	
	function __construct()
	{
		parent::__construct();
	}

	//Get all data
	public function index()
	{
		$orders = $this->all();
		return $orders;
	}

	//Get custom data
	public function get($key, $value)
	{
		return $this->where($key, $value);
	}

	//Get details
	public function view($id)
	{
		$this->data = $this->find($id);
		return $this->data;
	}

	//Add new
	public function store($request)
	{
		return $this->oder = $this->add($request);
	}

	//Update data
	public function update($request, $id)
	{
		return $this->change($request, $id);
	}

	//Delete data
	public function destroy($id)
	{
		$this->delete($id);
		return true;
	}
}