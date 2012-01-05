<?php
	require_once HTDOCS . '/model/customer_type.model.php';
	require_once HTDOCS . '/model/package.model.php';
	require_once HTDOCS . '/model/package_option.model.php';
	require_once HTDOCS . '/model/contract.model.php';
	require_once HTDOCS . '/model/contract_service.model.php';
	require_once HTDOCS . '/functions/num2bgmoney.php';
	require_once HTDOCS . '/functions/functions.php';
	
	class ContractController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			$tmp_cust_type = new CustomerTypeModel();
			$this->registry->smarty->assign('customer_types', $tmp_cust_type->fetchAll());
			$this->registry->smarty->assign('contracts', array());
			
			
			parent::display('html/contract/index.tpl');
		}
		
		function results() {
			$tmp_cust_type = new CustomerTypeModel();
			$this->registry->smarty->assign('customer_types', $tmp_cust_type->fetchAll());
			
			$tmp_contract = new ContractModel();
			$filter = createFilter($_POST, array('customer_type_id', 'create_date', 'start_date', 'customer_name', 'customer_id', 'customer_address', 'contact_person', 'contact_phone'));
			if ($this->registry->user->group_id != 1) {
				$filter['filter'] .= ' and user_id = :user_id';
				$filter['values']['user_id'] = $this->registry->user->id;
			}
			
			$this->registry->smarty->assign('contracts', $tmp_contract->fetchAll($filter));
			
			parent::display('html/contract/index.tpl');
		}
		
		private function setData($customer_type) {
			$this->registry->smarty->assign('current_date', date('d.m.Y'));
			$this->registry->smarty->assign('current_date_js_format', date('Y,m-1,d'));
			$this->registry->smarty->assign('start_date', $this->getValue('start_date', date('d.m.Y', time() + 60*60*24)));
			$this->registry->smarty->assign('customer_name', $this->getValue('customer_name', 'Марин Петров'));
			$this->registry->smarty->assign('customer_id', $this->getValue('customer_id', '12987381'));
			$this->registry->smarty->assign('customer_personal_id', $this->getValue('customer_personal_id', '29389887'));
			$this->registry->smarty->assign('customer_personal_id_date', $this->getValue('customer_personal_id_date', '25.10.2005'));
			$this->registry->smarty->assign('custeomr_personal_id_issuer', $this->getValue('custeomr_personal_id_issuer', 'Хасково'));
			$this->registry->smarty->assign('mrp', $this->getValue('mrp', 'Марин Калинков'));
			$this->registry->smarty->assign('customer_address', $this->getValue('customer_address', 'София Подуево 11В'));
			$this->registry->smarty->assign('contact_address', $this->getValue('contact_address', 'София Подуево 11В'));
			$this->registry->smarty->assign('contact_person', $this->getValue('contact_person', 'Марин Петров'));
			$this->registry->smarty->assign('contact_phone', $this->getValue('contact_phone', '02/927837'));
			$this->registry->smarty->assign('default_insured_count', 1);

// 			$this->registry->smarty->assign('current_date', date('d.m.Y'));
// 			$this->registry->smarty->assign('current_date_js_format', date('Y,m-1,d'));
// 			$this->registry->smarty->assign('start_date', $this->getValue('start_date', date('d.m.Y', time() + 60*60*24)));
// 			$this->registry->smarty->assign('customer_name', $this->getValue('customer_name'));
// 			$this->registry->smarty->assign('customer_id', $this->getValue('customer_id'));
// 			$this->registry->smarty->assign('customer_personal_id', $this->getValue('customer_personal_id'));
// 			$this->registry->smarty->assign('customer_personal_id_date', $this->getValue('customer_personal_id_date'));
// 			$this->registry->smarty->assign('custeomr_personal_id_issuer', $this->getValue('custeomr_personal_id_issuer'));
// 			$this->registry->smarty->assign('mrp', $this->getValue('mrp'));
// 			$this->registry->smarty->assign('customer_address', $this->getValue('customer_address'));
// 			$this->registry->smarty->assign('contact_address', $this->getValue('contact_address'));
// 			$this->registry->smarty->assign('contact_person', $this->getValue('contact_person'));
// 			$this->registry->smarty->assign('contact_phone', $this->getValue('contact_phone'));
// 			if ($customer_type == 1) {
// 				$this->registry->smarty->assign('default_insured_count', 1);
// 			} else {
// 				$this->registry->smarty->assign('default_insured_count', 5);
// 			}
			
// 			$tmp_package = new PackageModel();
// 			$this->registry->smarty->assign('packages', $tmp_package->fetchAll());
			
			$packages = array();
			$tmp_paclage_option = new PackageOptionModel();
			$package_options = $tmp_paclage_option->fetchAll(array('filter' => ' where customer_type_id = :customer_type_id', 'values' => array('customer_type_id' => $customer_type)));
			foreach($package_options as $package_option) {
				$package_option->getOption();
				$package_option->getPackage();
				if (!array_key_exists($package_option->package->id, $packages)) {
					$packages[$package_option->package->id] = $package_option->package;
				}
			}
			$this->registry->smarty->assign('packages', $packages);
			$this->registry->smarty->assign('package_options', $package_options);
		}
		
		function personal() {
			$this->setData(1);
			
			parent::display('html/contract/personal.tpl');
		}
		
		function add_personal() {
			$contract = new ContractModel();
			$contract->setRequiredFields(array('customer_type_id', 'start_date', 'customer_name', 'customer_id', 'customer_personal_id', 'customer_personal_id_date', 'custeomr_personal_id_issuer', 'customer_address', 'contact_address', 'contact_person', 'contact_phone', 'payments_count', 'contract'));
			$_POST['customer_type_id'] = '1';
			$_POST['contract'] = 'Нов договор';
			$_POST['user_id'] = $this->registry->user->id;
			$id = $contract->insert($_POST);
			
			if (is_array($id)) {
				foreach ($id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('contract_error', 'Не са попълнени всички задължителни полета!!!');
				}
				
				$this->personal();
				return false;
			}
			
			if (empty($id)) {
				$this->registry->smarty->assign('contract_error', 'Грешка при добавянето на договора!!!');
				$this->personal();
				return false;
			}
			
			$contract->setPrimaryValue($id);
			
			$this->addServices($contract);
		}
		
		
		
		function company() {
			$this->setData(2);
			
			parent::display('html/contract/company.tpl');
		}
		
		function add_company() {
			$contract = new ContractModel();
			$contract->setRequiredFields(array('customer_type_id', 'start_date', 'customer_name', 'customer_id', 'mrp', 'customer_address', 'contact_address', 'contact_person', 'contact_phone', 'payments_count', 'contract'));
			$_POST['customer_type_id'] = '2';
			$_POST['contract'] = 'Нов договор';
			$_POST['user_id'] = $this->registry->user->id;
			$id = $contract->insert($_POST);
				
			if (is_array($id)) {
				foreach ($id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('contract_error', 'Не са попълнени всички задължителни полета!!!');
				}
			
				$this->personal();
				return false;
			}
				
			if (empty($id)) {
				$this->registry->smarty->assign('contract_error', 'Грешка при добавянето на договора!!!');
				$this->personal();
				return false;
			}
				
			$contract->setPrimaryValue($id);
			
			$this->addServices($contract);
		}
		
		private function addServices($contract) {
			$id = $contract->id;
			
			$tmp_package_option = new PackageOptionModel();
			$contract_service = new ContractServiceModel();
			$amount = 0;
			$insured = 0;
			foreach($_POST['insured_count'] as $key=>$value) {
				$insured += $_POST['insured_count'][$key];
				$tmp_contract_service = array('contract_id' => $id, 'insured_count' => $_POST['insured_count'][$key], 'package_id' => $_POST['package_id'][$key], 'option_id' => $_POST['option_id'][$key]);
				$package_option = $tmp_package_option->fetchAll(array('filter' => ' where package_id = :package_id and option_id = :option_id', 'values' => array('package_id' => $_POST['package_id'][$key], 'option_id' => $_POST['option_id'][$key])));
				if (empty($package_option)) {
					$services = array();
					foreach($_POST['insured_count'] as $local_key=>$value) {
						$tmp_service = new stdClass();
						$tmp_service->insured_count = $_POST['insured_count'][$local_key];
						$tmp_service->package_id = $_POST['package_id'][$local_key];
						$tmp_service->option_id = $_POST['option_id'][$local_key];
						if ($key == $local_key) {
							$tmp_service->error = 'Не е намерена комбинацията Пакет-“Опция!!!';
						}
						$services[] = $tmp_service;
					}
						
					$this->registry->smarty->assign('services', $services);
						
					$this->personal();
					return false;
				}
				$package_option = $package_option[0];
				$tmp_contract_service['package_option_id'] = $package_option->id;
				$tmp_contract_service['price'] = $package_option->price;
				$tmp_contract_service['amount'] = $tmp_contract_service['price'] * $tmp_contract_service['insured_count'];
				$amount += $tmp_contract_service['amount'];
			
				$contract_service_id = $contract_service->insert($tmp_contract_service);
				if (is_array($contract_service_id)) {
					$services = array();
					foreach($_POST['insured_count'] as $local_key=>$value) {
						$tmp_service = new stdClass();
						$tmp_service->insured_count = $_POST['insured_count'][$local_key];
						$tmp_service->package_id = $_POST['package_id'][$local_key];
						$tmp_service->option_id = $_POST['option_id'][$local_key];
						if ($key == $local_key) {
							$tmp_service->error = 'Всички полета за групата са задължителни!!!';
						}
						$services[] = $tmp_service;
					}
						
					print_r($services);
			
					$this->registry->smarty->assign('services', $services);
			
					$this->personal();
					return false;
				}
			}
			
			$_GET['contract_id'] = $id;
			$_GET['print'] = 1;
			$contract->update(array('insured' => $insured, 'total_amount' => $amount, 'contract' => $this->view_contract(false)));
				
			$this->redirect(WWW . 'contract/view_contract/?contract_id=' . $id);
		}
		
		function view_contract($view = true) {
			$id = $this->getValue('contract_id', false, '_GET');
			if (empty($id)) {
				$this->index();
				return false;
			}
			
			$contract = new ContractModel($id);
			$contract->fetch();
			if ($this->registry->user->group_id != 1) {
				if ($contract->user_id != $this->registry->user->id) {
					$this->index();
					return false;
				}
			}
			$contract->getPayments();
			$contract->getEndDate();
			$contract->priceToString();
			$contract->getServices();
			
			$this->registry->smarty->assign('contract', $contract);
			
			$master_page = MASTER_PAGE;
			if (!empty($_GET['print'])) $master_page = 'html/print.tpl';
			
			if ($view) {
				if ($contract->customer_type_id == 1) {
					$this->display('html/contract/personal_contract.tpl', $master_page);
				} else {
					$this->display('html/contract/company_contract.tpl', $master_page);
				}
			} else {
				if ($contract->customer_type_id == 1) {
					return $this->fetch('html/contract/personal_contract.tpl', $master_page);
				} else {
					return $this->fetch('html/contract/company_contract.tpl', $master_page);
				}
			}
		}
		
		function view_invoice() {
			$id = $this->getValue('contract_id', false, '_GET');
			if (empty($id)) {
				$this->index();
				return false;
			}
				
			$contract = new ContractModel($id);
			$contract->fetch();
			$contract->getPayments();
			$contract->getEndDate();
			$contract->priceToString();
			$contract->getServices();
				
			$this->registry->smarty->assign('contract', $contract);
				
			$master_page = MASTER_PAGE;
			if (!empty($_GET['print'])) $master_page = 'html/print.tpl';
				
			if ($contract->customer_type_id == 1) {
				$this->display('html/contract/invoice.tpl', $master_page);
			} else {
				$this->display('html/contract/invoice.tpl', $master_page);
			}
		}
	}