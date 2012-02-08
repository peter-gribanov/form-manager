<?php
include('../init.php');

// return true
p(FormManager_Plugins::install('test'));

// return true
p(FormManager_Plugins::isInstalled('test'));

// return list of all installed elements
p(FormManager_Plugins::getListOfInstalled());

// return true
p(FormManager_Plugins::uninstall('test'));
