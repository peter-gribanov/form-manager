<?php
require_once 'classes/Guepard_Form.php';

try {
	$gf = new Guepard_Form($params['form_name']);

	if ($parentComponent){
		$gf->setParentComponent($parentComponent);
	} else {
		$gf->valid();
		$gf->draw();
	}
} catch (Exception $e){
	exit($e->getMessage());
}
