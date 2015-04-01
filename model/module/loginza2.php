<?php
class Modelmoduleloginza2 extends Model 
{
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
				'last.fm'       => 'Last.FM', 
				'verisign'      => 'Verisign.com', 
				'aol'			=> 'Aol.com',	
				'steam'			=> 'Steam', 
				'openid'		=> 'OpenID'
	);
	

	public function addFields() 
	{
		$query = $this->db->query("SELECT * FROM information_schema.COLUMNS
								   WHERE TABLE_NAME = '" . DB_PREFIX . "customer'");
								   
		$column_hash = array();
		
		foreach($query->rows as $row )
		{
			if( $row['TABLE_SCHEMA'] == DB_DATABASE || $row['TABLE_SCHEMA'] == DB_PREFIX.DB_DATABASE )
			{
				$column_hash[ $row['COLUMN_NAME'] ] = 1;
			}
		}
		
		if( !isset( $column_hash['loginza2_identity'] ) )
		{
			$sql = "ALTER TABLE `" . DB_PREFIX . "customer` ADD `loginza2_identity` VARCHAR( 300 ) NOT NULL";
			$this->db->query($sql);
		}
		
		/* start metka a1 */
		if( !isset( $column_hash['loginza2_link'] ) )
		{
			$sql = "ALTER TABLE `" . DB_PREFIX . "customer` ADD `loginza2_link` VARCHAR( 100 ) NOT NULL";
			$this->db->query($sql);
		}
		/* end metka a1 */
		
		if( !isset( $column_hash['loginza2_provider'] ) )
		{
			$sql = "ALTER TABLE `" . DB_PREFIX . "customer` ADD `loginza2_provider` VARCHAR( 100 ) NOT NULL";
			$this->db->query($sql);
		}
		
		if( !isset( $column_hash['loginza2_data'] ) )
		{
			$sql = "ALTER TABLE `" . DB_PREFIX . "customer` ADD `loginza2_data` TEXT NOT NULL";
			$this->db->query($sql);
		}
	}
	
	public function makeCode($data, $socnets)
	{
		if( !$data['loginza2_status'] )
		{
			$data['loginza_simple_code'] = '';
			$data['loginza_account_top_code'] = '';
			$data['loginza_account_bottom_code'] = '';
			$data['loginza_checkout_top_code'] = '';
			$data['loginza_checkout_bottom_code'] = '';
			
			return $data;
		}
		
			
		$res_socnets = array();
		$res_socnets2 = array();
			
		foreach($socnets as $socnet=>$label)
		{			
			$vr = $data['loginza2_'.$socnet];
			if( $vr == 'y' ) 
			{
				$res_socnets[] = array( 'name'=>$socnet, 
										'label'=>$label );
				$res_socnets2[] = $socnet;
				
			}
		}
		
		$providers = implode(",", $res_socnets2);
			
		$template = new Template();
		$template->data['providers'] = $providers;
		$template->data['res_socnets'] = $res_socnets;
		$template->data['loginza2_default'] = $data['loginza2_default'];
		$template->data['loginza2_format'] = $data['loginza2_format'];
		$template->data['loginza2_label'] = $data['loginza2_label'];
		$template->data['loginza2_showtype'] = $data['loginza2_showtype'];
		
		
		if( $data['loginza2_showtype']=='window' )
		{
			$template->data['classname'] = 'loginza';	
		}
		else
		{
			$template->data['classname'] = '';
		}
		
		
		
		$data['loginza_simple_code'] = $template->fetch('module/loginza2_blocks/loginza2_simple.tpl');
		$data['loginza_account_code'] = $template->fetch('module/loginza2_blocks/loginza2_account.tpl');
		$data['loginza_checkout_code'] = $template->fetch('module/loginza2_blocks/loginza2_checkout.tpl');
		/* update metka: a1 */
		$data['loginza2_confirm_block'] = $template->fetch('module/loginza2_blocks/loginza2_confirm.tpl');
		/* end update metka: a1 */
		return $data;
	}
	
	public function updateSetting($group='', $key, $value)
	{
		$query = $this->db->query("UPDATE ".DB_PREFIX."setting
								   SET 
									value = '".$value."'
								   WHERE
									`group`='".$group."' AND `key`='".$key."'");
	}
	
	
	
	public function showData()
	{
		$tab = 'customer';
		$customer_id = 0;
		
		if( !empty($this->request->get['customer_id']) )
		{
			$customer_id = $this->request->get['customer_id'];
			
			
			if( !$this->config->get('loginza2_admin_customer') ) return;
			
		}
		elseif( !empty($this->request->get['order_id']) )
		{
			$this->load->model('sale/order');
			$order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
			
			if( !empty($order_info['customer_id']) )
			{
				$customer_id = $order_info['customer_id'];
				
				if( $this->request->get['route']=='sale/order/info' )
				$tab = 'order';
			}
			
			if( empty($customer_id) ) return;
			if( !$this->config->get('loginza2_admin_order') ) return;
		}
		elseif( $this->request->get['route']=='sale/customer' )
		{
			$tab = 'customer_list';
			$customer_id = '';
			if( !$this->config->get('loginza2_admin_customer_list') ) return;
		}
		elseif( $this->request->get['route']=='sale/order' )
		{
			$tab = 'order_list';
			$customer_id = '';
			if( !$this->config->get('loginza2_admin_order_list') ) return;
		}
				
		
		$hash_values = array(
			"identity" => "Идентификатор:",
			"provider" => "Провайдер:",
			"uid" => "uid:",
			"nickname" => "Логин:",
			"email" => "E-mail:",
			"country" => 'Страна:',
			"postal_code" => 'Почтовый индекс:',
			"state" => 'Область/регион:',
			"city" => 'Город:',
			"street_address" => 'Адрес:',
			"gender" => "Пол:",
			"photo" => "Фото:",
			"name" => "Имя:",
			"full_name" => "ФИО:",
			"first_name" => "Имя:",
			"last_name" => "Фамилия:",
			"middle_name" => "Отчество:",
			"dob" => "Дата рождения:",
			"work" => "Работа:",
			"company" => "Название компании:",
			"job" => "Профессия или должность:",
			"home" => "Домашний адрес:",
			"business" => "Рабочий адрес:",
			"phone" => "Телефон:",
			"preferred" => "Номер телефона указанный по умолчанию:",
			"home" => "Домашний телефон:",
			"work" => "Рабочий телефон:",
			"mobile" => "Мобильный телефон:",
			"fax" => "Факс:",
			"im" => "Массив с аккаунтами для связи:",
			"icq" => "Номер ICQ аккаунта:",
			"jabber" => "Jabber аккаунт:",
			"skype" => "Skype аккаунт:",
			"web" => "Массив содержащий адреса сайтов пользователя:",
			"default" => "Адрес профиля или персональной страницы:",
			"blog" => "Адрес блога:",
			"language" => "Язык:",
			"timezone" => "Временная зона:",
			"biography" => "Другая информация о пользователе и его интересах:"
		);
		
		if( $customer_id )
		{ 
			$data = '';
			$customer = $this->model_sale_customer->getCustomer($customer_id);
			
			if( !empty($customer['loginza2_data']) )
			{
				$data = '<script>';
			
				$data_arr = unserialize( $customer['loginza2_data'] );
				$loginza_data = '';
				
				$data_arr['provider'] = $customer['loginza2_provider'];
			
				foreach($data_arr as $key=>$val)
				{
					if( !is_array($val) )
					{
						if( $key=='photo' && $val )
						{
							$val = '<img src="'.$val.'">';
						}
						elseif( preg_match("/^http/", $val) )
						{
							$val = '<a href="'.$val.'" target=_blank>'.$val.'</a>';
						}
						
						if($val=='')
						{
							$val = '(пусто)';
						}
						
						if( !empty($hash_values[$key]) )
						$key = $hash_values[$key];
						
						$loginza_data .= '<b>'.$key."</b> ".$val."<br>";
					}
					else
					{
						foreach($val as $k=>$v)
						{
							if( !is_array($v) )
							{
								if( $v=='' )
								{
									$v = '(пусто)';
								}
								elseif( preg_match("/^http/", $v) )
								{
									$v = '<a href="'.$v.'" target=_blank>'.$v.'</a>';
								}
						
								if( !empty($hash_values[$k]) )
								$k = $hash_values[$k];
								
								$loginza_data .= '<b>'.$k."</b> ".$v."<br>";
							}
							else
							{
								foreach($v as $k2=>$v2)
								{
									if( $v2=='' )
									{
										$v2 = '(пусто)';
									}
									elseif( preg_match("/^http/", $v2) )
									{
										$v2 = '<a href="'.$v2.'" target=_blank>'.$v2.'</a>';
									}
								
									if( !empty($hash_values[$k2]) )
									$k2 = $hash_values[$k2];
									
									$loginza_data .= '<b>'.$k2."</b> ".$v2."<br>";
								}
							}
						}
					}
				}
			
				$text = "<tbody><tr><td>Loginza:</td><td>".$loginza_data."</td></tr></tbody>";
				
				$data .= "$('#tab-".$tab." .form tbody').after('".$text."');";
			
				
				
				$data .= "var ID = '';
					$('.list').find('tr').each(function(e) {
					
					
					if( e==0 )
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 2)
							{
								$(this).after('<td>Провайдер</td>');
							}
						});
					}
	
					if( e==1 )
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 2)
							{
								$(this).after('<td></td>');
							}
						});
					}
	
					if(e>1)
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 0 )
							{
								ID = $(this).find('input').attr('value');
								//alert( $(this).find('input').attr('value') );
							}
		
							if( i == 2)
							{
								//var cur = $(this).text();
				
								$(this).after('<td>1212</td>');
				
								//$(this).text( cur + ID );
							}
						});
					}
				});
				</script>   ";
				
			}
			
			
			return $data;
		}
		elseif( $tab == 'customer_list' )
		{
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = null;
			}

			if (isset($this->request->get['filter_email'])) {
				$filter_email = $this->request->get['filter_email'];
			} else {
				$filter_email = null;
			}
		
			if (isset($this->request->get['filter_customer_group_id'])) {
				$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
			} else {
				$filter_customer_group_id = null;
			}

			if (isset($this->request->get['filter_status'])) {
				$filter_status = $this->request->get['filter_status'];
			} else {
				$filter_status = null;
			}
		
			if (isset($this->request->get['filter_approved'])) {
				$filter_approved = $this->request->get['filter_approved'];
			} else {
				$filter_approved = null;
			}
			
			if (isset($this->request->get['filter_ip'])) {
				$filter_ip = $this->request->get['filter_ip'];
			} else {
				$filter_ip = null;
			}
				
			if (isset($this->request->get['filter_date_added'])) {
				$filter_date_added = $this->request->get['filter_date_added'];
			} else {
				$filter_date_added = null;
			}		
		
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'name'; 
			}
		
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
		
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
		
			$data_filter = array(
				'filter_name'              => $filter_name, 
				'filter_email'             => $filter_email, 
				'filter_customer_group_id' => $filter_customer_group_id, 
				'filter_status'            => $filter_status, 
				'filter_approved'          => $filter_approved, 
				'filter_date_added'        => $filter_date_added,
				'filter_ip'                => $filter_ip,
				'sort'                     => $sort,
				'order'                    => $order,
				'start'                    => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit'                    => $this->config->get('config_admin_limit')
			);
		
			$customer_total = $this->model_sale_customer->getTotalCustomers($data_filter);
	
			$results = $this->model_sale_customer->getCustomers($data_filter);
			
		
			$data = '<script>';
			
			$data .= "var ID = '';
					$('.list').find('tr').each(function(e) {
					
					var items_hash = new Array();";
			
			foreach($results as $res)
			{

				if( !empty($res['loginza2_provider']) )
				{
					if( empty($res['loginza2_link']) )
					{
						$data .= " items_hash[".$res['customer_id']."] = '".$this->socnets[ $res['loginza2_provider'] ]."';";
					}
					else
					{
						$data .= " items_hash[".$res['customer_id']."] = '<a href=\"".$res['loginza2_link']."\" target=_blank>".$this->socnets[ $res['loginza2_provider'] ]."</a>';";
					}					
				}
				else
					$data .= " items_hash[".$res['customer_id']."] = '';";
			}
					
			/* start metka: a1 */
			$data .= "
					
					if( e==0 )
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 2)
							{
								$(this).after('<td>Провайдер</td>');
							}
						});
					}
	
					if( e==1 )
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 2)
							{
								$(this).after('<td></td>');
							}
						});
					}
	
					if(e>1)
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 0 )
							{
								ID = $(this).find('input').attr('value');
								//alert( $(this).find('input').attr('value') );
							}
		
							if( i == 2)
							{
								$(this).after('<td>'+items_hash[ID]+'</td>');
							}
						});
					}
				});
				</script>   ";
			/* end metka: a1 */
				
			return $data;
		}
		elseif( $tab == 'order_list' )
		{
			if (isset($this->request->get['filter_order_id'])) {
				$filter_order_id = $this->request->get['filter_order_id'];
			} else {
				$filter_order_id = null;
			}

			if (isset($this->request->get['filter_customer'])) {
				$filter_customer = $this->request->get['filter_customer'];
			} else {
				$filter_customer = null;
			}

			if (isset($this->request->get['filter_order_status_id'])) {
				$filter_order_status_id = $this->request->get['filter_order_status_id'];
			} else {
				$filter_order_status_id = null;
			}
		
			if (isset($this->request->get['filter_total'])) {
				$filter_total = $this->request->get['filter_total'];
			} else {
				$filter_total = null;
			}
			
			if (isset($this->request->get['filter_date_added'])) {
				$filter_date_added = $this->request->get['filter_date_added'];
			} else {
				$filter_date_added = null;
			}
		
			if (isset($this->request->get['filter_date_modified'])) {
				$filter_date_modified = $this->request->get['filter_date_modified'];
			} else {
				$filter_date_modified = null;
			}

			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'o.order_id';
			}

			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'DESC';
			}
		
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
			
			
			$data_filter = array(
				'filter_order_id'        => $filter_order_id,
				'filter_customer'	     => $filter_customer,
				'filter_order_status_id' => $filter_order_status_id,
				'filter_total'           => $filter_total,
				'filter_date_added'      => $filter_date_added,
				'filter_date_modified'   => $filter_date_modified,
				'sort'                   => $sort,
				'order'                  => $order,
				'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit'                  => $this->config->get('config_admin_limit')
			);

			$this->load->model('sale/order');

			$results = $this->model_sale_order->getOrders($data_filter);
			
			$data = '<script>';
			
			$data .= "var ID = '';
					$('.list').find('tr').each(function(e) {
					
					var items_hash = new Array();";
			
			foreach($results as $res)
			{
				$order = $this->model_sale_order->getOrder( $res['order_id'] );
				
				if( !empty($order['customer_id']) )
				{
					$cust = $this->model_sale_customer->getCustomer( $order['customer_id'] );
					
					if( !empty( $cust['loginza2_provider'] ) )
					{
						if( empty( $cust['loginza2_link'] ) )
						$data .= " items_hash[".$res['order_id']."] = '".$this->socnets[ $cust['loginza2_provider'] ]."';";
						else
						$data .= " items_hash[".$res['order_id']."] = '<a href=\"".$cust['loginza2_link']."\" target=_blank>".$this->socnets[ $cust['loginza2_provider'] ]."</a>';";
					}
					else
					{
						$data .= " items_hash[".$res['order_id']."] = '';";
					}
				}
				else
				{
					$data .= " items_hash[".$res['order_id']."] = '';";
				}
			}
					
			/* start metka: a1 */		
			$data .= "
					
					if( e==0 )
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 2)
							{
								$(this).after('<td>Провайдер</td>');
							}
						});
					}
	
					if( e==1 )
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 2)
							{
								$(this).after('<td></td>');
							}
						});
					}
	
					if(e>1)
					{
						$(this).find('td').each(function(i) 
						{
							if( i == 0 )
							{
								ID = $(this).find('input').attr('value');
								//alert( $(this).find('input').attr('value') );
							}
		
							if( i == 2)
							{
								$(this).after('<td>'+items_hash[ID]+'</td>');
							}
						});
					}
				});
				</script>   ";
			/* end metka: a1 */
				
			return $data;
		}
	}
}
?>