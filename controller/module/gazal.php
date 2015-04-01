<?php

class ControllerModulegazal extends Controller {
    
    private $error = array(); 
    
    public function index() {   
        //Load the language file for this module
        $language = $this->load->language('module/gazal');
        $this->data = array_merge($this->data, $language);

        //Set the title from the language file $_['heading_title'] string
        $this->document->setTitle($this->language->get('heading_title'));
        
        //Load the settings model. You can also add any other models you want to load here.
        $this->load->model('setting/setting');
        
        $this->load->model('tool/image');    
        
        //Save the settings if the user has submitted the admin form (ie if someone has pressed save).
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('gazal', $this->request->post);    

                
                    
            $this->session->data['success'] = $this->language->get('text_success');
        
                        
            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
            $this->data['text_image_manager'] = 'Image manager';
                    $this->data['token'] = $this->session->data['token'];       
        
        $text_strings = array(
                'heading_title',
                'text_enabled',
                'text_disabled',
                'text_content_top',
                'text_content_bottom',
                'text_column_left',
                'text_column_right',
                'entry_status',
                'entry_sort_order',
                'button_save',
                'button_cancel',
        );
        
        foreach ($text_strings as $text) {
            $this->data[$text] = $this->language->get($text);
        }
        

        // store config data
        
        $config_data = array(

        'gazal_status',
		
		//====================================================================================================== BODY
		//-------------------------------------------------------------- body
        'gazal_background_color',
		'gazal_pattern_overlay',		
        'gazal_custom_image',		
        'gazal_custom_pattern',		
        'gazal_image_preview',		
        'gazal_pattern_preview',	
		
		//====================================================================================================== CONTAINER
		//------------------------------------------------------------- container
		'gazal_background_color_cont',
		'gazal_custom_image_cont',
		'gazal_custom_pattern_cont',
		'gazal_pattern_cont',
		
		//====================================================================================================== COLORS
		
		//------------------------------------------------------------- header
		'gazal_thickbar_color',
		'gazal_welcome_text_color',
		
		//------------------------------------------------------------- blocks
		'gazal_block_title_color',
		'gazal_block_desc_color',
		
		//------------------------------------------------------------- Menu
		'gazal_sub_menu_heading',
		'gazal_menu_bg_links_hover',
		'gazal_menu_background',
		'gazal_menu_border',
		'gazal_menu_color',
		'gazal_smenu_color',
		'gazal_smenuh_color',
		
		//------------------------------------------------------------ cart
		'gazal_cart_title_color',
		'gazal_cart_desc_color',
		
		//------------------------------------------------------------- Search
		'gazal_search_bg',
		'gazal_search_border',
		
		//------------------------------------------------------------- Category
		'gazal_category_heading_bg',
		'gazal_category_heading_border',
		'gazal_category_heading_color',
		'gazal_category_link_color',
		'gazal_category_link_color_hover',
		'gazal_category_title',
		
		//------------------------------------------------------------- Box
		'gazal_heading_bg',
		'gazal_heading_border',
		'gazal_heading_color',
		'gazal_heading_tabs_bg',
		'gazal_heading_tabs_border',
		'gazal_prodbcat_title',
		'gazal_prodbcat_viewall',
		'gazal_prodbcat_tab_bg',
		'gazal_prodbcat_tab_bg_select',
		'gazal_prodbcat_tab_link',
		
		//------------------------------------------------------------- product
		'gazal_product_border',
		'gazal_sale_bg',
		'gazal_price_color',
		'gazal_other_oldprice_color',
		'gazal_product_name_color',
		
		//------------------------------------------------------------- general
		'gazal_title_color',
		'gazal_links_color',
		
		//------------------------------------------------------------- footer
		'gazal_footerheaders_color',
		'gazal_footerheaderswid_color',
		'gazal_footerheaderswid_bg',
		'gazal_footerheaderswid_border',
		'gazal_first_border_color',
		'gazal_second_border_color',
		'gazal_footer_info_color',
		'gazal_footerlinks_color',
		'gazal_footer_bg',
		'gazal_footer_bottom_bg',
		'footer_info_title',
		'facebook_bg_color',
		
		//====================================================================================================== FONTS
		'gazal_title_font',
		'gazal_title_font_family',
		'gazal_title_font_size',
		
        'gazal_body_font',
		'gazal_body_font_family',
		'gazal_body_font_size',
		
		'gazal_button_font',
		'gazal_button_font_family',
		'gazal_button_font_size',
		
        'gazal_category_font',
		'gazal_category_font_family',
		'gazal_category_font_size',
		
		'gazal_menu_font',
		'gazal_menu_font_family',
		'gazal_menu_font_size',
		
		'gazal_product_font',
		'gazal_product_font_family',
		'gazal_product_font_size',
		
		'gazal_price_font',
		'gazal_price_font_family',
		'gazal_price_font_size',
		
		'gazal_boxheading_font',
		'gazal_boxheading_font_family',
		'gazal_boxheading_font_size',
		
		//====================================================================================================== BUTTON
		'gazal_details_addtocart',
		'gazal_details_addtocart_hover',
		'gazal_details_button_color',
		
		//======================================================================================================= CUSTOM Settings
		//top
		'gazal_facebook_id',
        'gazal_twitter_username',
		'consumer_keyy',
		'consumer_secrett',
		'access_token',
		'token_secret',
		'custom_css',
		//social icons
		'gazal_facebook_link',
		'gazal_twitter_link',
		'gazal_google_link',
		'gazal_youtube_link',
		'gazal_linkedin_link',
		'gazal_digg_link',
		'gazal_dribbble_link',
		'gazal_flickr_link',
		'gazal_pinterest_link',
		'gazal_skype_link',
		'gazal_vimeo_link',
		'gazal_rss_link',
		//
		//'gazal_time_text',
		//blocks
		'gazal_firstblock_img',
	//	'gazal_firstblock_title',
	//	'gazal_firstblock_desc',
		'gazal_secondblock_img',
	//	'gazal_secondblock_title',
	//	'gazal_secondblock_desc',
		'gazal_thirdblock_img',
	//	'gazal_thirdblock_title',
	//	'gazal_thirdblock_desc',
		'gazal_fourthblock_img',
	//	'gazal_fourthblock_title',
	//	'gazal_fourthblock_desc',
		//contact
		'gazal_contact_img',
		//'gazal_address',
		'gazal_phone',
		'gazal_phone_second',
		'gazal_email',
		'gazal_email_second',
		//custom widget
		//'gazal_custom_widget_title',
		//'gazal_footer_info_text',
		//'gazal_shipping_text',
		//'gazal_shipping_first_text',
		//'gazal_shipping_last_text',
		'gazal_cus_img',
		//payment
		'gazal_pay1_img',
		'gazal_pay2_img',
		'gazal_pay3_img',
		'gazal_pay4_img',
		'gazal_pay5_img',
		'gazal_pay6_img',
		'gazal_pay7_img',
		'gazal_pay8_img',
		'gazal_pay9_img',
		'gazal_pay10_img',
		'gazal_pay1_link',
		'gazal_pay2_link',
		'gazal_pay3_link',
		'gazal_pay4_link',
		'gazal_pay5_link',
		'gazal_pay6_link',
		'gazal_pay7_link',
		'gazal_pay8_link',
		'gazal_pay9_link',
		'gazal_pay10_link',
		'gazal_pay1_preview',
		'gazal_pay2_preview',
		'gazal_pay3_preview',
		'gazal_pay4_preview',
		'gazal_pay5_preview',
		'gazal_pay6_preview',
		'gazal_pay7_preview',
		'gazal_pay8_preview',
		'gazal_pay9_preview',
		'gazal_pay10_preview',
		//others
		'option_slideshow',
		
		
		
		'gazal_breadcrumb_color',
		'gazal_second_color',
		'gazal_lines_color',
		
		'gazal_toplinks_color',
        
		'gazal_title_color_hover',
        'gazal_bodytext_color',
        'gazal_lighttext_color',
        
        
		
		'gazal_cart_text_color',
		
		
		
		'gazal_all_addtocart',
		'gazal_all_addtocart_hover',
	    
		'gazal_menu_color_hover',
		


		'gazal_language_text_color',
		'gazal_currency_text_color',
        
		'gazal_all_buttons_color',
		'gazal_heading_bgcolor',
        'gazal_copyright',


        );
		
		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
        
        foreach ($config_data as $conf) {
            if (isset($this->request->post[$conf])) {
                $this->data[$conf] = $this->request->post[$conf];
            } else {
                $this->data[$conf] = $this->config->get($conf);
            }
        }
		
		// Start Translations
		foreach ($languages as $language) {
			 
		//==== timer
		if (isset($this->request->post['gazal_time_text_' . $language['language_id']])) {
		$this->data['gazal_time_text_'. $language['language_id']] = $this->request->post['gazal_time_text_'. $language['language_id']];
		} else {
		$this->data['gazal_time_text_'. $language['language_id']] = $this->config->get('gazal_time_text_'. $language['language_id']);
		}
		
		//==== blocks
		if (isset($this->request->post['gazal_firstblock_title_' . $language['language_id']])) {
		$this->data['gazal_firstblock_title_'. $language['language_id']] = $this->request->post['gazal_firstblock_title_'. $language['language_id']];
		} else {
		$this->data['gazal_firstblock_title_'. $language['language_id']] = $this->config->get('gazal_firstblock_title_'. $language['language_id']);
		}
		if (isset($this->request->post['gazal_firstblock_desc_' . $language['language_id']])) {
		$this->data['gazal_firstblock_desc_'. $language['language_id']] = $this->request->post['gazal_firstblock_desc_'. $language['language_id']];
		} else {
		$this->data['gazal_firstblock_desc_'. $language['language_id']] = $this->config->get('gazal_firstblock_desc_'. $language['language_id']);
		}
		//
		if (isset($this->request->post['gazal_secondblock_title_' . $language['language_id']])) {
		$this->data['gazal_secondblock_title_'. $language['language_id']] = $this->request->post['gazal_secondblock_title_'. $language['language_id']];
		} else {
		$this->data['gazal_secondblock_title_'. $language['language_id']] = $this->config->get('gazal_secondblock_title_'. $language['language_id']);
		}
		if (isset($this->request->post['gazal_secondblock_desc_' . $language['language_id']])) {
		$this->data['gazal_secondblock_desc_'. $language['language_id']] = $this->request->post['gazal_secondblock_desc_'. $language['language_id']];
		} else {
		$this->data['gazal_secondblock_desc_'. $language['language_id']] = $this->config->get('gazal_secondblock_desc_'. $language['language_id']);
		}
		//
		if (isset($this->request->post['gazal_thirdblock_title_' . $language['language_id']])) {
		$this->data['gazal_thirdblock_title_'. $language['language_id']] = $this->request->post['gazal_thirdblock_title_'. $language['language_id']];
		} else {
		$this->data['gazal_thirdblock_title_'. $language['language_id']] = $this->config->get('gazal_thirdblock_title_'. $language['language_id']);
		}
		if (isset($this->request->post['gazal_thirdblock_desc_' . $language['language_id']])) {
		$this->data['gazal_thirdblock_desc_'. $language['language_id']] = $this->request->post['gazal_thirdblock_desc_'. $language['language_id']];
		} else {
		$this->data['gazal_thirdblock_desc_'. $language['language_id']] = $this->config->get('gazal_thirdblock_desc_'. $language['language_id']);
		}
		//
		if (isset($this->request->post['gazal_fourthblock_title_' . $language['language_id']])) {
		$this->data['gazal_fourthblock_title_'. $language['language_id']] = $this->request->post['gazal_fourthblock_title_'. $language['language_id']];
		} else {
		$this->data['gazal_fourthblock_title_'. $language['language_id']] = $this->config->get('gazal_fourthblock_title_'. $language['language_id']);
		}
		if (isset($this->request->post['gazal_fourthblock_desc_' . $language['language_id']])) {
		$this->data['gazal_fourthblock_desc_'. $language['language_id']] = $this->request->post['gazal_fourthblock_desc_'. $language['language_id']];
		} else {
		$this->data['gazal_fourthblock_desc_'. $language['language_id']] = $this->config->get('gazal_fourthblock_desc_'. $language['language_id']);
		}
		//
		
		// ==== Footer
		if (isset($this->request->post['gazal_custom_widget_title_' . $language['language_id']])) {
		$this->data['gazal_custom_widget_title_'. $language['language_id']] = $this->request->post['gazal_custom_widget_title_'. $language['language_id']];
		} else {
		$this->data['gazal_custom_widget_title_'. $language['language_id']] = $this->config->get('gazal_custom_widget_title_'. $language['language_id']);
		}
		//
		if (isset($this->request->post['gazal_footer_info_text_' . $language['language_id']])) {
		$this->data['gazal_footer_info_text_'. $language['language_id']] = $this->request->post['gazal_footer_info_text_'. $language['language_id']];
		} else {
		$this->data['gazal_footer_info_text_'. $language['language_id']] = $this->config->get('gazal_footer_info_text_'. $language['language_id']);
		}
		//
		if (isset($this->request->post['gazal_shipping_text_' . $language['language_id']])) {
		$this->data['gazal_shipping_text_'. $language['language_id']] = $this->request->post['gazal_shipping_text_'. $language['language_id']];
		} else {
		$this->data['gazal_shipping_text_'. $language['language_id']] = $this->config->get('gazal_shipping_text_'. $language['language_id']);
		}
		//
		if (isset($this->request->post['gazal_shipping_last_text_' . $language['language_id']])) {
		$this->data['gazal_shipping_last_text_'. $language['language_id']] = $this->request->post['gazal_shipping_last_text_'. $language['language_id']];
		} else {
		$this->data['gazal_shipping_last_text_'. $language['language_id']] = $this->config->get('gazal_shipping_last_text_'. $language['language_id']);
		}
		//
		if (isset($this->request->post['gazal_address_' . $language['language_id']])) {
		$this->data['gazal_address_'. $language['language_id']] = $this->request->post['gazal_address_'. $language['language_id']];
		} else {
		$this->data['gazal_address_'. $language['language_id']] = $this->config->get('gazal_address_'. $language['language_id']);
		}
		} //
    
        //This creates an error message. The error['warning'] variable is set by the call to function validate() in this controller (below)
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
        
        //SET UP BREADCRUMB TRAIL. YOU WILL NOT NEED TO MODIFY THIS UNLESS YOU CHANGE YOUR MODULE NAME.
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
            'href'      => $this->url->link('module/gazal', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        
        $this->data['action'] = $this->url->link('module/gazal', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

    
        //This code handles the situation where you have multiple instances of this module, for different layouts.
        if (isset($this->request->post['gazal_module'])) {
            $modules = explode(',', $this->request->post['gazal_module']);
        } elseif ($this->config->get('gazal_module') != '') {
            $modules = explode(',', $this->config->get('gazal_module'));
        } else {
            $modules = array();
        }           
                
        $this->load->model('design/layout');
        
        $this->data['layouts'] = $this->model_design_layout->getLayouts();
                
        foreach ($modules as $module) {
            if (isset($this->request->post['gazal_' . $module . '_layout_id'])) {
                $this->data['gazal_' . $module . '_layout_id'] = $this->request->post['gazal_' . $module . '_layout_id'];
            } else {
                $this->data['gazal_' . $module . '_layout_id'] = $this->config->get('gazal_' . $module . '_layout_id');
            }   
            
            if (isset($this->request->post['gazal_' . $module . '_position'])) {
                $this->data['gazal_' . $module . '_position'] = $this->request->post['gazal_' . $module . '_position'];
            } else {
                $this->data['gazal_' . $module . '_position'] = $this->config->get('gazal_' . $module . '_position');
            }   
            
            if (isset($this->request->post['gazal_' . $module . '_status'])) {
                $this->data['gazal_' . $module . '_status'] = $this->request->post['gazal_' . $module . '_status'];
            } else {
                $this->data['gazal_' . $module . '_status'] = $this->config->get('gazal_' . $module . '_status');
            }   
                        
            if (isset($this->request->post['gazal_' . $module . '_sort_order'])) {
                $this->data['gazal_' . $module . '_sort_order'] = $this->request->post['gazal_' . $module . '_sort_order'];
            } else {
                $this->data['gazal_' . $module . '_sort_order'] = $this->config->get('gazal_' . $module . '_sort_order');
            }               
        }
        

        
        $this->data['modules'] = $modules;
        
        if (isset($this->request->post['gazal_module'])) {
            $this->data['gazal_module'] = $this->request->post['gazal_module'];
        } else {
            $this->data['gazal_module'] = $this->config->get('gazal_module');
        }

        //Choose which template file will be used to display this request.
        $this->data['languages'] = $languages;
        $this->template = 'module/gazal.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
		
        if (isset($this->data['gazal_custom_pattern']) && $this->data['gazal_custom_pattern'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_pattern'])) {
            $this->data['gazal_pattern_preview'] = $this->model_tool_image->resize($this->data['gazal_custom_pattern'], 70, 70);
        } else {
            $this->data['gazal_pattern_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }
        
        
        if (isset($this->data['gazal_custom_image']) && $this->data['gazal_custom_image'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_image'])) {
            $this->data['gazal_image_preview'] = $this->model_tool_image->resize($this->data['gazal_custom_image'], 70, 70);
        } else {
            $this->data['gazal_image_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		
		
		
/////////////////// header //////////////////	
		
			
		 if (isset($this->data['gazal_custom_pattern_head']) && $this->data['gazal_custom_pattern_head'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_pattern_head'])) {
            $this->data['gazal_pattern_preview_head'] = $this->model_tool_image->resize($this->data['gazal_custom_pattern_head'], 70, 70);
        } else {
            $this->data['gazal_pattern_preview_head'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }
        
			
        
        if (isset($this->data['gazal_custom_image_head']) && $this->data['gazal_custom_image_head'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_image'])) {
            $this->data['gazal_image_preview_head'] = $this->model_tool_image->resize($this->data['gazal_custom_image_head'], 70, 70);
        } else {
            $this->data['gazal_image_preview_head'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		
		
		
		

/////////////////// footerTop //////////////////	
		
			
		 if (isset($this->data['gazal_custom_pattern_footerTop']) && $this->data['gazal_custom_pattern_footerTop'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_pattern_footerTop'])) {
            $this->data['gazal_pattern_preview_footerTop'] = $this->model_tool_image->resize($this->data['gazal_custom_pattern_footerTop'], 70, 70);
        } else {
            $this->data['gazal_pattern_preview_footerTop'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }
        
		
        
        if (isset($this->data['gazal_custom_image_footerTop']) && $this->data['gazal_custom_image_footerTop'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_image'])) {
            $this->data['gazal_image_preview_footerTop'] = $this->model_tool_image->resize($this->data['gazal_custom_image_footerTop'], 70, 70);
        } else {
            $this->data['gazal_image_preview_footerTop'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);		




/////////////////// footer //////////////////	
		
			
		 if (isset($this->data['gazal_custom_pattern_footer']) && $this->data['gazal_custom_pattern_footer'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_pattern_footer'])) {
            $this->data['gazal_pattern_preview_footer'] = $this->model_tool_image->resize($this->data['gazal_custom_pattern_footer'], 70, 70);
        } else {
            $this->data['gazal_pattern_preview_footer'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }
        
		
        
        if (isset($this->data['gazal_custom_image_footer']) && $this->data['gazal_custom_image_footer'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_image'])) {
            $this->data['gazal_image_preview_footer'] = $this->model_tool_image->resize($this->data['gazal_custom_image_footer'], 70, 70);
        } else {
            $this->data['gazal_image_preview_footer'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);				
		
		
		
		
/////////////////// container //////////////////		
		
		
		 if (isset($this->data['gazal_custom_pattern_cont']) && $this->data['gazal_custom_pattern_cont'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_pattern_cont'])) {
            $this->data['gazal_pattern_preview_cont'] = $this->model_tool_image->resize($this->data['gazal_custom_pattern_cont'], 70, 70);
        } else {
            $this->data['gazal_pattern_preview_cont'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }
        
        
        if (isset($this->data['gazal_custom_image_cont']) && $this->data['gazal_custom_image_cont'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_custom_image'])) {
            $this->data['gazal_image_preview_cont'] = $this->model_tool_image->resize($this->data['gazal_custom_image_cont'], 70, 70);
        } else {
            $this->data['gazal_image_preview_cont'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);


		
		/////////////////// custom settings //////////////////	

		//first block img
		
		if (isset($this->data['gazal_firstblock_img']) && $this->data['gazal_firstblock_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_firstblock_img'])) {
            $this->data['gazal_firstblock_preview'] = $this->model_tool_image->resize($this->data['gazal_firstblock_img'], 70, 70);
        } else {
            $this->data['gazal_firstblock_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//second block img
		
		if (isset($this->data['gazal_secondblock_img']) && $this->data['gazal_secondblock_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_secondblock_img'])) {
            $this->data['gazal_secondblock_preview'] = $this->model_tool_image->resize($this->data['gazal_secondblock_img'], 70, 70);
        } else {
            $this->data['gazal_secondblock_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//third block img
		
		if (isset($this->data['gazal_thirdblock_img']) && $this->data['gazal_thirdblock_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_thirdblock_img'])) {
            $this->data['gazal_thirdblock_preview'] = $this->model_tool_image->resize($this->data['gazal_thirdblock_img'], 70, 70);
        } else {
            $this->data['gazal_thirdblock_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//fourth block img
		
		if (isset($this->data['gazal_fourthblock_img']) && $this->data['gazal_fourthblock_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_fourthblock_img'])) {
            $this->data['gazal_fourthblock_preview'] = $this->model_tool_image->resize($this->data['gazal_fourthblock_img'], 70, 70);
        } else {
            $this->data['gazal_fourthblock_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		
		//contact img
		
		if (isset($this->data['gazal_contact_img']) && $this->data['gazal_contact_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_contact_img'])) {
            $this->data['gazal_contact_preview'] = $this->model_tool_image->resize($this->data['gazal_contact_img'], 70, 70);
        } else {
            $this->data['gazal_contact_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		
		//cus img
		
		if (isset($this->data['gazal_cus_img']) && $this->data['gazal_cus_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_cus_img'])) {
            $this->data['gazal_cus_preview'] = $this->model_tool_image->resize($this->data['gazal_cus_img'], 70, 70);
        } else {
            $this->data['gazal_cus_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);

		
		//pay1
		
		if (isset($this->data['gazal_pay1_img']) && $this->data['gazal_pay1_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay1_img'])) {
            $this->data['gazal_pay1_preview'] = $this->model_tool_image->resize($this->data['gazal_pay1_img'], 70, 70);
        } else {
            $this->data['gazal_pay1_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay2
		
		if (isset($this->data['gazal_pay2_img']) && $this->data['gazal_pay2_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay2_img'])) {
            $this->data['gazal_pay2_preview'] = $this->model_tool_image->resize($this->data['gazal_pay2_img'], 70, 70);
        } else {
            $this->data['gazal_pay2_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay3
		
		if (isset($this->data['gazal_pay3_img']) && $this->data['gazal_pay3_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay3_img'])) {
            $this->data['gazal_pay3_preview'] = $this->model_tool_image->resize($this->data['gazal_pay3_img'], 70, 70);
        } else {
            $this->data['gazal_pay3_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay4
		
		if (isset($this->data['gazal_pay4_img']) && $this->data['gazal_pay4_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay4_img'])) {
            $this->data['gazal_pay4_preview'] = $this->model_tool_image->resize($this->data['gazal_pay4_img'], 70, 70);
        } else {
            $this->data['gazal_pay4_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay5
		
		if (isset($this->data['gazal_pay5_img']) && $this->data['gazal_pay5_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay5_img'])) {
            $this->data['gazal_pay5_preview'] = $this->model_tool_image->resize($this->data['gazal_pay5_img'], 70, 70);
        } else {
            $this->data['gazal_pay5_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay6
		
		if (isset($this->data['gazal_pay6_img']) && $this->data['gazal_pay6_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay6_img'])) {
            $this->data['gazal_pay6_preview'] = $this->model_tool_image->resize($this->data['gazal_pay6_img'], 70, 70);
        } else {
            $this->data['gazal_pay6_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay7
		
		if (isset($this->data['gazal_pay7_img']) && $this->data['gazal_pay7_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay7_img'])) {
            $this->data['gazal_pay7_preview'] = $this->model_tool_image->resize($this->data['gazal_pay7_img'], 70, 70);
        } else {
            $this->data['gazal_pay7_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay8
		
		if (isset($this->data['gazal_pay8_img']) && $this->data['gazal_pay8_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay8_img'])) {
            $this->data['gazal_pay8_preview'] = $this->model_tool_image->resize($this->data['gazal_pay8_img'], 70, 70);
        } else {
            $this->data['gazal_pay8_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay9
		
		if (isset($this->data['gazal_pay9_img']) && $this->data['gazal_pay9_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay9_img'])) {
            $this->data['gazal_pay9_preview'] = $this->model_tool_image->resize($this->data['gazal_pay9_img'], 70, 70);
        } else {
            $this->data['gazal_pay9_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		//pay10
		
		if (isset($this->data['gazal_pay10_img']) && $this->data['gazal_pay10_img'] != "" && file_exists(DIR_IMAGE . $this->data['gazal_pay10_img'])) {
            $this->data['gazal_pay10_preview'] = $this->model_tool_image->resize($this->data['gazal_pay10_img'], 70, 70);
        } else {
            $this->data['gazal_pay10_preview'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 70, 70);
		
		
		
		
		
		
		
		
		
		
		
		
        //Send the output.
        $this->response->setOutput($this->render());
    }
    
    /*
     * 
     * This function is called to ensure that the settings chosen by the admin user are allowed/valid.
     * You can add checks in here of your own.
     * 
     */
    
    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/gazal')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }   
    }


}
?>