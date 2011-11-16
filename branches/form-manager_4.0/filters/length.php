<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision$
 * @since     $Date$
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

$params = array_merge(array(
	'min'	=> 0,
	'max'	=> 0,
	'eq'	=> 0
), $params);

$len = strlen($this->getValue());

if ( $params['min'] && $params['max'] && $params['min'] == $params['max'] ) {
	$params['eq'] = $params['max'];
}
	
if ( $params['eq'] && $len != $params['eq'] ) {
	$this->error('length.eq', array($params['eq']));
} elseif ( $params['min'] && $params['max'] && ($len < $params['min'] || $len > $params['max']) ) {
	$this->error('length', array($params['min'], $params['max']));
} elseif ( $params['min'] && $len < $params['min'] ) {
	$this->error('length.min', array($params['min']));
} elseif ( $params['max'] && $len > $params['max'] ) {
	$this->error('length.max', array($params['max']));
}