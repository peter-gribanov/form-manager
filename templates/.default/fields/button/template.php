<?
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
?><button<?=
($params['type'] ? ' type="'.$params['type'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?><?=
($params['name'] ? ' name="'.$params['name'].'"' : '')?><?=
($params['value'] ? ' value="'.$params['value'].'"' : '')?>><?=$title?></button>