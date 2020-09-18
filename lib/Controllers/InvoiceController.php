<?php

use Model\Request;
use Model\Invoice;

/**
 * 
 */
class InvoiceController extends Invoice
{	
	function __construct()
	{
		parent::__construct();
	}

	//Get all stores
	public function index()
	{
		$stores = $this->all();
		return $stores;
	}

	//Get user details
	public function view($id)
	{
		$this->data = $this->find($id);
		return $this->data;
	}

	//Add new store
	public function store($request)
	{
		return $this->store = $this->add($request);
	}

	//Update user data
	public function update($request, $id)
	{
		return $this->change($request, $id);
	}

	//Delete store data
	public function destroy($id)
	{
		$this->delete($id);
		return true;
	}
}