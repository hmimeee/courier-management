<?php

function message($type, $message)
{
	if ($type ==1) {
		return "<div class='alert alert-success text-center' style='margin-top: 40px;'>$message</div>";
	} else {
		return "<div class='alert alert-danger text-center' style='margin-top: 40px;'>$message</div>";
	}
}