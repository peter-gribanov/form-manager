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
?><img src="<?=G_ROOT?>components/guepard/form/images/captcha/captcha.jpg?<?=
($params['width'] ? 'w='.$params['width'].'&' : '')?><?=
($params['height'] ? 'h='.$params['height'].'&' : '')?><?=
($params['length'] ? 'l='.$params['length'].'&' : '')?>_=<?=time()?>" class="form-captcha-image" alt="" />