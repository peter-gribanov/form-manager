<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 98 $
 * @since     $Date: 2011-11-22 23:49:26 +0400 (Вт., 22 нояб. 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Фабрика элементов формы
 * 
 * @package FormManager\Element
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Element_Factory {

	/**
	 * Название шаблона
	 * 
	 * @var string
	 */
	private $template = FormManager_Template::DEFAULT_TEMPLATE;

	/**
	 * Фабрика
	 * 
	 * @var FormManager_Element_Factory|null
	 */
	private static $instance = null;


	/**
	 * Возвращает экзкмпляр фабрики
	 * 
	 * @return FormManager_Element_Factory
	 */
	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Устанавливает название группы шаблонов
	 * 
	 * @param string $template Название группы шаблонов
	 */
	public function setTemplate($template_group) {
		if (is_dir(FORM_MANAGER_TEMPLATES_PATH.'/'.$template_group.'/')) {
			$this->template = $template_group;
		}
	}

	/**
	 * Возвращает поле String
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $value Значение по умолчанию
	 * @param string|null $label Подпись элемента
	 * 
	 * @return FormManager_Field
	 */
	private function Field($name = null, $value = null, $label = null) {
		$field = new FormManager_Field($name, $value, $label);
		return $field->addDecorator('id', new FormManager_Decorator_ElementId('ele', '-'));
	}

	/**
	 * Возвращает поле String
	 * 
	 * @param string|null $name     Имя элемента
	 * @param array|null  $elements Список элементов
	 * @param string|null $value    Значение по умолчанию
	 * @param string|null $label    Подпись элемента
	 * 
	 * @return FormManager_Collection
	 */
	private function Collection($name = null, $elements = array(), $value = null, $label = null) {
		$collection = new FormManager_Collection($name, $elements, $value, $label);
		return $collection->addDecorator('id', new FormManager_Decorator_ElementId('ele', '-'));
	}

	/**
	 * Возвращает поле String
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $value Значение по умолчанию
	 * @param string|null $label Подпись элемента
	 * 
	 * @return FormManager_Element_String
	 */
	private function String($name = null, $value = null, $label = null){
		return $this
			->Field($name, $value, $label)
			->addFilter(new FormManager_Filter_ToString())
			->addDecorator('template', '/'.$this->skin.'/text/template.php');
	}

	/**
	 * Возвращает поле Select
	 * 
	 * @param string|null $name    Имя элемента
	 * @param string|null $value   Значение по умолчанию
	 * @param string|null $label   Подпись элемента
	 * @param array|null  $options Параметры выбора
	 * 
	 * @return FormManager_Element_Select
	 */
	public function Select($name = null, $value = null, $label = null, array $options = array()){
		return $this
			->String($name, $value)
			->addDecorator('label', $label)
			->addDecorator('options', $options)
			->addDecorator('template', '/'.$this->skin.'/form/select.tpl')
			->addFilter(new FormManager_Filter_NotNull())
			->addFilter(new FormManager_Filter_InArray(array_keys($options)));
	}

	/**
	 * Возвращает поле Text
	 * 
	 * @param string|null  $name   Имя элемента
	 * @param string|null  $value  Значение по умолчанию
	 * @param string|null  $label  Подпись элемента
	 * @param integer|null $maxlen Максимальная длинна
	 * @param integer|null $minlen Минимальная длинна
	 * 
	 * @return FormManager_Element_Text
	 */
	public function Text($name = null, $value = null, $label = null, $maxlen = 255, $minlen = 0){
		return $this
			->String($name, $value, $label)
			->addFilter(new FormManager_Filter_NotNull())
			->addFilter(new FormManager_Filter_String_Trim())
			->addFilter(new FormManager_Filter_String_Length($minlen, $maxlen));
	}

}