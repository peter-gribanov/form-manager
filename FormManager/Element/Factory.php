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
	 * Фабрика фильтров
	 * 
	 * @var FormManager_Filter_Factory
	 */
	private $filter_factory = null;


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
	 * Конструктор
	 */
	public function __construct() {
		$this->filter_factory = new FormManager_Filter_Factory();
	}

	/**
	 * Возвращает фабрику фильтров
	 * 
	 * @return FormManager_Filter_Factory
	 */
	public function Filters() {
		return $this->filter_factory;
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
	 * Возвращает декаратор Id элемента
	 * 
	 * @return FormManager_Decorator_ElementId
	 */
	protected function DecoratorId() {
		return new FormManager_Decorator_ElementId('ele', '-');
	}

	/**
	 * Возвращает поле String
	 * 
	 * {
	 *  name:string,
	 *  filters:{...}|FormManager_Element_Interface,
	 *  children:{...}|FormManager_Filter_Interface,
	 *  id:string|FormManager_Decorator_Interface,
	 * }
	 * 
	 * @return FormManager_Element_Field
	 */
	protected function Field($name = null, $value = null, $label = null) {
		$field = new FormManager_Element_Field($name, $value, $label);
		return $field
			->addDecorator('id', $this->DecoratorId())
			->addFilters()
				->NotNull()
				->apply();
	}

	/**
	 * Возвращает поле String
	 * 
	 * Поддерживает следующие значения:
	 * {
	 *  name:string|null Имя элимента
	 *  filters:[{...}|FormManager_Filter_Interface] Список фильтров
	 *  children:[{...}|FormManager_Filter_Interface] Список дочерних элиментов
	 *  id:string|FormManager_Decorator_Interface Id элимента
	 * }
	 * 
	 * @param array|null $params Параметры элемента
	 * 
	 * @return FormManager_Collection
	 */
	protected function Collection(array $params = array()) {
		$params = array_merge(array(
			'children' => array(),
			'filters'  => array($this->Filters()->NotNull()),
			'id'       => $this->DecoratorId()
		), $params);
		$params['children'] = (array)$params['children'];
		foreach ($params['children'] as &$child) {
			$child = $this->assign($child);
		}
		$params['filters'] = (array)$params['filters'];
		foreach ($params['filters'] as &$filter) {
			$filter = $this->Filters()->assign($filter);
		}
		$collection = new FormManager_Collection($params);
		return $collection->addDecorator('id', $params['id']);
	}

	/**
	 * Возвращает поле String
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $value Значение по умолчанию
	 * @param string|null $label Подпись элемента
	 * 
	 * @return FormManager_Element_Field
	 */
	private function ElementString($name = null, $value = null, $label = null){
		return $this
			->Field($name, $value, $label)
			->addDecorator('template', '/'.$this->template.'/text/template.php')
			->addFilters()
				->ToString()
				->apply();
	}

	/**
	 * Возвращает поле String
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $value Значение по умолчанию
	 * @param string|null $label Подпись элемента
	 * 
	 * @return FormManager_Element_Field
	 */
	private function ElementInteger($name = null, $value = null, $label = null){
		return $this
			->Field($name, $value, $label)
			->addDecorator('template', '/'.$this->template.'/text/template.php')
			->addFilters()
				->ToInteger()
				->apply();
	}

	/**
	 * Возвращает поле Boolean
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $value Значение по умолчанию
	 * @param string|null $label Подпись элемента
	 * 
	 * @return FormManager_Element_Field
	 */
	private function ElementBoolean($name = null, $value = null, $label = null){
		return $this
			->Field($name, $value, $label)
			->addDecorator('template', '/'.$this->template.'/text/template.php')
			->addFilters()
				->ToBoolean()
				->apply();
	}

	/**
	 * Возвращает поле Float
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $value Значение по умолчанию
	 * @param string|null $label Подпись элемента
	 * 
	 * @return FormManager_Element_Field
	 */
	private function ElementFloat($name = null, $value = null, $label = null){
		return $this
			->Field($name, $value, $label)
			->addDecorator('template', '/'.$this->template.'/text/template.php')
			->addFilters()
				->ToFloat()
				->apply();
	}

	/**
	 * Возвращает поле Select
	 * 
	 * @param string|null $name    Имя элемента
	 * @param string|null $value   Значение по умолчанию
	 * @param string|null $label   Подпись элемента
	 * @param array|null  $options Параметры выбора
	 * 
	 * @return FormManager_Element_Field
	 */
	public function Select($name = null, $value = null, $label = null, array $options = array()){
		return $this
			->ElementString($name, $value)
			->addDecorator('label', $label)
			->addDecorator('options', $options)
			->addDecorator('template', '/'.$this->template.'/select/template.php')
			->addFilters()
				->InArray(array_keys($options))
				->apply();
	}

	/**
	 * Выбор дня
	 * 
	 * @param array|null $params Параметры элемента
	 * 
	 * @return FormManager_Element_Select
	 */
	public function SelectDay(array $params = array()){
		$params['options'] = array_combine($renge = range(1, 31), $renge);
		return $this->Select($params);
	}

	/**
	 * Выбор даты
	 * 
	 * Поддерживает следующие значения:
	 * {
	 *  name:string|null Имя элимента
	 *  label:string|null Метка
	 *  filters:[{...}|FormManager_Filter_Interface] Список фильтров
	 *  value:{day:integer|null,month:integer|null,year:integer|null} Значения по умолчанию
	 *  template:string|null Шаблон элимента
	 * }
	 * 
	 * @param array|null $params Параметры элемента
	 * 
	 * @return FormManager_Collection
	 */
	public function DateRow(array $params = array()){
		$params = array_merge(array(
			'filters' => array($this->Filters()->DateRow()),
			'value'   => array(
				'day'   => null,
				'month' => null,
				'year'  => null
			),
			'children' => array()
		), $params);
		$params['children'] = array(
			$this->SelectDay(array(
				'name'  => 'day',
				'value' => $params['value']['day'],
				'label' => 'День'
			)),
			$this->SelectMonth(array(
				'name'  => 'month',
				'value' => $params['value']['month'],
				'label' => 'Месяц'
			)),
			$this->SelectYear(array(
				'name'  => 'year',
				'value' => $params['value']['year'],
				'label' => 'Год'
			)),
		);
		unset($params['value'], $params['children']);
		return $this->Tray($params);
	}

	/**
	 * Возвращает поле Text
	 * 
	 * Поддерживает следующие значения:
	 * {
	 *  name:string|null Имя элимента
	 *  label:string|null Метка
	 *  filters:[{...}|FormManager_Filter_Interface] Список фильтров
	 *  value:string|null Значения по умолчанию
	 *  template:string|null Шаблон элимента
	 *  length:{max:integer|null,min:integer|null}|null Длинна значения
	 * }
	 * 
	 * @param array|null $params Параметры элемента
	 * 
	 * @return FormManager_Element_Text
	 */
	public function Text(array $params = array()){
		$params = array_merge(array(
			'label'    => null,
			'template' => 'text.tpl',
			'length'   => array('max' => 255, 'min' => 0),
			'filters'  => array($this->Filters()->String_Trim())
		), $params);
		$el = new FormManager_Element_Text($params);
		return $el->setLength($params['length']['min'], $params['length']['max']);
	}

	/**
	 * Возвращает группу элементов вида FieldSet
	 * 
	 * Поддерживает следующие значения:
	 * {
	 *  name:string|null Имя элимента
	 *  label:string|null Метка
	 *  filters:[{...}|FormManager_Filter_Interface] Список фильтров
	 *  children:[{...}|FormManager_Filter_Interface] Список дочерних элиментов
	 *  template:string|null Шаблон элимента
	 * }
	 * 
	 * @param array|null $params Параметры элемента
	 * 
	 * @return FormManager_Collection
	 */
	public function FieldSet(array $params = array()) {
		$params = array_merge(array(
			'label'    => null,
			'template' => 'fieldset.tpl',
		), $params);
		return $this->Collection($params)
			->addDecorator('label', $params['label'])
			->addDecorator('template', $params['template']);
	}

	/**
	 * Возвращает группу элементов вида Tray
	 * 
	 * Поддерживает следующие значения:
	 * {
	 *  name:string|null Имя элимента
	 *  label:string|null Метка
	 *  filters:[{...}|FormManager_Filter_Interface] Список фильтров
	 *  children:[{...}|FormManager_Filter_Interface] Список дочерних элиментов
	 *  template:string|null Шаблон элимента
	 * }
	 * 
	 * @param array|null $params Параметры элемента
	 * 
	 * @return FormManager_Collection
	 */
	public function Tray(array $params = array()) {
		$params = array_merge(array(
			'label'    => null,
			'template' => 'tray.tpl',
		), $params);
		return $this->Collection($params)
			->addDecorator('label', $params['label'])
			->addDecorator('template', $params['template']);
	}

	/**
	 * Строит при необходимости элимент и возвращает его
	 * 
	 * @throws FormManager_Exception
	 * 
	 * @param array|FormManager_Element_Interface $params Описание элимента или элимент
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function assign($params) {
		if ($params instanceof FormManager_Element_Interface) {
			return $params;
		}
		if (!is_array($params) || empty($params['element'])) {
			throw new FormManager_Exception('Не указан тип элимента');
		}
		if (!method_exists($this, $params['element'])) {
			throw new FormManager_Exception('Неизвестный элимент');
		}
		$element = $params['element'];
		return $this->$element($params);
	}

}