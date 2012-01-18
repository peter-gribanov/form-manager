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
class FormManager_Viwe {

	/**
	 * Название шаблона
	 * 
	 * @var string
	 */
	private $template = self::DEFAULT_TEMPLATE;


	/**
	 * Название шаблона по умолчанию
	 * 
	 * @var string
	 */
	const DEFAULT_TEMPLATE = '.default';

	/**
	 * Устанавливает название шаблона
	 * 
	 * @throws FormManager_Exceptions_InvalidArgument
	 * 
	 * @param string $template Название шаблона
	 */
	public function setTemplate($template) {
		if (!is_string($template) || !trim($template)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}
		if (strpos($template, DIRECTORY_SEPARATOR) !== false) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}
		if (!is_dir(FORM_MANAGER_PATH.'templates/'.$template)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}
		$this->template = $template;
	}

	/**
	 * Хелпер возвращающий языковое сообщение
	 * 
	 * @see FormManager_Language::getMessage()
	 * 
	 * @param string $id     Id сообщения
	 * @param array  $params Параметры сообщения
	 * 
	 * @return string
	 */
	public function lang($id, array $params = array()) {
		return FormManager_Language::getMessage($id, $params);
	}

	/**
	 * Хелпер возвращающий абсолютный HTTP путь
	 * 
	 * @param string $path Путь отнасительно корня шаблона
	 * 
	 * @return string
	 */
	public function path($path) {
		if (file_exists(FORM_MANAGER_PATH.'templates/'.$this->template.$path)) {
			return FORM_MANAGER_HTTP_PATH.'templates/'.$this->template.$path;
		}
		return FORM_MANAGER_HTTP_PATH.'templates/'.self::DEFAULT_TEMPLATE.'/'.$path;
	}

	/**
	 * Хелпер включающий шаблон поля
	 * 
	 * @param string $type Название поля
	 * @param array  $vars Переменные передаваемые в шаблон
	 */
	public function field($type, array $vars = array()) {
		$this->inc('fields/'.$type.'/template.php', $vars);
	}

	/**
	 * Хелпер включающий шаблон колекции
	 * 
	 * @param string $type Название колекции
	 * @param array  $vars Переменные передаваемые в шаблон
	 */
	public function collection($type, array $vars = array()) {
		$this->inc('collections/'.$type.'/template.php', $vars);
	}

	/**
	 * Хелпер включающий другой шаблон
	 * 
	 * @param string $template Адрес шаблона
	 * @param array  $vars     Переменные передаваемые в шаблон
	 */
	public function inc($template, array $vars = array()) {
		extract($vars, EXTR_SKIP | EXTR_REFS);
		include $this->getLocalPath($template);
	}

	/**
	 * Возвращающий абсолютный путь
	 * 
	 * @throws FormManager_Exceptions_InvalidArgument
	 * 
	 * @param string $path Путь отнасительно корня шаблона
	 * 
	 * @return string
	 */
	private function getLocalPath($path) {
		if (!is_string($path) || !trim($path)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}
		if (file_exists(FORM_MANAGER_PATH.'templates/'.$this->template.'/'.$path)) {
			return FORM_MANAGER_PATH.'templates/'.$this->template.'/'.$path;
		}
		return FORM_MANAGER_PATH.'templates/'.self::DEFAULT_TEMPLATE.'/'.$path;
	}

	/**
	 * Рисует форму
	 * 
	 * @param FormManager_Form $form Форма
	 */
	public function drow(FormManager_Form $form) {
		$this->inc('template.php', $form->export());
	}
}