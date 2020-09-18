<?php
namespace Model;

/**
 * 
 */
class OrderAdmin extends Database
{	
	function __construct()
	{
		$this->table = 'orders';
	}
}