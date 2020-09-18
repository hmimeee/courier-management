<?php
namespace Model;

/**
 * 
 */
class Order extends Database
{	
	function __construct()
	{
		$this->table = 'orders';
		$this->userId = $_SESSION['userId'];
	}
}