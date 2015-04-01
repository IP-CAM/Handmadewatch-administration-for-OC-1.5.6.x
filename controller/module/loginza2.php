<?php
class ControllerModuleLoginza2 extends Controller {
	private $error = array(); 
	private $socnets = array(
				'google'		=> 'Google', 
				'yandex' 		=> 'Yandex', 
				'mailruapi' 	=> 'OpenID.mail.ru', 
				'mailru' 		=> 'Mail.ru', 
				'vkontakte'     => 'ВКонтакте', 
				'facebook'	    => 'FaceBook', 
				'odnoklassniki' => 'Одноклассники', 
				'livejournal'   => 'LiveJournal.com', 
				'twitter'       => 'Twitter',  
				'linkedin'      => 'LinkedIN', 
				'loginza'       => 'Loginza', 
				'myopenid'      => 'MyOpenID', 
				'webmoney'      => 'WebMoney', 
				'rambler'       => 'Rambler',  
				'flickr'        => 'Flickr', 
				'lastfm'        => 'Last.FM', 
				'verisign'      => 'Verisign.com', 
				'aol'			=> 'Aol.com',	
				'steam'			=> 'Steam', 
				'openid'		=> 'OpenID'
	);
	
	public function install()
	{
		$this->load->model('module/loginza2');
		$this->model_module_loginza2->addFields();
	}
	
	public function uninstall()
	{
		 
	}
	
	public function index() {   
		$this->load->language('module/loginza2');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('module/loginza2');
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) 
		{
			$this->model_setting_setting->editSetting('loginza2', $this->request->post);		
			
			if( isset( $this->request->post['config_google_analytics'] ) )
			{
				$this->model_module_loginza2->updateSetting('config', 
															'config_google_analytics', 
															$this->request->post['config_google_analytics']);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			if( !empty($this->request->post['stay']) )
			{
				$tab = 'link-tab-general';
				
				if( !empty($this->request->post['tab']) )
				{
					$tab = $this->request->post['tab'];
				}
				
				$this->redirect($this->url->link('module/loginza2', 'token=' . $this->session->data['token'].'&tab='.$tab, 'SSL'));
			}
			else
			{
				$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));			
			}
		}
				
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if( isset( $this->request->post['loginza2_widget_name'] ) )
		{
			$this->data['loginza2_widget_name'] = $this->request->post['loginza2_widget_name'];
		}
		elseif( $this->config->has('loginza2_widget_name') )
		{
			$this->data['loginza2_widget_name'] = $this->config->get('loginza2_widget_name');
		}
		else
		{
			foreach($this->data['languages'] as $language)
			{
				$this->data['loginza2_widget_name'][$language['language_id']] = $this->config->get('loginza2_widget_name_default');
			}
		}
		
		if( !empty($this->request->get['tab']) )
		{
			$this->data['tab'] = $this->request->get['tab'];
		}
		else
		{
			$this->data['tab'] = 'link-tab-general';
		}
		
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['entry_show_standart_auth'] = $this->language->get('entry_show_standart_auth');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
		$this->data['text_showtype_notice'] = $this->language->get('text_showtype_notice');
		
		
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_dobor'] = $this->language->get('tab_dobor');
		$this->data['tab_socseti'] = $this->language->get('tab_socseti');
		$this->data['tab_widget'] = $this->language->get('tab_widget');
		$this->data['tab_admin'] = $this->language->get('tab_admin');
		$this->data['tab_support'] = $this->language->get('tab_support');
		
		
		$this->data['entry_sig'] = $this->language->get('entry_sig');
		$this->data['entry_id'] = $this->language->get('entry_id');
		$this->data['entry_safemode'] = $this->language->get('entry_safemode');
		
		$this->data['entry_widget_header'] = $this->language->get('entry_widget_header');
		$this->data['entry_widget_notice'] = $this->language->get('entry_widget_notice');
		
		/* start update: a1 */
		
		$this->data['entry_confirm_data'] = $this->language->get('entry_confirm_data');
		$this->data['entry_confirm_data_notice'] = $this->language->get('entry_confirm_data_notice');
		$this->data['entry_confirm_firstname'] = $this->language->get('entry_confirm_firstname');
		$this->data['entry_confirm_lastname']  = $this->language->get('entry_confirm_lastname');
		$this->data['entry_confirm_email']     = $this->language->get('entry_confirm_email');
		$this->data['entry_confirm_phone']     = $this->language->get('entry_confirm_phone');
		$this->data['text_confirm_disable']    = $this->language->get('text_confirm_disable');
		$this->data['text_confirm_none']       = $this->language->get('text_confirm_none');
		$this->data['text_confirm_allways']    = $this->language->get('text_confirm_allways');
		/* end update: a1 */
		
		$this->data['col_link'] = $this->language->get('col_link');
		$this->data['col_nickname'] = $this->language->get('col_nickname');
		$this->data['col_email'] = $this->language->get('col_email');
		$this->data['col_gender'] = $this->language->get('col_gender');
		$this->data['col_photo'] = $this->language->get('col_photo');
		$this->data['col_name'] = $this->language->get('col_name');
		$this->data['col_dob'] = $this->language->get('col_dob');
		$this->data['col_work'] = $this->language->get('col_work');
		$this->data['col_address'] = $this->language->get('col_address');
		$this->data['col_phone'] = $this->language->get('col_phone');
		$this->data['col_im'] = $this->language->get('col_im');
		$this->data['col_biography'] = $this->language->get('col_biography');
		
		$this->data['entry_admin'] = $this->language->get('entry_admin');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['entry_widget_name'] = $this->language->get('entry_widget_name');
		
		$this->data['entry_format']	= $this->language->get('entry_format');
		$this->data['entry_label']	= $this->language->get('entry_label');
		
		$this->data['entry_admin_header']	= $this->language->get('entry_admin_header');
		$this->data['entry_admin_customer']	= $this->language->get('entry_admin_customer');
		$this->data['entry_admin_customer_list']	= $this->language->get('entry_admin_customer_list');
		$this->data['entry_admin_order']	= $this->language->get('entry_admin_order');
		$this->data['entry_admin_order_list']	= $this->language->get('entry_admin_order_list');
		
		$this->data['text_format_table']	= $this->language->get('text_format_table');
		$this->data['text_format_button']	= $this->language->get('text_format_button');
		$this->data['text_format_icons']	= $this->language->get('text_format_icons');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		
		$this->data['entry_widget_layout'] = $this->language->get('entry_widget_layout');
		$this->data['entry_widget_position'] = $this->language->get('entry_widget_position');
		$this->data['entry_widget_status'] = $this->language->get('entry_widget_status');
		$this->data['entry_widget_sort_order'] = $this->language->get('entry_widget_sort_order');
		
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_country'] = $this->language->get('text_country');
		$this->data['text_regions'] = $this->language->get('text_regions');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		$this->data['entry_showtype'] = $this->language->get('entry_showtype');
		$this->data['entry_widget_showtype'] = $this->language->get('entry_widget_showtype');
		$this->data['text_showtype_window'] = $this->language->get('text_showtype_window');
		$this->data['text_showtype_redirect'] = $this->language->get('text_showtype_redirect');
		
		$this->data['text_frame'] = $this->language->get('text_frame');
		$this->data['text_contact'] = $this->language->get('text_contact');
		
		$this->data['entry_widget_after'] = $this->language->get('entry_widget_after');
		$this->data['text_widget_after_show'] = $this->language->get('text_widget_after_show');
		$this->data['text_widget_after_hide'] = $this->language->get('text_widget_after_hide');
		
		$this->data['filter_notice'] = $this->language->get('filter_notice');
		$this->data['filter_header'] = $this->language->get('filter_header');
		$this->data['entry_widget_format'] = $this->language->get('entry_widget_format');
		 
		$this->data['col_socnet'] = $this->language->get('col_socnet');
		$this->data['col_data'] = $this->language->get('col_data');
		$this->data['col_enable'] = $this->language->get('col_enable');
		
		$this->data['entry_default'] = $this->language->get('entry_default');
		
		$this->data['button_save_and_go'] = $this->language->get('button_save_and_go');
		$this->data['button_save_and_stay'] = $this->language->get('button_save_and_stay');
		
		if( !empty( $this->session->data['success'] ) )
		{
			$this->session->data['success'] = 0;
			$this->data['success'] = $this->language->get('text_success');
		}
		else
		{
			$this->data['success'] = '';
		}
		
		foreach( $this->socnets as $socnet=>$label )
		{
			if (isset($this->request->post['loginza2_'.$socnet])) {
				$this->data['loginza2_'.$socnet] = $this->request->post['loginza2_'.$socnet];
			} elseif( $this->config->get('loginza2_'.$socnet) ) {
				$this->data['loginza2_'.$socnet] = $this->config->get('loginza2_'.$socnet);
			} else {
				$this->data['loginza2_'.$socnet] = 'y';
			}
			
			
			$this->data['entry_'.$socnet] = $this->language->get('entry_'.$socnet);
			$this->data['url_'.$socnet] = $this->language->get('url_'.$socnet);
			$this->data['data_'.$socnet] = $this->language->get('data_'.$socnet);
			
			$this->data['socnets_list'][$socnet] = $this->language->get('entry_'.$socnet);
		}
		
		$this->data['socnets'] = $this->socnets;
		
		if (isset($this->request->post['loginza2_status'])) {
			$this->data['loginza2_status'] = $this->request->post['loginza2_status'];
		} elseif ($this->config->get('loginza2_status')) { 
			$this->data['loginza2_status'] = $this->config->get('loginza2_status');
		} else {
			$this->data['loginza2_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_widget_format'])) {
			$this->data['loginza2_widget_format'] = $this->request->post['loginza2_widget_format'];
		} elseif ($this->config->get('loginza2_widget_format')) { 
			$this->data['loginza2_widget_format'] = $this->config->get('loginza2_widget_format');
		} else {
			$this->data['loginza2_widget_format'] = 'button';
		}
		
		
		if (isset($this->request->post['loginza2_show_standart_auth'])) {
			$this->data['loginza2_show_standart_auth'] = $this->request->post['loginza2_show_standart_auth'];
		} elseif ($this->config->has('loginza2_show_standart_auth')) { 
			$this->data['loginza2_show_standart_auth'] = $this->config->get('loginza2_show_standart_auth');
		} else {
			$this->data['loginza2_show_standart_auth'] = 0;
		}
		
		if (isset($this->request->post['loginza2_showtype'])) {
			$this->data['loginza2_showtype'] = $this->request->post['loginza2_showtype'];
		} elseif ($this->config->has('loginza2_showtype')) { 
			$this->data['loginza2_showtype'] = $this->config->get('loginza2_showtype');
		} else {
			$this->data['loginza2_showtype'] = 'window';
		}
		
		if (isset($this->request->post['loginza2_widget_showtype'])) {
			$this->data['loginza2_widget_showtype'] = $this->request->post['loginza2_widget_showtype'];
		} elseif ($this->config->has('loginza2_widget_showtype')) { 
			$this->data['loginza2_widget_showtype'] = $this->config->get('loginza2_widget_showtype');
		} else {
			$this->data['loginza2_widget_showtype'] = 'window';
		}
		
		if (isset($this->request->post['loginza2_module'])) {
			$this->data['loginza2_module'] = $this->request->post['loginza2_module'];
		} elseif ($this->config->get('loginza2_module')) { 
			$this->data['loginza2_module'] = $this->config->get('loginza2_module');
		} else {
			$this->data['loginza2_module'] = array();
		}
		
		if (isset($this->request->post['loginza2_safemode'])) {
			$this->data['loginza2_safemode'] = $this->request->post['loginza2_safemode'];
		} elseif ($this->config->get('loginza2_safemode')) { 
			$this->data['loginza2_safemode'] = $this->config->get('loginza2_safemode');
		} else {
			$this->data['loginza2_safemode'] = '';
		}
		
		if (isset($this->request->post['loginza2_widget_sig'])) {
			$this->data['loginza2_widget_sig'] = $this->request->post['loginza2_widget_sig'];
		} elseif ($this->config->get('loginza2_widget_sig')) { 
			$this->data['loginza2_widget_sig'] = $this->config->get('loginza2_widget_sig');
		} else {
			$this->data['loginza2_widget_sig'] = '';
		}
		
		if (isset($this->request->post['loginza2_default'])) {
			$this->data['loginza2_default'] = $this->request->post['loginza2_default'];
		} elseif ($this->config->get('loginza2_default')) { 
			$this->data['loginza2_default'] = $this->config->get('loginza2_default');
		} else {
			$this->data['loginza2_default'] = '';
		}
		
		if (isset($this->request->post['loginza2_widget_after'])) {
			$this->data['loginza2_widget_after'] = $this->request->post['loginza2_widget_after'];
		} elseif ($this->config->get('loginza2_widget_after')) { 
			$this->data['loginza2_widget_after'] = $this->config->get('loginza2_widget_after');
		} else {
			$this->data['loginza2_widget_after'] = '';
		}
		
		if (isset($this->request->post['loginza2_widget_id'])) {
			$this->data['loginza2_widget_id'] = $this->request->post['loginza2_widget_id'];
		} elseif ($this->config->get('loginza2_widget_id')) { 
			$this->data['loginza2_widget_id'] = $this->config->get('loginza2_widget_id');
		} else {
			$this->data['loginza2_widget_id'] = '';
		}
		
		/* start update: a1 */ 
		if (isset($this->request->post['loginza2_confirm_firstname_status'])) {
			$this->data['loginza2_confirm_firstname_status'] = $this->request->post['loginza2_confirm_firstname_status'];
		} elseif ($this->config->get('loginza2_confirm_firstname_status')) { 
			$this->data['loginza2_confirm_firstname_status'] = $this->config->get('loginza2_confirm_firstname_status');
		} else {
			$this->data['loginza2_confirm_firstname_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_lastname_status'])) {
			$this->data['loginza2_confirm_lastname_status'] = $this->request->post['loginza2_confirm_lastname_status'];
		} elseif ($this->config->get('loginza2_confirm_lastname_status')) { 
			$this->data['loginza2_confirm_lastname_status'] = $this->config->get('loginza2_confirm_lastname_status');
		} else {
			$this->data['loginza2_confirm_lastname_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_email_status'])) {
			$this->data['loginza2_confirm_email_status'] = $this->request->post['loginza2_confirm_email_status'];
		} elseif ($this->config->get('loginza2_confirm_email_status')) { 
			$this->data['loginza2_confirm_email_status'] = $this->config->get('loginza2_confirm_email_status');
		} else {
			$this->data['loginza2_confirm_email_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_telephone_status'])) {
			$this->data['loginza2_confirm_telephone_status'] = $this->request->post['loginza2_confirm_telephone_status'];
		} elseif ($this->config->get('loginza2_confirm_telephone_status')) { 
			$this->data['loginza2_confirm_telephone_status'] = $this->config->get('loginza2_confirm_telephone_status');
		} else {
			$this->data['loginza2_confirm_telephone_status'] = 0;
		}
		
		/* end update: a1 */ 
		
		
		/* start update: c1 */
		$this->data['entry_confirm_company'] = $this->language->get('entry_confirm_company');
		$this->data['entry_confirm_address_1'] = $this->language->get('entry_confirm_address_1');
		$this->data['entry_confirm_postcode'] = $this->language->get('entry_confirm_postcode');
		$this->data['entry_confirm_city'] = $this->language->get('entry_confirm_city');
		$this->data['entry_confirm_zone'] = $this->language->get('entry_confirm_zone');
		$this->data['entry_confirm_country'] = $this->language->get('entry_confirm_country');
		$this->data['text_required'] = $this->language->get('text_required');
		
		if (isset($this->request->post['loginza2_confirm_company_status'])) {
			$this->data['loginza2_confirm_company_status'] = $this->request->post['loginza2_confirm_company_status'];
		} elseif ($this->config->get('loginza2_confirm_company_status')) { 
			$this->data['loginza2_confirm_company_status'] = $this->config->get('loginza2_confirm_company_status');
		} else {
			$this->data['loginza2_confirm_company_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_address_1_status'])) {
			$this->data['loginza2_confirm_address_1_status'] = $this->request->post['loginza2_confirm_address_1_status'];
		} elseif ($this->config->get('loginza2_confirm_address_1_status')) { 
			$this->data['loginza2_confirm_address_1_status'] = $this->config->get('loginza2_confirm_address_1_status');
		} else {
			$this->data['loginza2_confirm_address_1_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_postcode_status'])) {
			$this->data['loginza2_confirm_postcode_status'] = $this->request->post['loginza2_confirm_postcode_status'];
		} elseif ($this->config->get('loginza2_confirm_postcode_status')) { 
			$this->data['loginza2_confirm_postcode_status'] = $this->config->get('loginza2_confirm_postcode_status');
		} else {
			$this->data['loginza2_confirm_postcode_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_city_status'])) {
			$this->data['loginza2_confirm_city_status'] = $this->request->post['loginza2_confirm_city_status'];
		} elseif ($this->config->get('loginza2_confirm_city_status')) { 
			$this->data['loginza2_confirm_city_status'] = $this->config->get('loginza2_confirm_city_status');
		} else {
			$this->data['loginza2_confirm_city_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_zone_status'])) {
			$this->data['loginza2_confirm_zone_status'] = $this->request->post['loginza2_confirm_zone_status'];
		} elseif ($this->config->get('loginza2_confirm_zone_status')) { 
			$this->data['loginza2_confirm_zone_status'] = $this->config->get('loginza2_confirm_zone_status');
		} else {
			$this->data['loginza2_confirm_zone_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_country_status'])) {
			$this->data['loginza2_confirm_country_status'] = $this->request->post['loginza2_confirm_country_status'];
		} elseif ($this->config->get('loginza2_confirm_country_status')) { 
			$this->data['loginza2_confirm_country_status'] = $this->config->get('loginza2_confirm_country_status');
		} else {
			$this->data['loginza2_confirm_country_status'] = 0;
		}
		
		if (isset($this->request->post['loginza2_confirm_firstname_required'])) {
			$this->data['loginza2_confirm_firstname_required'] = $this->request->post['loginza2_confirm_firstname_required'];
		} else { 
			$this->data['loginza2_confirm_firstname_required'] = $this->config->get('loginza2_confirm_firstname_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_lastname_required'])) {
			$this->data['loginza2_confirm_lastname_required'] = $this->request->post['loginza2_confirm_lastname_required'];
		} else { 
			$this->data['loginza2_confirm_lastname_required'] = $this->config->get('loginza2_confirm_lastname_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_email_required'])) {
			$this->data['loginza2_confirm_email_required'] = $this->request->post['loginza2_confirm_email_required'];
		} else { 
			$this->data['loginza2_confirm_email_required'] = $this->config->get('loginza2_confirm_email_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_telephone_required'])) {
			$this->data['loginza2_confirm_telephone_required'] = $this->request->post['loginza2_confirm_telephone_required'];
		} else { 
			$this->data['loginza2_confirm_telephone_required'] = $this->config->get('loginza2_confirm_telephone_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_company_required'])) {
			$this->data['loginza2_confirm_company_required'] = $this->request->post['loginza2_confirm_company_required'];
		} else { 
			$this->data['loginza2_confirm_company_required'] = $this->config->get('loginza2_confirm_company_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_address_1_required'])) {
			$this->data['loginza2_confirm_address_1_required'] = $this->request->post['loginza2_confirm_address_1_required'];
		} else { 
			$this->data['loginza2_confirm_address_1_required'] = $this->config->get('loginza2_confirm_address_1_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_postcode_required'])) {
			$this->data['loginza2_confirm_postcode_required'] = $this->request->post['loginza2_confirm_postcode_required'];
		} else { 
			$this->data['loginza2_confirm_postcode_required'] = $this->config->get('loginza2_confirm_postcode_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_city_required'])) {
			$this->data['loginza2_confirm_city_required'] = $this->request->post['loginza2_confirm_city_required'];
		} else { 
			$this->data['loginza2_confirm_city_required'] = $this->config->get('loginza2_confirm_city_required');
		}
		
		if (isset($this->request->post['loginza2_confirm_zone_required'])) {
			$this->data['loginza2_confirm_zone_required'] = $this->request->post['loginza2_confirm_zone_required'];
		} else { 
			$this->data['loginza2_confirm_zone_required'] = $this->config->get('loginza2_confirm_zone_required');
		}
		
		
		if (isset($this->request->post['loginza2_confirm_country_required'])) {
			$this->data['loginza2_confirm_country_required'] = $this->request->post['loginza2_confirm_country_required'];
		} else { 
			$this->data['loginza2_confirm_country_required'] = $this->config->get('loginza2_confirm_country_required');
		}
		
		/* 
		lastname
		email
		phone
		company
		address_1		
		postcode
		city
		zone_id
		country_id
		end update: c1 */
		
		if (isset($this->request->post['loginza2_format'])) {
			$this->data['loginza2_format'] = $this->request->post['loginza2_format'];
		} elseif ($this->config->get('loginza2_format')) { 
			$this->data['loginza2_format'] = $this->config->get('loginza2_format');
		} else {
			$this->data['loginza2_format'] = 'table';
		}
		
		if (isset($this->request->post['loginza2_label'])) {
			$this->data['loginza2_label'] = $this->request->post['loginza2_label'];
		} elseif ($this->config->get('loginza2_label')) { 
			$this->data['loginza2_label'] = $this->config->get('loginza2_label');
		} else {
			$this->data['loginza2_label'] = array();
		}
		
		if (isset($this->request->post['loginza2_admin_customer'])) {
			$this->data['loginza2_admin_customer'] = $this->request->post['loginza2_admin_customer'];
		} elseif ($this->config->has('loginza2_admin_customer')) { 
			$this->data['loginza2_admin_customer'] = $this->config->get('loginza2_admin_customer');
		} else {
			$this->data['loginza2_admin_customer'] = 1;
		}
		
		if (isset($this->request->post['loginza2_admin_customer_list'])) {
			$this->data['loginza2_admin_customer_list'] = $this->request->post['loginza2_admin_customer_list'];
		} elseif ($this->config->has('loginza2_admin_customer_list')) { 
			$this->data['loginza2_admin_customer_list'] = $this->config->get('loginza2_admin_customer_list');
		} else {
			$this->data['loginza2_admin_customer_list'] = 1;
		}
		
		if (isset($this->request->post['loginza2_admin_order'])) {
			$this->data['loginza2_admin_order'] = $this->request->post['loginza2_admin_order'];
		} elseif ($this->config->has('loginza2_admin_order')) { 
			$this->data['loginza2_admin_order'] = $this->config->get('loginza2_admin_order');
		} else {
			$this->data['loginza2_admin_order'] = 1;
		}
		
		if (isset($this->request->post['loginza2_admin_order_list'])) {
			$this->data['loginza2_admin_order_list'] = $this->request->post['loginza2_admin_order_list'];
		} elseif ($this->config->has('loginza2_admin_order_list')) { 
			$this->data['loginza2_admin_order_list'] = $this->config->get('loginza2_admin_order_list');
		} else {
			$this->data['loginza2_admin_order_list'] = 1;
		}
		
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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
			'href'      => $this->url->link('module/loginza2', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/loginza2', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['loginza2_admin'])) {
			$this->data['loginza2_admin'] = $this->request->post['loginza2_admin'];
		} else {
			$this->data['loginza2_admin'] = $this->config->get('loginza2_admin');
		}	
			
		$this->data['modules'] = array();
		
		if (isset($this->request->post['loginza2_module'])) {
			$this->data['modules'] = $this->request->post['loginza2_module'];
		} elseif ($this->config->get('loginza2_module')) { 
			$this->data['modules'] = $this->config->get('loginza2_module');
		}
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
				
		$this->template = 'module/loginza2.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/loginza2')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach( $this->socnets as $socnet=>$label )
		{
			if( empty( $this->request->post['loginza2_'.$socnet] ) )
			{
				$this->request->post['loginza2_'.$socnet] = 'n';
			}
		}
		
		if( !empty( $this->request->post['loginza2_widget_id'] ) )
		{
			$this->request->post['loginza2_widget_id'] = trim($this->request->post['loginza2_widget_id']);
		}
		
		if( !empty( $this->request->post['loginza2_widget_sig'] ) )
		{
			$this->request->post['loginza2_widget_sig'] = trim($this->request->post['loginza2_widget_sig']);
		}
		
		
		
		if (!$this->error) {
			
			if( empty($this->request->post['loginza2_admin_customer']) )
			$this->request->post['loginza2_admin_customer'] = 0;
			
			if( empty($this->request->post['loginza2_admin_customer_list']) )
			$this->request->post['loginza2_admin_customer_list'] = 0;
			
			if( empty($this->request->post['loginza2_admin_order']) )
			$this->request->post['loginza2_admin_order'] = 0;
			
			if( empty($this->request->post['loginza2_admin_order_list']) )
			$this->request->post['loginza2_admin_order_list'] = 0;
			
			if( empty($this->request->post['loginza2_show_standart_auth']) )
			$this->request->post['loginza2_show_standart_auth'] = 0;
			
			//if( !empty($this->request->post['loginza2_module']) )
			//$this->request->post['loginza2_module'] = serialize( $this->request->post['loginza2_module'] );
			
			$code = '<!-- start loginza --><script src="/catalog/view/javascript/jquery/loginza2-widget.js" type="text/javascript"></script><!-- end loginza -->';
			
			$this->request->post = $this->model_module_loginza2->makeCode($this->request->post, $this->socnets);
		
			if( $this->request->post['loginza2_showtype']=='window' && $this->config->get('loginza2_showtype')!='window' )
			{ 
				$this->request->post['config_google_analytics'] = $this->config->get('config_google_analytics').$code;
			}
			elseif( $this->request->post['loginza2_showtype']=='window' && $this->config->get('loginza2_showtype')=='window' )
			{
				//none
			}
			elseif( $this->request->post['loginza2_showtype']!='window' && $this->config->get('loginza2_showtype')=='window' )
			{
				$this->request->post['config_google_analytics'] = str_replace($code, "", 
																  $this->config->get('config_google_analytics'));
			}
			elseif( $this->request->post['loginza2_showtype']!='window' && !$this->config->get('loginza2_showtype')!='window' )
			{
				//none
			}
		
			return true;
		} else {
			return false;
		}	
	}
}
?>