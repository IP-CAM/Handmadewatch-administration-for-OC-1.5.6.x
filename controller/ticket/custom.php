<?php

class ControllerTicketCustom extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('ticket/custom');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('ticket/custom');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) { 
            $con = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
            mysql_select_db(DB_DATABASE, $con);
            $results = mysql_query("SHOW COLUMNS FROM `" . DB_PREFIX . "ticket`", $con);
            $i=0;
            while($c = mysql_fetch_assoc($results)){
              $columns[$i]['Field'] = $c['Field'];
              $columns[$i]['Default'] = $c['Default'];
              $i++;
            }
            $form_data = isset($this->request->post['form_data'])?$this->request->post['form_data']:array();
            foreach($form_data as $row){
                $exists = false;
                $tmp = explode("_", $row[0]);
                $key = implode("_", array($tmp[0], $tmp[1], $tmp[2]));
               foreach($columns as $c)
                    if($c['Field'] == $row[1][0]["value"]){
                        $exists = true;
                        break;
                    }

                if(!$exists && $key!='form_tab_captcha' && $key!='form_tab_paragraph' && $key!='form_tab_title'){
                    mysql_query("ALTER TABLE `" . DB_PREFIX . "ticket` ADD COLUMN `" . $row[1][0]["value"] . "` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N/A'", $con);
                }
            }
            foreach($columns as $c){
                $i=0;
                foreach($form_data as $row){
                    if($c['Field'] == $row[1][0]["value"]) break;
                    $i++;
                }
                if($i==count($form_data) && $c['Default'] == "N/A"){
                    mysql_query("ALTER TABLE `" . DB_PREFIX . "ticket` DROP COLUMN `" . $c['Field'] . "`", $con);
                }
            }

            $this->model_ticket_custom->editForm($this->request->post);
            $_SESSION['flash'] = "Update Successful !";
            echo $this->url->link('ticket/custom', 'token=' . $this->session->data['token'], 'SSL'); 

            die; 

         }

        $this->getForm();
    }

    private function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_percent'] = $this->language->get('text_percent');
        $this->data['text_amount'] = $this->language->get('text_amount');
        $this->data['text_content_top'] = $this->language->get('text_content_top');
        $this->data['text_content_bottom'] = $this->language->get('text_content_bottom');       
        $this->data['text_column_left'] = $this->language->get('text_column_left');
        $this->data['text_column_right'] = $this->language->get('text_column_right');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_store'] = $this->language->get('entry_store');
        $this->data['entry_keyword'] = $this->language->get('entry_keyword');
        $this->data['entry_parent'] = $this->language->get('entry_parent');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_top'] = $this->language->get('entry_top');
        $this->data['entry_column'] = $this->language->get('entry_column');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_layout'] = $this->language->get('entry_layout');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_design'] = $this->language->get('tab_design');
        $this->data['flash'] = isset($_SESSION['flash'])?$_SESSION['flash']:'';
        unset($_SESSION['flash']);
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = array();
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('ticket/custom', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['cancel'] = $this->url->link('ticket/ticket', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];

        $creator_info = $this->model_ticket_custom->getForm();

        
        $this->data['html']  = isset($creator_info) ? $this->model_ticket_custom->getFormEdit(unserialize( $creator_info['formdata'])) : ''; 
        $this->template = 'ticket/custom.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    private function validateForm() {
        if (!$this->user->hasPermission('modify', 'ticket/custom')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }


        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

?>