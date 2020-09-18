<?php
namespace Model;

/**
 * 
 */
class Invoice extends Database
{	
	function __construct()
	{
		$this->table = 'invoice';
		$this->userId = $_SESSION['userId'];
	}
}