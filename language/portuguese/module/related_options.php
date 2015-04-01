<?php
// Heading
$_['heading_title']         = 'Opções Relacionadas_feofan.net';
$_['related_options']       = 'Opções Relacionadas_feofan.net'; 

// Text
$_['text_module']           = 'Módulos';
$_['text_success']          = 'Configuração modificada!';
$_['text_content_top']      = 'Topo';
$_['text_content_bottom']   = 'Fundo';
$_['text_column_left']      = 'Coluna Esquerda';
$_['text_column_right']     = 'Coluuna Direita';
$_['text_ro_updated_to']    = 'Módulo atualizado para a versão ';
$_['text_ro_all_options']   = 'Todas as opções disponíveis';
$_['text_ro_support']       = "<a href=\"mailto:support@liveopencart.com\">support@liveopencart.com</a>";
$_['text_ro_clear_options'] = 'Eliminar opções';



// Entry
$_['entry_settings']                  = 'Module settings';

$_['entry_PHPExcel_not_found']        = 'PHPExcel library not installed. File not found: ';
$_['entry_export']                    = 'Export';
$_['entry_export_description']        = 'Export file format: XLS.<br>First line for fields names, next lines for data.';
$_['entry_export_get_file']           = 'Export file';
$_['entry_export_fields']             = 'Export fields:';
$_['entry_import']                    = 'Import';
$_['entry_import_description']        = '
Import file format: XLS. Import uses only first sheet for getting data.
<br>First table line must contain fields names (head): product_id, relatedoptions_model, quantity, price, option_id1, option_value_id1, option_id2, option_value_id2, ... (not product_option_id or product_option_value_id).
<br>Next table lines must contain related options data in accordance with fields names in first table line.
<br><br>Products related options combinations will be replaced if the same will be found in file.';
$_['button_upload']		                = 'Import file';
$_['button_upload_help']              = 'import starts immediately after selecting the file';
$_['entry_server_response']           = 'Server answer:';
$_['entry_import_result']             = 'Processed products / related options';

$_['entry_update_quantity']           = 'Recalcular quantidade';
$_['entry_update_quantity_help']      = 'Recalcular stock automaticamente de acordo com o stock das opções Relacionadas';
$_['entry_stock_control']             = 'Quantidade controle';
$_['entry_stock_control_help']        = 'desativar de adicionar ao carrinho de bens com quantidade maior do que a quantidade de opções relacionadas';
$_['entry_update_options']            = 'Atualizar opções';
$_['entry_update_options_help']    	  = 'Atualizar stock automaticamente de acordo com o stock das opções Relacionadas';
$_['entry_options_values']            = 'Valor das opções';
$_['entry_add_related_options']       = 'Adicionar opção relacionada';
$_['entry_related_options_quantity']  = 'Quantidade';
$_['entry_ro_version']                = 'Opções Relacionadas, versão';

$_['entry_ro_use_variants']           = 'Utilize diferentes variantes de Opções Relacionadas';
$_['entry_ro_variant']                = 'Variante de Opções Relacionadas';
$_['entry_ro_variant_name']           = 'Nome da variante';
$_['entry_ro_options']                = 'Opções Variantes';
$_['entry_ro_add_variant']            = 'Adicionar variante';
$_['entry_ro_delete_variant']         = 'Eliminar variante';
$_['entry_ro_add_option']             = 'Adicionar opção';
$_['entry_ro_delete_option']          = 'Eliminar opção';
$_['entry_ro_use']                    = 'Use relacionado opções';
$_['entry_show_clear_options']        = 'Função "Eliminar opções"';
$_['entry_show_clear_options_help']   = 'mostrar botão "Eliminar opções" para o cliente para esclarecer selecionados valores das opções';
$_['option_show_clear_options_not']   = 'não use';
$_['option_show_clear_options_top']   = 'acima opções';
$_['option_show_clear_options_bot']   = 'abaixo opções';
$_['entry_hide_inaccessible']         = 'Ocultar opções indisponíveis valore';
$_['entry_hide_inaccessible_help']    = 'esconder valores de opção não selecionáveis ​​por parte dos clientes';
$_['entry_spec_model']                = 'Models in related options';
$_['entry_spec_model_help']           = 'set different models for related options (this models will be shown on the product page and ont the cart page, and will be saved in order )';
$_['entry_spec_price']                = 'Prices in related options';
$_['entry_spec_price_help']           = 'set different prices for related options, if price for related options is not set - standard product price will be used';
$_['entry_spec_weight']               = 'Weight for related options';
$_['entry_spec_weight_help']          = 'set different weights for related options combinations';
$_['entry_spec_price_discount']       = 'Discounts in related options';
$_['entry_spec_price_discount_help']  = 'set different discounts for related options (works if "'.$_['entry_spec_price'].'") turned on, if discounts for related options is not set - standard product discounts will be used';
$_['entry_add_discount']              = 'Add discount';
$_['entry_del_discount_title']        = 'Delete discount';
$_['entry_prices']                    = 'Price';
$_['entry_select_first_short']        = 'Auto-select';
$_['entry_select_first_priority']     = 'Priority';
$_['entry_select_first']              = 'Auto-select first related options set';
$_['entry_select_first_help']         = 'select automatically available related options combination for customer on the product page in the frontend. If related options combination for auto-select is not set at product page in admin section, first available combination will be used';
$_['entry_step_by_step']              = 'Step-by-step options selection';
$_['entry_step_by_step_help']         = 'customer selects first option, then second, then third, and next, and next etc. (customer can change value of selected options anytime - all next options with unsuitable values will be cleared)';
$_['entry_allow_zero_select']         = 'Allow select zero quantity';
$_['entry_allow_zero_select_help']    = 'allow customer to select related options sets with zero quantity';
$_['entry_edit_columns']              = 'Related Option editing';
$_['entry_edit_columns_0']            = '1 column';
$_['entry_edit_columns_2']            = '2 columns';
$_['entry_edit_columns_3']            = '3 columns';
$_['entry_edit_columns_4']            = '4 columns';
$_['entry_edit_columns_5']            = '5 columns';
$_['entry_edit_columns_100']          = 'by width';
$_['entry_edit_columns_help']         = 'set position select fields for editing related options (Related Option tab on product editing page';
$_['entry_add_all_variants']          = 'Add all possible option combinations';

//warning
$_['warning_equal_options']           = 'Opções repetidas';

// Error
$_['error_equal_options']             = 'Opções repetidas';
$_['error_not_enough_options']        = 'Existem opções relacionadas que não estão selecionadas';
$_['error_permission']                = 'Warning: Não tem permissões para alterar o módulo!';
?>