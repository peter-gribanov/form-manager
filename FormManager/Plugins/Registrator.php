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

		// получаем информацию об плагине через рефлексию
		$ref = new ReflectionClass('FormManager_'.$type.'_'.$plugin);
		if (!$ref->isInstantiable()) {
			throw new FormManager_Exceptions_Logic(); // TODO описать исключение
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
		$params['comment'] = array();
		$comment = $cons->getDocComment();
		if ($comment && preg_match_all('/(@param[\W\w]*?\v)/ui', $comment, $mat)) {
			$params['comment'] = array_map('trim', $mat[1]);
		}
		// получаем описание параметров как атрибутов методов и имена параметров
		$params['init'] = array();
		$params['name'] = array();
		foreach ($cons->getParameters() as $param) {
			$str  = $param->isArray() ? 'array ' : '';
			$str .= $param->isPassedByReference() ? '&' : '';
			$str .= '$'.$param->getName();
			if ($param->isOptional()) {
				$str .= ' = '.str_replace(array("\n","\r"), '', var_export($param->getDefaultValue(), true));
			}
			$params['init'][] = $str;
			$params['name'][] = '$'.$param->getName();
		}
		unset($ref);

		// сборка кода описывающего метод
		// комментарии общие для всех
		$factory = $builder = "\r\n\r\n";
		$factory = $builder .= "\t/**\r\n";
		$factory = $builder .= "\t * ".$title."\r\n";
		$factory = $builder .= "\t * \r\n";
		foreach ($params['comment'] as $comment) {
			$factory = $builder .= "\t * ".$comment."\r\n";
		}
		$factory = $builder .= "\t * \r\n";

		// код метода в фабрике
		$factory .= "\t * @return FormManager_".$type."_".$plugin."\r\n";
		$factory .= "\t */\r\n";
		$factory .= "\t public function ".$plugin."(".implode(', ', $params['init'])."){\r\n";
		$factory .= "\t\treturn new FormManager_".$type."_".$plugin."(".implode(', ', $params['name']).");\r\n";
		$factory .= "\t }\r\n\r\n}";

		// код метода в строителе
		// отличается возвращаемым классом в коментарии и телом метода 
		$builder .= "\t * @return FormManager_".$type."_Builder\r\n";
		$builder .= "\t */\r\n";
		$builder .= "\t public function ".$plugin."(".implode(', ', $params['init'])."){\r\n";
		$builder .= "\t\t\$this->collection->addChild(\$this->factory->".$plugin."(".implode(', ', $params['name'])."));\r\n";
		$builder .= "\t\treturn \$this;\r\n";
		$builder .= "\t }\r\n\r\n}";

		// запись в фабрику
		$code = file_get_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Factory.php');
		// очищаем мусор который мог случайно попасть и дописываем в конце новый метод
		$code = preg_replace('/\s*\}\s*(\?>)?\s*$/', $factory, $code);
		file_put_contents(FORM_MANAGER_PATH.'/tmp_factory.php',	$code);

		// запись в строителя
		$code = trim(file_get_contents(FORM_MANAGER_PATH.'/FormManager/'.$type.'/Builder.php'));
		// очищаем мусор который мог случайно попасть и дописываем в конце новый метод
		$code = preg_replace('/\s*\}\s*(\?>)?\s*$/', $builder, $code);
		file_put_contents(FORM_MANAGER_PATH.'/tmp_builder.php',	$code);
		return true;
	}

	/**
	 * Удаляет плагин из фабрике
	 * 
	 * @param string $factory Имя фабрики
	 * @param string $plugin  Имя компонента
	 * 
	 * @return boolean
	 */
	public function unregister($factory, $plugin) {
		// TODO требуется реализация
		return true;
	}

}