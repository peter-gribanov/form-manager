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

/**
 * Шаблонизатор
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Template {

	/**
	 * Название шаблона по умолчанию
	 * 
	 * @var string
	 */
	const DEFAULT_TEMPLATE = '.default'; // TODO протестировать на php 5.1

	/**
	 * Префикс для ключа языковых сообщений
	 * 
	 * @var string
	 */
	const MESSAGE_PREFIX = 'view:';


	/**
	 * Хелпер возвращающий языковое сообщение
	 * 
	 * @see FormManager_Language::getMessage()
	 * 
	 * @param string      $id     Идентификатор сообщения
	 * @param array       $params Параметры сообщения
	 * @param string|null $group  Имя группы сообщений
	 * 
	 * @return string
	 */
	public static function lang($id, array $params = array(), $group = null) {
		return FormManager_Language::getMessage(self::MESSAGE_PREFIX.$id, $params, $group);
	}

	/**
	 * Хелпер проверяющий и возвращающий путь к шаблону
	 * 
	 * @param string $path Путь к шаблону (dir/to/template.php)
	 * 
	 * @return string|boolean
	 */
	public static function path($path) {
		if (file_exists(FORM_MANAGER_TEMPLATES_PATH.$path)) {
			return $path;
		} else {
			// если выбранный шаблон не существует пытаемся получить путь в шаблоне по умолчанию
			$path = str_replace('\\', '/', substr($path, 1));
			if (strpos($path, '/') !== false) {
				list(, $path) = explode('/', $path, 2);
				return self::DEFAULT_TEMPLATE.$path;
			}
		}
		return false;
	}

	/**
	 * Хелпер включающий другой шаблон
	 * 
	 * @param string $template Адрес шаблона
	 * @param array  $vars     Переменные передаваемые в шаблон
	 */
	public static function inc($template, array $vars = array()) {
		extract($vars, EXTR_SKIP | EXTR_REFS);
		//$helper = $this;
		include FORM_MANAGER_TEMPLATES_PATH.self::path($template);
	}

	/**
	 * Хелпер включающий шаблон элемента формы
	 * 
	 * @param array $element Описание элемента формы
	 */
	public static function form(array $element) {
		if (isset($element['decorators']['template'])) {
			$element['element'] = $element;
			self::inc($element['decorators']['template'], $element);
		}
	}

}