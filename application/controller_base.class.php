<?php
/**
 * 
 * Абстрактен клас за всеки контролер
 * 
 * Всеки контролер трябва да имплементира този клас
 * @author botzko
 *
 */
abstract class BaseController {
	/**
	 * 
	 * Registry обектът, който съхранява всички променливи
	 * нужни да бъдат достъпвани
	 * @var Registry
	 */
	protected $registry;

	/**
	 * 
	 * Създава обект от типа BaseController
	 * @param Registry $registry
	 */
	function __construct($registry) {
		$this->registry = $registry;
		
		//Добавяме телефона на обаждащия се
		$phone = isset($_GET['PhoneA'])?$_GET['PhoneA']:'';
		$this->registry->smarty->assign('__caller_phone__', $phone);
	}

	/**
	 * 
	 * Подразбиращият се медот, който се изпълнява
	 * ако изрично не е подаден друг метод
	 */
	abstract function index();
	
	/**
	 * 
	 * Показва избрания темплейт
	 * 
	 * По подразбиране $master_page = MASTER_PAGE 
	 * @param string $content_template
	 * @param string $master_page
	 * 
	 * @example $this->display('html/domain/index.tpl', '/html/master.tpl');
	 */
	public function display($content_template, $master_page = MASTER_PAGE) {
		$this->registry->smarty->assign('template', $content_template);
		$this->registry->smarty->display($master_page);
	}
	
	public function fetch($content_template, $master_page = MASTER_PAGE) {
		echo "========";
		$this->registry->smarty->assign('template', $content_template);
		return $this->registry->smarty->fetch($master_page);
	}
	
	public function commit() {
		$this->registry->db->commit();
	}
	
	public function rollBack() {
		$this->registry->db->rollBack();
	}
	
	protected function log($message, $type = 'default', $file = LOG_LOCATION) {
		Logger::getInstance()->log($message, $type, $file);
	} 
	
	
	/**
	 * 
	 * Преминаване към колоните на базата
	 * 
	 * Взима масив и премахва подаденият префикс от ключовете на масива.
	 * 
	 * Полетата започжащи с 'enable_' се пропускат
	 * @param array $data
	 * @param string $prefix
	 */
	public function toDBColumns($data, $prefix = '') {
		$tmp_client_data = array();
		foreach ($data as $key=>$value) {
			if (strpos($key, 'enable_') === 0) {
				//Пропускаме enable полетата
				continue;
			}
			$key = str_replace($prefix, '', $key);
			$tmp_client_data[$key] = $value;
		}
		return $tmp_client_data;
	}
	
	/**
	 * 
	 * Преминава към колоните на базата като генерира филтър за търсене
	 * @param array $data - данните, по които ще се прави филтъра
	 * @param string $prefix - '' ако няма такъв
	 * @param string $table - таблицата по която се филтрира. Методът се извиква толкова пъти
	 * колкото таблици ще се използват за филтриране, като за $filter се подава изходът от предходното
	 * извикване 
	 * @param array $filter - филтър който да се допълва
	 */
	public function searchDBCOlumns($data, $prefix = '', $table = false, $filter = false) {
		//Дефалтния филтър се слага тук, а не при дефинирането на функцията, защото може да се подаде праз филтър
		$filter = empty($filter)?(array('filter' => 'where 1=1 ', 'values' => array())):$filter;
		
		$table = ($table?$table . '.':'');
		
		foreach ($data as $key=>$value) {
			if ($value == '') {
				//Ако не е попълнено нищо продължаваме нататък
				continue;
			}
			//Минаваме към колоните на базата
			$key = str_replace($prefix, '', $key);
			$table_key = $table . $key;
			if (($value[0] == '%') || ($value[strlen($value) - 1] == '%')) {
				$filter['filter'] .= ' and ' . $table_key . ' like :' . $key . "\n";
			} else {
				$filter['filter'] .= ' and ' . $table_key . ' = :' . $key . "\n";
			}
			$filter['values'][$key] = $value;
		}
		
		return $filter;
	}
	
	/**
	 * 
	 * Взема стойността на даден ключ от изпратените данни
	 * @param string $key
	 * @param string $default_value
	 * @param string $method
	 * @return Ambigous <string, ''>
	 */
	protected function getValue($key, $default_value = '', $method = '_POST') {
		return array_key_exists($key, $GLOBALS[$method])?$GLOBALS[$method][$key]:$default_value;
	}
	
	protected function redirect($url, $js = false) {
		if ($js) {
			$this->registry->smarty->assign('url', $url);
			$this->display('javascript/redirect.tpl');
		} else {
			header('location: ' . $url);
		}
		
		exit();
	}
}