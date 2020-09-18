<?php
session_start();

$siteName="HMI Courier";
if (isset($_SESSION['userId'])) {
	$userId= $_SESSION['userId'];
}

//Functions Including
$fdir = 'functions/';
$fscan = scandir($fdir);
foreach ($fscan as $function) {
	if ($function !='.' && $function !='..') {
		include_once($fdir.$function);
	}
}

//Models Including
$mdir = 'lib/';
$mscan = scandir($mdir);
foreach ($mscan as $model) {
	if ($model !='.' && $model !='..' && $model !='Controllers') {
		include_once($mdir.$model);
	}
}

//Controllers Including
$cdir = 'lib/Controllers/';
$cscan = scandir($cdir);
foreach ($cscan as $controller) {
	if ($controller !='.' && $controller !='..') {
		include_once($cdir.$controller);
	}
}

?>