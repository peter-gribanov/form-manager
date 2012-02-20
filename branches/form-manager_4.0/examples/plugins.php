<?php
include('../init.php');

echo 'Is installed';
p(FormManager_Plugins::isInstalled('Test'));

echo 'Install';
p(FormManager_Plugins::install('Test'));

echo 'Is installed<br />';
echo 'Use of plug-in can be on the next request';
p(FormManager_Plugins::isInstalled('Test'));

// return list of all installed elements
echo 'List of installed';
p(FormManager_Plugins::getListOfInstalled());

echo 'Uninstall';
p(FormManager_Plugins::uninstall('Test'));

echo 'Is installed';
p(FormManager_Plugins::isInstalled('Test'));

echo 'Install all filters<br />';

installFilters(FORM_MANAGER_PATH.'/FormManager/Filter/');


/**
 * Install all filters
 * 
 * @param string $dir The path to the directory with the filters
 */
function installFilters($dir, $subdir = '') {
	$exception =  array('.', '..', 'Abstract.php', 'Interface.php', 'Factory.php', 'Builder.php');
	foreach (scandir($dir.$subdir) as $item) {
		if (in_array($item, $exception)) {
			continue;

		} elseif (is_file($dir.$subdir.$item)) {
			$filter = str_replace('/', '_', $subdir).pathinfo($item, PATHINFO_FILENAME);
			echo 'Instal filter '.$filter.'<br />';
			FormManager_Plugins_Filter::install($filter);

		} elseif (is_dir($dir.$subdir.$item)) {
			installFilters($dir, $subdir.$item.'/');
		}
	}
}