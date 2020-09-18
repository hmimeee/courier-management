<?php

use Model\Request;
use Model\Status;

/**
 * 
 */
class StatusController extends Status
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