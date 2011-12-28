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

	// TODO требуется реализация

	/**
	 * Устанавливает название шаблона
	 * 
	 * @throws FormManager_Exception
	 * 
	 * @param string $template Название шаблона
	 */
	public function setTemplate($template) {
		if (!is_string($template) || !trim($template)) {
			// TODO описать исключение
			throw new FormManager_Exception();
		}
		if (strpos($template, DIRECTORY_SEPARATOR) !== false) {
			// TODO описать исключение
			throw new FormManager_Exception();
		}
		if (!is_dir(FORM_MANAGER_PATH.'templates/'.$template)) {
			// TODO описать исключение
			throw new FormManager_Exception();
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
	 * Хелпер возвращающий абсолютный путь
	 * 
	 * @param string $path Путь отнасительно корня шаблона
	 * 
	 * @return string
	 */
	public function path($path) {
		return FORM_MANAGER_HTTP_PATH.'templates/'.$this->template.'/'.$path;
	}

	/**
	 * Рисует форму
	 * 
	 * @param FormManager_Model_Form $form Форма
	 */
	public function drow(FormManager_Model_Form $form) {
		// TODO требуется реализация
		$vars = $form->export();
		include $this->template.'template.php';
	}
}