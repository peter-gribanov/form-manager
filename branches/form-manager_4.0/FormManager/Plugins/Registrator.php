<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 210 $
 * @since     $Date: 2012-01-18 21:47:57 +0400 (Wed, 18 Jan 2012) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Инструмент для регистрации плагинов в фабриках и строителях
 * 
 * @package FormManager\Plugins
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Plugins_Registrator {

	/**
	 * Проверяет корректность имени
	 * 
	 * @param string $plugin Имя плагина
	 * 
	 * @return boolean
	 */
	public function isValidName($plugin) {
		/**
		 * Списка зарезервированных слов PHP
		 * 
		 * @see http://php.net/manual/ru/reserved.php
		 */
		$reserved_keywords = array(
			'abstract', 'and', 'array', 'as', 'break', 'case', 'catch', 'class', 'clone', 'const',
			'continue', 'declare', 'default', 'do', 'else', 'elseif', 'enddeclare', 'endfor',
			'endforeach', 'endif', 'endswitch', 'endwhile', 'extends', 'final', 'for', 'foreach',
			'function', 'global', 'goto', 'if', 'implements', 'interface', 'instanceof', 'namespace',
			'new', 'or', 'private', 'protected', 'public', 'static', 'switch', 'throw', 'try', 'use',
			'var', 'while', 'xor', 'die', 'echo', 'empty', 'exit', 'eval', 'include', 'include_once',
			'isset', 'list', 'require', 'require_once', 'return', 'print', 'unset',
			'factory', 'builder' // дополнительнные слова
		);
		$plugin = strtolower($plugin);

		// проверка валидности имени фильтра
		return (
			!in_array($plugin, $reserved_keywords) &&    // зарезервированное имя
			substr($plugin, 0, 2) != '__' &&             // магический метод
			preg_match('/^[a-z_][a-z0-9_]*$/i', $plugin) // недопустимое имя метода
		);
	}

	/**
	 * Регестрирует плагин в фабрике
	 * 
	 * @param string $type   Тип element|filter
	 * @param string $plugin Имя компонента
	 * 
	 * @return boolean
	 */
	public function register($type, $plugin) {
		$type = strtolower($type);
		if (!in_array($type, array('element','filter'))) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}
		$type = ucfirst($type);
		$plugin = ucfirst($plugin);

		// запись в фабрику
		$code = file_get_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Factory.php');
		// очищаем мусор который мог случайно попасть и дописываем в конце новый метод
		$code  = preg_replace('/\s*\}\s*(\?>)?\s*$/', '', $code);
		$code .= $this->getMethodForFactory($type, $plugin)."\r\n\r\n}";
		file_put_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Factory.php',	$code);

		// запись в строителя
		$code = file_get_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Builder.php');
		// очищаем мусор который мог случайно попасть и дописываем в конце новый метод
		$code  = preg_replace('/\s*\}\s*(\?>)?\s*$/', '', $code);
		$code .= $this->getMethodForBuilder($type, $plugin)."\r\n\r\n}";
		file_put_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Builder.php',	$code);
		return true;
	}

	/**
	 * Удаляет плагин из фабрике
	 * 
	 * @param string $type   Тип element|filter
	 * @param string $plugin  Имя компонента
	 * 
	 * @return boolean
	 */
	public function unregister($type, $plugin) {
		$type = strtolower($type);
		if (!in_array($type, array('element','filter'))) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}
		$type = ucfirst($type);
		$plugin = ucfirst($plugin);

		$code = file_get_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Factory.php');
		// удаляем метод установленный этим же методом
		$code = str_replace($this->getMethodForFactory($type, $plugin), '', $code);
		// если код метода или конструктора были изменены то предыдущий вариант не сработает
		// поэтому удаляем его через регулярное выражение
		// правда при таком удалении остается комментарий от метода
		$code = preg_replace('/\s*public\h+function\h+'.$plugin.'\h*\(.*?\}/is', '', $code);
		file_put_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Factory.php', $code);

		// повторяем туже операцию для строителя

		$code = file_get_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Builder.php');
		// удаляем метод установленный этим же методом
		$code = str_replace($this->getMethodForBuilder($type, $plugin), '', $code);
		// удаляем метод через регулярное выражение
		$code = preg_replace('/\s*public\h+function\h+'.$plugin.'\h*\(.*?\}/is', '', $code);
		file_put_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Builder.php', $code);
		return true;
	}

	/**
	 * Возвращает описание плагина
	 * 
	 * @param string $plugin_class_name Имя класса плагина
	 * 
	 * @return array
	 */
	private function getPluginInfo($plugin_class_name) {
		// получаем информацию об плагине через рефлексию
		$ref = new ReflectionClass($plugin_class_name);
		if (!$ref->isInstantiable()) {
			throw new FormManager_Exceptions_Logic('Плагин не может быть инициалезирован'); // TODO описать исключение
		}
		// получаем заголовок элимента
		$title = '';
		$comment = $ref->getDocComment();
		if ($comment && preg_match('/\/\*\*?\s*\*\s*([\wa-яё\h]*)/i', $comment, $mat)) {
			$title = $mat[1];
		}
		// конструктор
		$cons = $ref->getConstructor();
		// получаем описание параметров в комментариях
		$comments = array();
		$comment = $cons->getDocComment();
		if ($comment && preg_match_all('/(@param[\W\w]*?\v)/ui', $comment, $mat)) {
			$comments = array_map('trim', $mat[1]);
		}
		// получаем описание параметров как атрибутов методов и имена параметров
		$ads   = array();
		$names = array();
		foreach ($cons->getParameters() as $param) {
			$str  = $param->isArray() ? 'array ' : '';
			$str .= $param->getClass() ? $param->getClass()->getName().' ' : '';
			$str .= $param->isPassedByReference() ? '&' : '';
			$str .= '$'.$param->getName();
			if ($param->isOptional()) {
				$value = var_export($param->getDefaultValue(), true);
				$str .= ' = '.str_replace(array("\n","\r","\t"), '', $value);
			}
			$ads[]   = $str;
			$names[] = '$'.$param->getName();
		}
		return array(
			'title'    => $title,
			'comments' => $comments,
			'ads'      => $ads,
			'names'    => $names
		);
	}

	/**
	 * Возвращает код описывающий метод для инициализации плагина в фабрике
	 * 
	 * @param string $type   Тип фабрики element|filter
	 * @param string $plugin Название плагина
	 * 
	 * @return string
	 */
	private function getMethodForFactory($type, $plugin) {
		$info = $this->getPluginInfo('FormManager_'.$type.'_'.$plugin);

		// сборка кода описывающего метод
		$code = "\r\n\r\n";
		$code .= "\t/**\r\n";
		$code .= "\t * ".$info['title']."\r\n";
		$code .= "\t * \r\n";
		foreach ($info['comments'] as $comment) {
			$code .= "\t * ".$comment."\r\n";
		}
		$code .= "\t * \r\n";
		$code .= "\t * @return FormManager_".$type."_".$plugin."\r\n";
		$code .= "\t */\r\n";
		$code .= "\t public function ".$plugin."(".implode(', ', $info['ads']).") {\r\n";
		$code .= "\t\treturn new FormManager_".$type."_".$plugin."(".implode(', ', $info['names']).");\r\n";
		$code .= "\t }";

		return $code;
	}

	/**
	 * Возвращает код описывающий метод для инициализации плагина в фабрике
	 * 
	 * @param string $type   Тип фабрики element|filter
	 * @param string $plugin Название плагина
	 * 
	 * @return string
	 */
	private function getMethodForBuilder($type, $plugin) {
		$info = $this->getPluginInfo('FormManager_'.$type.'_'.$plugin);

		// сборка кода описывающего метод
		$code = "\r\n\r\n";
		$code .= "\t/**\r\n";
		$code .= "\t * ".$info['title']."\r\n";
		$code .= "\t * \r\n";
		foreach ($info['comments'] as $comment) {
			$code .= "\t * ".$comment."\r\n";
		}
		$code .= "\t * \r\n";
		$code .= "\t * @return FormManager_".$type."_Builder\r\n";
		$code .= "\t */\r\n";
		$code .= "\t public function ".$plugin."(".implode(', ', $info['ads']).") {\r\n";
		$code .= "\t\t\$this->collection->addChild(\$this->factory->".$plugin."(".implode(', ', $info['names'])."));\r\n";
		$code .= "\t\treturn \$this;\r\n";
		$code .= "\t }";

		return $code;
	}

}