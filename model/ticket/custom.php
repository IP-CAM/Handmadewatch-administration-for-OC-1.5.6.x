<?php

class ModelTicketCustom extends Model {
    public function getFormInfo() {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "ticket_config WHERE config_id = 1");

        return $query->row;
    }

     public function getFormShow($fieldlist) {
        
        $html = '<div class="content"><table class="form">';
        $datepicker = $timepicker =0 ; 
        $fieldset = 1;
        if (is_array($fieldlist))
            foreach ($fieldlist as $row):
                $tmparr = array();
                $tmp = explode("_", $row[0]);
                $key = implode("_", array($tmp[0], $tmp[1], $tmp[2]));

                foreach ($row[1] as $field) {
                    if ($field['name'] == 'option[]') {
                        $tmparr['option'][] = $field['value'];
                    } else {
                        $tmparr[$field['name']] = $field['value'];
                    }
                }

                extract($tmparr, EXTR_OVERWRITE);

                $xxx        = isset($required) && $required == 1 ? '<span class="red">*</span>' : '';
                $required   = isset($required) && $required == 1 ? 'require' : '';

                $opthtml = '';
                if (isset($option)) {

                    if ($key == 'form_tab_checkbox') {
                        
                        foreach ($option as $opt) {
                            $opthtml .= '' . '<input type="checkbox" value="' . $opt . '" name="multi_1_' . $title . '[]">' . $opt;
                        }
                        
                    } else if ($key == 'form_tab_radio') {
                        
                        foreach ($option as $opt) {
                            $opthtml .= '' . '<input type="radio" value="' . $opt . '" name="input_1_' . $title . '">' . $opt;
                        }
                        
                    } else if ($key == 'form_tab_dropdown') {
                        
                        $opthtml .= '<select name="input_1_' . $title . '"  style="width:'.$width.'px">';
                        foreach ($option as $opt) {
                            $opthtml .= '<option value="' . $opt . '">' . $opt . '</option>';
                        }
                        $opthtml .= '</select>';
                        
                    } else if ($key == 'form_tab_multidropdow') {
                        
                        $opthtml .= '<select name="multi_1_' . $title . '[]" multiple="multiple" style="width:'.$width.'px">';
                        foreach ($option as $opt) {
                            $opthtml .= '<option value="' . $opt . '">' . $opt . '</option>';
                        }
                        $opthtml .= '</select>';
                        
                    }
                }

                switch ($key) {

                    case 'form_tab_title' :{
                        
                        
                        if($fieldset ++ ){
                            $html .= '</table></div>'; 
                            $html .= '<h2>' . $title . '</h2><div class="content"><table class="form">';
                        }else {
                            $html .= '<h2>' . $title . '</h2><div class="content"><table class="form">';
                        }
                        
                        break;
                    }
                    case 'form_tab_paragraph' :
                        $html .= '<tr><td class="para" colspan="2">' . $paragraph . '</td>';
                        break;
                    case 'form_tab_email' :
                        $html .= '<tr class="' . $required . '"><td class="email"><label>' .$xxx. ' '. $title . ' </label></td><td><input  type="text" name="email_1_' . $title . '" value=""  style="width:' . $width . 'px"  ></td></tr>';

                        break;
                    case 'form_tab_signlelinetext' :
                        $html .= '<tr class="' . $required . '"><td class="signlelinetext"><label>' .$xxx. ' '. $title . ' </label></td><td><input  type="text" name="input_1_' . $title . '" value="" style="width:' . $width . 'px "  ></td></tr>';
                        break;
                    case 'form_tab_multilinetext' :
                        $html .= '<tr class="' . $required . '"><td class="textarea"><label>' .$xxx. ' '. $title . ' </label></td><td><textarea  cols="' . $cols . '" rows="' . $rows . '" name="input_1_' . $title . '" ></textarea></td></tr>';
                        break;
                    case 'form_tab_checkbox' :
                        $html .= '<tr class="' . $required . '"><td class="checkbox"><label>' .$xxx. ' '. $title . ' </label></td><td>' . $opthtml . '</td></tr>';
                        break;
                    case 'form_tab_radio' :
                        $html .= '<tr class="' . $required . '"><td class="radio"><label>' .$xxx. ' '. $title . ' </label></td><td>' . $opthtml . '</td></tr>';

                        break;
                    case 'form_tab_dropdown' :
                        $html .= '<tr class="' . $required . '"><td class="dropdown"><label>' .$xxx. ' '. $title . ' </label></td><td>' . $opthtml . '</td></tr>';

                        break;
                    case 'form_tab_multidropdow' :
                        $html .= '<tr class="' . $required . '"><td class="multidropdow"><label>' .$xxx. ' '. $title . ' </label></td><td>' . $opthtml . '</td></tr>';

                        break;
                    case 'form_tab_upload' :
                        $html .= '<tr class="' . $required . '"><td class="upload"><label>' .$xxx. ' '. $title . ' </label></td><td><input type="file" style="width:' . $width . 'px " name="upload_1_' . $title . '" ></td></tr>';
                        break;
                    case 'form_tab_captcha' :
                        $html .= '<tr class="' . $required . '"><td class="captcha"><label>' .$xxx. ' '. $title . ' </label></td><td><input type="text" style="width:' . $width . 'px " name="captcha_1_' . $title . '" ><br /><img src="index.php?option=com_mijoshop&route=information/contact/captcha" alt="" /><div style="clear:both;"></div></td></tr>';
                        break;
                     case 'form_tab_date' : 
                        $html .= '<tr class="' . $required . '"><td class="date"><label>' .$xxx. ' '. $title . ' </label></td><td><input type="text" style="width:' . $width . 'px " id="datepicker_'.$datepicker++.'" name="input_1_' . $title . '" ></td></tr>';
                        break;
                     case 'form_tab_time' : 
                        $html .= '<tr class="' . $required . '"><td class="time"><label>' .$xxx. ' '. $title . ' </label></td><td><input type="text" style="width:' . $width . 'px " id="timepicker_'.$timepicker++.'" name="input_1_' . $title . '" ></td></tr>';
                        break;

                    default : break;
                }
            endforeach;
          
            $html .= ' </table></div>'; 
        return $html;
    }

public function getFormShowData($fieldlist,$uid) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ticket WHERE ticket_id = '" . (int)$uid . "'");

        $html = '';
        $datepicker = $timepicker =0 ; 
        $fieldset = 1;
        if (is_array($fieldlist))
            foreach ($fieldlist as $row):
                $tmparr = array();
                $tmp = explode("_", $row[0]);
                $key = implode("_", array($tmp[0], $tmp[1], $tmp[2]));

                foreach ($row[1] as $field) {
                    if ($field['name'] == 'option[]') {
                        $tmparr['option'][] = $field['value'];
                    } else {
                        $tmparr[$field['name']] = $field['value'];
                    }
                }

                extract($tmparr, EXTR_OVERWRITE);

                $xxx        = isset($required) && $required == 1 ? '<span class="red">*</span>' : '';
                $required   = isset($required) && $required == 1 ? 'require' : '';
                $value_post = isset($query->row[$title])?$query->row[$title]:'';

                $opthtml = '';
                if (isset($option)) {
                    if ($key == 'form_tab_checkbox') {
                        
                        foreach ($option as $opt) {
                            if(isset($query->row[$title])&&$query->row[$title]!='N/A'){
                                foreach(unserialize($query->row[$title]) as $vp){
                                $value_post = isset($vp)?$vp:'';
                                if($opt==$vp) $opthtml .= $opt.', ';
                                }
                            }else if(isset($query->row[$title])&&$query->row[$title]=='N/A'){
                                $opthtml = 'N/A';
                                break;
                            }
                        }
                        $opthtml = trim($opthtml,', ');
                        
                    } else if ($key == 'form_tab_radio') {
                        
                        foreach ($option as $opt) {
                            $value_post = isset($query->row[$title])?$query->row[$title]:'';
                            if($value_post=='N/A'){
                                $opthtml = 'N/A';
                                break;
                            }
                            if($opt==$value_post) $opthtml .= $opt.', ';
                        }
                        $opthtml = trim($opthtml,', ');
                        
                    } else if ($key == 'form_tab_dropdown') {
                        
                        foreach ($option as $opt) {
                            $value_post = isset($query->row[$title])?$query->row[$title]:'';
                            if($value_post=='N/A'){
                                $opthtml = 'N/A';
                                break;
                            }
                            if($opt==$value_post) $opthtml .= $opt.', ';
                        }
                        $opthtml = trim($opthtml,', ');

                    } else if ($key == 'form_tab_multidropdow') {
                        
                        foreach ($option as $opt) {
                            if(isset($query->row[$title])&&$query->row[$title]!='N/A'){
                                foreach(unserialize($query->row[$title]) as $vp){
                                $value_post = isset($vp)?$vp:'';
                                if($opt==$vp) $opthtml .= $opt.', ';
                                }
                             }else if(isset($query->row[$title])&&$query->row[$title]=='N/A'){
                                $opthtml = 'N/A';
                                break;
                            }
                        }
                        $opthtml = trim($opthtml,', ');
                        
                    }
                }

                switch ($key) {

                    case 'form_tab_email' :
                        $html .= '<tr class="' . $required . '"><td class="email">' .$xxx. ' '. $title . ' </td><td>' . $value_post . '</td></tr>';

                        break;
                    case 'form_tab_signlelinetext' :
                        $html .= '<tr class="' . $required . '"><td class="signlelinetext">' .$xxx. ' '. $title . ' </td><td>' . $value_post . '</td></tr>';
                        break;
                    case 'form_tab_multilinetext' :
                        $html .= '<tr class="' . $required . '"><td class="textarea">' .$xxx. ' '. $title . ' </td><td>' . $value_post . '</td></tr>';
                        break;
                    case 'form_tab_checkbox' :
                        $html .= '<tr class="' . $required . '"><td class="checkbox">' .$xxx. ' '. $title . ' </td><td>' . $opthtml . '</td></tr>';
                        break;
                    case 'form_tab_radio' :
                        $html .= '<tr class="' . $required . '"><td class="radio">' .$xxx. ' '. $title . ' </td><td>' . $opthtml . '</td></tr>';

                        break;
                    case 'form_tab_dropdown' :
                        $html .= '<tr class="' . $required . '"><td class="dropdown">' .$xxx. ' '. $title . ' </td><td>' . $opthtml . '</td></tr>';

                        break;
                    case 'form_tab_multidropdow' :
                        $html .= '<tr class="' . $required . '"><td class="multidropdow">' .$xxx. ' '. $title . ' </td><td>' . $opthtml . '</td></tr>';

                        break;
                    case 'form_tab_upload' :
                        if($value_post!='data/' && $value_post!='N/A') $value_post = '&nbsp;<a href="'.HTTP_SERVER.'image/'.$value_post.'">Download!</a>';
                        else $value_post = 'No file!';
                        $html .= '<tr class="' . $required . '"><td class="upload">' .$xxx. ' '. $title . ' </td><td>'.$value_post.'</td></tr>';
                        break;
                     case 'form_tab_date' : 
                        $html .= '<tr class="' . $required . '"><td class="date">' .$xxx. ' '. $title . ' </td><td>' . $value_post . '</td></tr>';
                        break;
                     case 'form_tab_time' : 
                        $html .= '<tr class="' . $required . '"><td class="time">' .$xxx. ' '. $title . ' </td><td>' . $value_post . '</td></tr>';
                        break;

                    default : break;
                }
            endforeach;
          
        return $html;
    }


    public function editForm($data) {

        $settings = array();
        $form_data = isset($data['form_data'])?$data['form_data']:array();  
        foreach($form_data as &$field){
			foreach($field[1] as &$property){
				$property['value'] = str_replace(array("'","\\"),array('"',"/"),$property['value']);
			}
		}
        if (is_array($form_data)) {
            $this->db->query("UPDATE " . DB_PREFIX . "ticket_config SET formdata = '" . serialize($form_data) . "'  WHERE config_id = 1");

            $this->cache->delete('category');
        }
    }

    public function getForm() {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "ticket_config WHERE config_id = 1");

        return $query->row;
    }


    public function getFormEdit($fieldlist) {
        $html = '';

        if (is_array($fieldlist))
            foreach ($fieldlist as $index => $row):
                $tmparr = array();
                $tmp = explode("_", $row[0]);
                $key = implode("_", array($tmp[0], $tmp[1], $tmp[2]));

                foreach ($row[1] as $field) {
                    if ($field['name'] == 'option[]') {
                        $tmparr['option'][] = $field['value'];
                    } else {
                        $tmparr[$field['name']] = $field['value'];
                    }
                }

                extract($tmparr, EXTR_OVERWRITE);

                $required = isset($required) && $required == 1 ? 'checked' : '';

                if (isset($option)) {
                    $opthtml = '<table class="checkboxlist"><tbody>';
                    foreach ($option as $opt) {
                        $rand = rand(999, 9999);
                        $opthtml .= '<tr id="checkbox_' . $rand . '"><td><input type="text" value="' . $opt . '" name="option[]"></td><td><a onclick="remove_this(\'checkbox\',\'' . $rand . '\')" href="javascript:void(0);">Remove</a></td></tr>';
                    }
                    $opthtml .= '</tbody></table>';
                } else {
                    $opthtml = '<table class="checkboxlist"></table>';
                }

                switch ($key) {

                    case 'form_tab_title' :
                        $html .= '
                    <li id="form_tab_title_' . $index . '"><form id="52_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Title</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                   ';
                        break;
                    case 'form_tab_paragraph' :
                        $html .= '
                    <li id="form_tab_paragraph_' . $index . '">
                        <form id="44_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">New Paragraph</td><td></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Paragraph</label>
                                        <textarea name="paragraph" class="widefat  val_title" rows="4" cols="10">' . $paragraph . '</textarea>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                  ';
                        break;
                    case 'form_tab_email' :
                        $html .= '
                    <li id="form_tab_email_' . $index . '"><form id="91_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="text" class="boxhidden"></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat  val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Width</label>
                                        <input type="text" name="width" class="widefat" value="' . $width . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" ' . $required . ' class="widefat" value="1">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_signlelinetext' :
                        $html .= '
                    <li id="form_tab_signlelinetext_' . $index . '"><form id="62_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="text" class="boxhidden"></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Width</label>
                                        <input type="text" name="width" class="widefat" value="' . $width . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" ' . $required . ' class="widefat" value="1">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_multilinetext' :
                        $html .= '
                    <li id="form_tab_multilinetext_' . $index . '"><form id="56_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><textarea class="boxhidden"></textarea></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Rows</label>
                                        <input type="text" name="rows" class="widefat" value="' . $rows . '">
                                    </p>
                                    <p>
                                        <label for="">Cols</label>
                                        <input type="text" name="cols" class="widefat" value="' . $cols . '">
                                    </p>  
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_checkbox' :
                        $html .= '
                    <li id="form_tab_checkbox_' . $index . '"><form id="35_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="checkbox"> &nbsp; <input type="checkbox"></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefa val_titlet" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Width</label>
                                        <input type="text" name="width" class="widefat" value="' . $width . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                    <p>
                                        <label for="">List Items</label>
                                        <input type="button" onclick="add_checkbox(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\'))" class="widefat" value="Enter items as text">
                                    </p>' . $opthtml . '
                                    <p></p>

                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_radio' :
                        $html .= '
                    <li id="form_tab_radio_' . $index . '"><form id="78_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="radio"> &nbsp;<input type="radio"></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Width</label>
                                        <input type="text" name="width" class="widefat" value="' . $width . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . '  value="1">
                                    </p>
                                    <p>
                                        <label for="">List Items</label>
                                        <input type="button" onclick="add_checkbox(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\'))" class="widefat" value="Enter items as text">
                                    </p>' . $opthtml . '
                                    <p></p>

                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_dropdown' :
                        $html .= '
                    <li id="form_tab_dropdown_' . $index . '"><form id="15_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><select disabled="" style="width: 200px !important;"><option>Select</option></select></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Width</label>
                                        <input type="text" name="width" class="widefat" value="' . $width . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                    <p>
                                        <label for="">List Items</label>
                                        <input type="button" onclick="add_checkbox(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\'))" class="widefat" value="Enter items as text">
                                    </p>' . $opthtml . '
                                    <p></p>

                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_multidropdow' :
                        $html .= '
                    <li id="form_tab_multidropdow_' . $index . '"><form id="70_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><select disabled="" style="width: 200px !important;"><option>Select</option></select></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Width</label>
                                        <input type="text" name="width" class="widefat" value="' . $width . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                    <p>
                                        <label for="">List Items</label>
                                        <input type="button" onclick="add_checkbox(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\'))" class="widefat" value="Enter items as text">
                                    </p>' . $opthtml . '
                                    <p></p>

                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_upload' :
                        $html .= '
                    <li id="form_tab_upload_' . $index . '"><form id="52_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="file" disabled=""></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_date' :
                        $html .= '
                    <li id="form_tab_date_' . $index . '"><form id="52_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="text" class="boxhidden"></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_time' :
                        $html .= '
                    <li id="form_tab_time_' . $index . '"><form id="52_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="text" class="boxhidden"></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_captcha' :
                        $html .= '
                    <li id="form_tab_captcha_' . $index . '"><form id="60_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td><input type="text" class="boxhidden"></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                    <p>
                                        <label for="">Required <span class="red">*</span></label>
                                        <input type="checkbox" name="required" class="widefat" ' . $required . ' value="1">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                       ';
                        break;
                    case 'form_tab_submit' :
                        $html .= '
                    <li id="form_tab_submit_' . $index . '"><form id="65_id">
                            <div class="widget-content">
                                <table><tbody><tr><td class="tab_title">' . $title . '</td><td></td><td><span onclick="showedit(jQuery(this).parentsUntil(\'li\').parent().attr(\'id\')) " class="edit">Edit</span> &nbsp;&nbsp; <span onclick="jQuery(this).parentsUntil(\'li\').parent().remove()" class="delete">Delete</span></td></tr></tbody></table>
                                <div class="expand">
                                    <p>
                                        <label for="">Label</label>
                                        <input type="text" name="title" class="widefat val_title" value="' . $title . '">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </li>
                    ';
                        break;

                    default : break;
                }
            endforeach;
        return $html;
    }

}

?>