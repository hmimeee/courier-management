<?php
namespace Model;

/**
 * 
 */
class User extends Database
{	
	function __construct()
	{
		$this->table = 'users';
	}
}