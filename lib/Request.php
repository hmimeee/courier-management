<?php

namespace Model;

/**
 * 
 */
class Request
{
	function __construct($request)
	{
		$this->request = $request;
		foreach ($request as $key => $value) {
			$this->$key = $value;
		}
	}

	public function keys()
	{
		return array_keys($this->request);
	}

	public function values()
	{
		return array_values($this->request);
	}
}

?>