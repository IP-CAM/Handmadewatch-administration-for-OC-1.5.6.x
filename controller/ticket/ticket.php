<?php
class ControllerTicketTicket extends Controller {
	private $error = array();

  	public function index() {
    	$this->load->language('ticket/ticket');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');

    	$this->getList();
  	}

	public function delete() {
    	$this->load->language('ticket/ticket');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');

    	if (isset($this->request->get['ticket_id'])) {
			$this->model_ticket_ticket->delete($this->request->get['ticket_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getList();
  	}

  	public function archived() {
    	$this->load->language('ticket/ticket');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');

    	if (isset($this->request->post['selected'])) {
      		foreach ($this->request->post['selected'] as $ticket_id) {
				$this->model_ticket_ticket->changeStatus($ticket_id, 'Архив');

				$this->last_update($ticket_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getList();
  	}

	public function resolved() {
    	$this->load->language('ticket/ticket');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');

    	if (isset($this->request->post['selected'])) {
      		foreach ($this->request->post['selected'] as $ticket_id) {
				$this->model_ticket_ticket->changeStatus($ticket_id, 'Решено');

				$this->last_update($ticket_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getList();
  	}

	public function resolving() {
    	$this->load->language('ticket/ticket');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');

    	if (isset($this->request->post['selected'])) {
      		foreach ($this->request->post['selected'] as $ticket_id) {
				$this->model_ticket_ticket->changeStatus($ticket_id, 'В обработке');

				$this->last_update($ticket_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getList();
  	}

  	public function bulk_delete() {
    	$this->load->language('ticket/ticket');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');

    	if (isset($this->request->post['selected'])) {
      		foreach ($this->request->post['selected'] as $ticket_id) {
				$this->model_ticket_ticket->delete($ticket_id);
			}

			$this->session->data['success'] = $this->language->get('text_success_delete');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getList();
  	}

	public function view() {
		$this->load->language('ticket/ticket');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');

		$this->getForm();
	}

	public function message() {
		$this->load->language('ticket/ticket');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ticket/ticket');
		$this->load->model('ticket/message');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
    		$this->request->post['ticket_id'] = $this->request->get['ticket_id'];

    		$ticket = $this->model_ticket_ticket->getTicket($this->request->get['ticket_id']);

    		$this->load->model('sale/customer');

    		$customer = $this->model_sale_customer->getCustomer($ticket['ticket_customer_id']);

    		$this->model_ticket_message->addMessage($this->request->post, $customer['email']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->last_update($this->request->get['ticket_id']);

			$this->redirect($this->url->link('ticket/ticket/view', 'token=' . $this->session->data['token'] . '&ticket_id=' . $this->request->get['ticket_id']));
    	}

		$this->getForm();
	}

	public function assign() {
		if (!$this->user->hasPermission('modify', 'ticket/ticket')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}
    	$this->load->language('ticket/ticket');
    	$this->load->model('ticket/ticket');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';

			if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				$this->model_ticket_ticket->editTicket($this->request->get['ticket_id'], $this->request->post);

				$this->session->data['success'] = $this->language->get('text_success_assign');

				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				$this->redirect($this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		}

		$this->load->language('ticket/ticket');

		$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');

    	$this->data['entry_subject'] = $this->language->get('entry_subject');
    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_ticket_group'] = $this->language->get('entry_ticket_group');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_department'] = $this->language->get('entry_department');
		$this->data['entry_assign'] = $this->language->get('entry_assign');

    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('ticket/ticket/assign', 'token=' . $this->session->data['token'] . $url . '&ticket_id=' . $this->request->get['ticket_id'], 'SSL');

    	$this->data['cancel'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['ticket_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$ticket_info = $this->model_ticket_ticket->getTicket($this->request->get['ticket_id']);
    	}

    	if (isset($this->request->post['subject'])) {
      		$this->data['subject'] = $this->request->post['subject'];
    	} elseif (!empty($ticket_info)) {
			$this->data['subject'] = $ticket_info['ticket_subject'];
		} else {
      		$this->data['subject'] = '';
    	}

    	if (!empty($ticket_info)) {
			$this->data['status'] = $ticket_info['ticket_status'];
		}else{
			$this->data['status'] = '';
		}

		if (!empty($ticket_info)) {
			$this->data['department'] = $ticket_info['department_name'];
		}else{
			$this->data['department'] = '';
		}

		if (!empty($ticket_info)) {
			$this->data['user_id'] = $ticket_info['ticket_user_id'];
		}else{
			$this->data['user_id'] = '';
		}

		$this->data['customer_name'] = '';
    	$this->data['customer_email'] = '';
    	if (!empty($ticket_info)) {
    		$this->load->model('sale/customer');

    		$customer_info = $this->model_sale_customer->getCustomer( $ticket_info['ticket_customer_id'] );

    		if ($customer_info){
    			$this->data['customer_name'] = $customer_info['firstname'] . ' ' . $customer_info['lastname'];
    			$this->data['customer_email'] = $customer_info['email'];
    		}
    	}

    	$this->data['token'] = $this->session->data['token'];

    	$this->load->model('user/user');
    	$this->data['users'] = $this->model_user_user->getUsers();

		$this->template = 'ticket/assign_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

  	private function getList() {
  		$this->document->addStyle('view/stylesheet/bootstrap.css');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ticket_created';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

  		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = '';
		}

  		if (isset($this->request->get['filter_user'])) {
			$filter_user = $this->request->get['filter_user'];
		} else {
			$filter_user = false;
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['all'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['yours'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url . '&filter_user=true', 'SSL');
		$this->data['new'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url . '&filter_status=New', 'SSL');
		$this->data['archived'] = $this->url->link('ticket/ticket/archived', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['resolved'] = $this->url->link('ticket/ticket/resolved', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['resolving'] = $this->url->link('ticket/ticket/resolving', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('ticket/ticket/bulk_delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	$this->data['tickets'] = array();

		$data = array(
			'filter_status' => $filter_status,
			'filter_user' => $filter_user,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$ticket_total = $this->model_ticket_ticket->getTotalTickets();

		$results = $this->model_ticket_ticket->getTickets($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('ticket/ticket/view', 'token=' . $this->session->data['token'] . '&ticket_id=' . $result['ticket_id'] . $url, 'SSL')
			);

			$this->load->model('user/user');

			$curr_user = $this->model_user_user->getUser( $this->user->getId() );

			if (1 == $curr_user['user_group_id']){
				$action[] = array(
					'text' => $this->language->get('text_assign'),
					'href' => $this->url->link('ticket/ticket/assign', 'token=' . $this->session->data['token'] . '&ticket_id=' . $result['ticket_id'] . $url, 'SSL')
				);
			}

			if ((1 == $curr_user['user_group_id'] || $this->user->getId() == $result['ticket_user_id']) && $result['ticket_status'] == 'Решено'){
				$action[] = array(
					'text' => $this->language->get('text_delete'),
					'href' => $this->url->link('ticket/ticket/delete', 'token=' . $this->session->data['token'] . '&ticket_id=' . $result['ticket_id'] . $url, 'SSL')
				);
			}

			$user = $this->model_user_user->getUser($result['ticket_user_id']);

			if (!isset($user['username'])){
				$user['username'] = '';
			}

      		$this->data['tickets'][] = array(
				'ticket_id'  => $result['ticket_id'],
				'subject'    => $result['ticket_subject'],
				'status'     => $result['ticket_status'],
      			'department' => $result['department_name'],
      			'last_update'=> $result['ticket_last_update'],
				'date_added' => date($this->language->get('date_time_format'), strtotime($result['ticket_created'])),
      			'user'		 => $user['username'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['ticket_id'], $this->request->post['selected']),
				'action'     => $action,
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['button_all'] = $this->language->get('button_all');
		$this->data['button_new'] = $this->language->get('button_new');
		$this->data['button_yours'] = $this->language->get('button_yours');
		$this->data['button_archived'] = $this->language->get('button_archived');
		$this->data['button_resolved'] = $this->language->get('button_resolved');
		$this->data['button_resolving'] = $this->language->get('button_resolving');

		$this->data['column_subject'] = $this->language->get('column_subject');
		$this->data['column_assign'] = $this->language->get('column_assign');
		$this->data['column_department'] = $this->language->get('column_department');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_last_update'] = $this->language->get('column_last_update');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');

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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_subject'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . '&sort=ticket_subject' . $url, 'SSL');
		$this->data['sort_department'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . '&sort=ticket_department_id' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . '&sort=ticket_status' . $url, 'SSL');
		$this->data['sort_date_added'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . '&sort=ticket_created' . $url, 'SSL');
		$this->data['sort_last_update'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . '&sort=ticket_last_update' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $ticket_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->data['total_new'] = $this->model_ticket_ticket->getTotalTickets('New');
		$this->data['total_yours'] = $this->model_ticket_ticket->getTotalTickets(null, true);

		$this->template = 'ticket/ticket_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
  	}

	private function getForm() {
		$this->document->addStyle('view/stylesheet/bootstrap.css');

		$this->document->addScript('view/javascript/module/ticket/bootstrap-fileupload.js');

    	$this->data['heading_title'] = $this->language->get('heading_title');

        $this->load->model('ticket/custom');

        $form_info = $this->model_ticket_custom->getForm();

        $this->data['text_location'] = $this->language->get('text_location');
        $this->data['text_creator'] = $this->language->get('text_creator');
        $this->data['text_address'] = $this->language->get('text_address');
        $this->data['text_telephone'] = $this->language->get('text_telephone');
        $this->data['text_fax'] = $this->language->get('text_fax');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
        $this->data['entry_captcha'] = $this->language->get('entry_captcha');


        if (isset($this->error['error_captcha'])) {
            $this->data['error_captcha'] = $this->error['error_captcha'];
        } else {
            $this->data['error_captcha'] = '';
        }

        if (isset($this->error['email'])) {
            $this->data['error_email'] = $this->error['email'];
        } else {
            $this->data['error_email'] = '';
        }
        $this->data['formdata'] = $this->model_ticket_custom->getFormShowData(unserialize($form_info['formdata']),$this->request->get['ticket_id']);


    	$this->data['heading_chat'] = $this->language->get('heading_chat');

    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
    	$this->data['text_admin'] = $this->language->get('text_admin');
    	$this->data['text_you'] = $this->language->get('text_you');

    	$this->data['entry_subject'] = $this->language->get('entry_subject');
    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_ticket_group'] = $this->language->get('entry_ticket_group');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_department'] = $this->language->get('entry_department');
		$this->data['entry_message'] = $this->language->get('entry_message');
		$this->data['entry_file'] = $this->language->get('entry_file');
		$this->data['entry_order'] = $this->language->get('entry_order');

    	$this->data['button_send'] = $this->language->get('button_send');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

    	$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['message'])) {
			$this->data['error_message'] = $this->error['message'];
		} else {
			$this->data['error_message'] = array();
		}

		if (isset($this->error['attach'])) {
			$this->data['error_attach'] = $this->error['attach'];
		} else {
			$this->data['error_attach'] = array();
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('ticket/ticket/message', 'token=' . $this->session->data['token'] . '&ticket_id=' . $this->request->get['ticket_id'] . $url, 'SSL');

    	$this->data['cancel'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['ticket_id'])) {
      		$ticket_info = $this->model_ticket_ticket->getTicket($this->request->get['ticket_id']);
    	}

    	if (isset($this->request->post['subject'])) {
      		$this->data['subject'] = $this->request->post['subject'];
    	} elseif (!empty($ticket_info)) {
			$this->data['subject'] = $ticket_info['ticket_subject'];
		} else {
      		$this->data['subject'] = '';
    	}

    	$this->data['customer_name'] = '';
    	$this->data['customer_email'] = '';
    	if (!empty($ticket_info)) {
    		$this->load->model('sale/customer');

    		$customer_info = $this->model_sale_customer->getCustomer( $ticket_info['ticket_customer_id'] );

    		if ($customer_info){
    			$this->data['customer_name'] = $customer_info['firstname'] . ' ' . $customer_info['lastname'];
    			$this->data['customer_email'] = $customer_info['email'];
    		}
    	}

    	if (!empty($ticket_info)) {
			$this->data['status'] = $ticket_info['ticket_status'];
		}else{
			$this->data['status'] = '';
		}

		if (!empty($ticket_info)) {
			$this->data['department'] = $ticket_info['department_name'];
		}else{
			$this->data['department'] = '';
		}

		if (isset($this->request->post['message'])) {
			$this->data['message'] = $this->request->post['message'];
		}else{
			$this->data['message'] = '';
		}

		if (!empty($ticket_info)) {
			$this->data['order'] = $ticket_info['ticket_order_id'];
		}else{
			$this->data['order'] = '';
		}
		$config_info = $this->model_ticket_ticket->getConfig();
		$this->data['order_status'] = $config_info['order_status'];
		
		$this->data['is_user'] = false;
		if ( $ticket_info['ticket_user_id'] == $this->user->getId() ){
			$this->data['is_user'] = true;

			$this->load->model('ticket/message');

			$this->data['messages'] = $this->model_ticket_message->getMessages( array('filter_ticket' => $ticket_info['ticket_id']) );

//			$this->sendMail($url);
		}

		$this->template = 'ticket/ticket_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
  	}

  	private function validateForm() {
    	if (!$this->user->hasPermission('modify', 'ticket/ticket')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

  		if (utf8_strlen($this->request->post['message']) < 3) {
      		$this->error['message'] = $this->language->get('text_error_message');
    	}
//		print "<pre>"; var_dump($this->request->files['file']); exit;
		if ( isset($this->request->files['file']["name"]) && !empty($this->request->files['file']["name"])){
			$allowed = array(
				'image/jpeg',
	            'image/png',
	            'application/rar',
	            'application/octet-stream',
	            'image/gif',
				'application/x-zip-compressed',
			);

			$uploaddir = DIR_IMAGE. 'data/upload/';

			if($this->request->files['file']['size'] > 50000000){
	        	$this->error['attach'] = $this->language->get('text_error_size');

			}elseif (!in_array($this->request->files['file']['type'], $allowed)){
				$this->error['attach'] = $this->language->get('text_error_extension');

			}elseif(!file_exists($uploaddir)){
	        	if(!mkdir($uploaddir)){
	             	$this->error['attach'] = $this->language->get('text_error_save');
				}

			}else{
	        	$temp =  $this->request->files['file']['tmp_name'];
	        	$name = $this->request->files["file"]["name"];

	        	if (!move_uploaded_file($temp, "$uploaddir/$name")) {
					$this->error['attach'] = $this->language->get('text_error_save');
				}else{
					$this->request->post['file'] = "data/upload/$name";
				}
	        }
		}

    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
  	}

	public function sendMail($url) {
		$this->load->language('sale/contact');

		$this->load->model('sale/customer');

		$this->load->model('sale/customer_group');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($this->request->post['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
			} else {
				$store_name = $this->config->get('config_name');
			}

			$message  = '<html dir="ltr" lang="en">' . "\n";
			$message .= '<head>' . "\n";
			$message .= '<title>' . $this->request->post['subject'] . '</title>' . "\n";
			$message .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			$message .= '</head>' . "\n";
			$message .= '<body>' . html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
			$message .= '</html>' . "\n";

			$attachments = array();

			if (preg_match_all('#(src="([^"]*)")#mis', $message, $matches)) {
				foreach ($matches[2] as $key => $value) {
					$filename = md5(basename($value)) . strrchr($value, '.');
					$path = rtrim($this->request->server['DOCUMENT_ROOT'], '/') . parse_url($value, PHP_URL_PATH);

					$attachments[] = array(
						'filename' => $filename,
						'path'     => $path
					);

					$message = str_replace($value, 'cid:' . $filename, $message);
				}
			}

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
			$mail->setTo($this->request->post['to']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($store_name);
			$mail->setSubject($this->request->post['subject']);

			foreach ($attachments as $attachment) {
				$mail->addAttachment($attachment['path'], $attachment['filename']);
			}

			$mail->setHtml($message);
			$mail->send();

			$this->session->data['success'] = $this->language->get('text_success');
		}

		$this->data['heading_mail'] = $this->language->get('heading_mail');

		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_to'] = $this->language->get('entry_to');
		$this->data['entry_message'] = $this->language->get('entry_message');

		$this->data['button_send'] = $this->language->get('button_send');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

		$this->data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['message'])) {
			$this->data['error_message'] = $this->error['message'];
		} else {
			$this->data['error_message'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$this->data['action'] = $this->url->link('ticket/ticket/view', 'token=' . $this->session->data['token'] . '&ticket_id=' . $this->request->get['ticket_id'] . $url, 'SSL');
    	$this->data['cancel'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->post['store_id'])) {
			$this->data['store_id'] = $this->request->post['store_id'];
		} else {
			$this->data['store_id'] = '';
		}

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['to'])) {
			$this->data['to'] = $this->request->post['to'];
		} else {
			$this->data['to'] = '';
		}

		if (isset($this->request->post['customer_group_id'])) {
			$this->data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
			$this->data['customer_group_id'] = '';
		}

		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups(0);

		if (isset($this->request->post['message'])) {
			$this->data['message'] = $this->request->post['message'];
		} else {
			$this->data['message'] = '';
		}
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'ticket/ticket')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

		if (!$this->request->post['subject']) {
			$this->error['subject'] = $this->language->get('error_subject');
		}

		if (!$this->request->post['message']) {
			$this->error['message'] = $this->language->get('error_message');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function last_update( $ticket_id ){
		$this->load->model('ticket/ticket');

		$ticket = $this->model_ticket_ticket->lastUpdate( $ticket_id, $this->user->getUsername() );
	}
}
?>