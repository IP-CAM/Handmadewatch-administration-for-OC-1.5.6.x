<?php
class ControllerTicketConfig extends Controller {
	private $error = array();
 
	public function index() {
		$this->load->language('ticket/ticket');

		$this->document->setTitle($this->language->get('heading_title_config'));
		
		$this->load->model('ticket/ticket');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_ticket_ticket->editConfig($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success_config');
						
			$this->redirect($this->url->link('ticket/config', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	private function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title_config');
		
		$this->data['entry_order'] = $this->language->get('entry_order');
		$this->data['entry_status_disable'] = $this->language->get('entry_status_disable');
		$this->data['entry_status_enable'] = $this->language->get('entry_status_enable');
		$this->data['entry_required'] = $this->language->get('entry_required');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title_config'),
			'href'      => $this->url->link('ticket/config', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
			
		$this->data['action'] = $this->url->link('ticket/config', 'token=' . $this->session->data['token'], 'SSL');
    	$this->data['cancel'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'], 'SSL');

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$config_info = $this->model_ticket_ticket->getConfig();
		}

		if (isset($this->request->post['order_status'])) {
			$this->data['order_status'] = $this->request->post['order_status'];
		} elseif (!empty($config_info)) {
			$this->data['order_status'] = $config_info['order_status'];
		} else {
			$this->data['order_status'] = 0;
		}
	
		if (isset($this->request->post['order_required'])) {
			$this->data['order_required'] = $this->request->post['order_required'];
		} elseif (!empty($config_info)) {
			$this->data['order_required'] = $config_info['order_required'];
		} else {
			$this->data['order_required'] = 0;
		}
		
		$this->template = 'ticket/config.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'ticket/config')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>