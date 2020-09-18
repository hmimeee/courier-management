<?php
namespace Model;

/**
 * 
 */
class Store extends Database
{	
	function __construct()
	{
		$this->table = 'stores';
		$this->userId = $_SESSION['userId'];
	}
}