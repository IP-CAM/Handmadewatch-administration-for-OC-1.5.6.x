<?php
class ControllerModuleTimer extends Controller {
	private $error = array(); 

	public function index() {   
		$this->load->model('catalog/timer');
		$this->load->language('module/timer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->data['text_quantity'] = $this->language->get('text_quantity');
		$this->data['text_timer'] = $this->language->get('text_timer');
		$this->data['text_total_discount'] = $this->language->get('text_total_discount');
		$this->data['text_date_start'] = $this->language->get('text_date_start');
		$this->data['text_date_end'] = $this->language->get('text_date_end');
		$this->data['text_max_products'] = $this->language->get('text_max_products');
		$this->data['text_delete_all'] = $this->language->get('text_delete_all');
		$this->data['text_customer_group'] = $this->language->get('text_customer_group');
		$this->data['text_no_spec_products'] = $this->language->get('text_no_spec_products');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');


		$this->data['text_all_spec_prods'] = $this->language->get('text_all_spec_prods');
		$this->data['text_sp_id'] = $this->language->get('text_sp_id');
		$this->data['text_sp_name_prod'] = $this->language->get('text_sp_name_prod');
		$this->data['text_sp_old_prices'] = $this->language->get('text_sp_old_prices');
		$this->data['text_sp_new_price'] = $this->language->get('text_sp_new_price');
		$this->data['text_sp_date_start'] = $this->language->get('text_sp_date_start');
		$this->data['text_sp_date_end'] = $this->language->get('text_sp_date_end');
		$this->data['text_sp_timer'] = $this->language->get('text_sp_timer');
		$this->data['text_sp_cust_group'] = $this->language->get('text_sp_cust_group');

		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$all_products = array();
		$all_products_s = array();
		$aCleanProd = array();
		$aCleanProdSpec = array();
		$timer = array();
		$prices = array();
		$success_id = array();

		$all_products = $this->model_catalog_timer->getProductsByStatus();
		$all_products_s = $this->model_catalog_timer->getAllProductsSpecialsId();

		$this->load->model('sale/customer_group');		
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		$this->data['allproducts'] = $this->model_catalog_timer->getAllProductsSpecials();

		//  Loop for check all_products in product_special
		if(count($all_products) > 0){
			if(count($all_products_s)>0){
				for($i=0;$i<count($all_products_s);$i++){
					$aCleanProdSpec[] = $all_products_s[$i]['product_id'];
				}

				for($i=0;$i<count($all_products);$i++){
					if(!in_array($all_products[$i]["product_id"], $aCleanProdSpec)){
						$aCleanProd[] = array(
							'product_id' => (int)$all_products[$i]["product_id"],
							'price'		 => (float)$all_products[$i]["price"]
						);
					}
				}

				$this->data['max_products'] = count($aCleanProd);
			
			} else {
				for($i=0;$i<count($all_products);$i++){
					$aCleanProd[] = array(
						'product_id' => (int)$all_products[$i]["product_id"],
						'price'		 => $all_products[$i]["price"]
					);
				}

				$this->data['max_products'] = count($all_products);
			}

			shuffle($aCleanProd);
		
		} else {
				$this->data['max_products'] = 0;
		}

		if (isset($this->request->post['timer']) && $this->validate()) {
			$this->data['timer'] = $this->request->post['timer'];
			$timer = $this->request->post['timer'];
			$timer['products'] = (int)$timer['products'];
		} else {
			$this->data['timer'] = array();
			$timer = NULL;
		}

		if($this->validate()){
			if(isset($timer['products']) && $timer['products'] != NULL){
				if($timer['total-discount'] == NULL OR $timer['total-discount'] <= 0.0 OR $timer['total-discount'] >= 100.0){
						$timer['total-discount'] = 1;
				}

				if($timer['date_start'] == "0000-00-00" OR $timer['date_start']== 0  OR $timer['date_start'] == NULL){
					$timer['date_start'] = date('Y-m-d');
				}

				if(!isset($timer['date_end']) OR $timer['date_end'] == NULL){
					$timer['date_end'] = date('(Y+1)-m-d');
				}

				if(!isset($timer['timer']) OR $timer['timer'] == NULL){
					$timer['timer'] = 0;
				} else {
					$timer['timer'] = 1;		
				}
				
				if(!isset($timer['customer_group_id']) OR $timer['customer_group_id'] == NULL){
					$timer['customer_group_id'] = 0;
				}

				if($timer['products'] > 0){
					$data = array(
						'date_start'		=> $timer['date_start'],
						'date_end'			=> $timer['date_end'],
						'timer'				=> $timer['timer'],
						'customer_group_id' => $timer['customer_group_id'],
						'priority'			=> 1
						);
				
				// Change prices
					for($i=0;$i<$timer['products'];$i++){
						$price = 0.0;
						$price = ((100 - ($timer['total-discount'])) / 100)  * $aCleanProd[$i]['price'];

						$success_id[$aCleanProd[$i]['product_id']] = $this->model_catalog_timer->AddNewProductSpecial($aCleanProd[$i]['product_id'], $price, $data);
					}
				}
			}
		}

		if(isset($timer['delete'])){
				$this->model_catalog_timer->DeleteAllProductsSpecials();
		}

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('timer', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
  		'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('text_module'),
		'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
  		'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('module/timer', 'token=' . $this->session->data['token'], 'SSL'),
  		'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('module/timer', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();

		if (isset($this->request->post['timer_module'])) {
			$this->data['modules'] = $this->request->post['timer_module'];
		} elseif ($this->config->get('timer_module')) { 
			$this->data['modules'] = $this->config->get('timer_module');
		}				
		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/timer.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);				

		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		$this->data['errors'] = false;

		if (isset($this->request->post['timer']['products']) && $this->request->post['timer']['products'] >  $this->data['max_products']) {
			$this->data['errors']['error_products'] = $this->language->get('error_products');
		}
		
		if (!$this->data['errors']) {
			return true;
		} else {
			return false;
		}	
	}
}
?>