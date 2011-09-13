<?php
require_once 'Form.php';
require_once 'FormStore.php';
require_once 'FormDBDriverGuepard.php';
require_once ROOT.G_ROOT.'modules/form/classes/FormComplex.php';

// устанавливается драйвер для работы формы с БД
FormDB::setDBDriver(new FormDBDriverGuepard());

/**
 * Enter description here ...
 * 
 * @author gribape
 */
class Guepard_Form {

	private $form;


	public function __construct($form_name){
		$this->form = FormStore::load($form_name);
	}

	public function setParentComponent(FormComplex $component){
		$component->setForm($this->form);
	}

	public function valid(){
		if ($this->form->isAlreadySent()){
			try {
				$this->form->valid();
				echo '<p><strong>Форма заполнена правильно.</strong></p>';
			} catch (FormFilterException $e){
				echo '<p><strong>Ошибка: '.$e->getMessage().'</strong></p>';
			}
		}
	}

	public function draw(){
		$this->form->draw();
	}

}