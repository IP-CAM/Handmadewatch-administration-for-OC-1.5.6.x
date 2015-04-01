<?php
#####################################################################################
#  Module CSV IMPORT PRO for Opencart 1.5.0 From HostJars opencart.hostjars.com 	#
#####################################################################################

// Heading
$_['heading_title']    = 'CSV Импорт PRO';

// Tabs
$_['tab_config'] = 'Шаг 1: Глобальные настройки';
$_['tab_map'] = 'Шаг 2: Настройки полей';
$_['tab_adjust'] = 'Шаг 3: Корректировка данных';
$_['tab_import'] = 'Шаг 4: Импорт';

// Text
$_['text_csv_import_menu']     = 'CSV Импорт';
$_['text_success']     = 'Успешно: Продукты - добавлено %s, обновлено %s, пропущено %s, потеряно %s';
$_['text_add']     = 'Добавить';
$_['text_reset']     = 'Сброс';
$_['text_update']     = 'Добавить/Обновить';

// Entry
$_['entry_import_file']     = 'Выбрать файл CSV:';
$_['entry_import_url']     = 'URL на файл CSV:';
$_['entry_stock_status']  = 'Наличие:';
$_['entry_weight_class']  = 'Тип веса:';
$_['entry_length_class']  = 'Тип длинны:';
$_['entry_tax_class']  = 'Тип налогов:';
$_['entry_subtract']  = 'Вычитать остаток:';
$_['entry_product_status']  = 'Статус продукта:';
$_['entry_language']  = 'Язык:';
$_['entry_ignore_fields'] = 'Пропустить продукт в котором:';
$_['entry_store']  	   = 'Магазин:';
$_['entry_remote_images']  	   = 'Загрузить изображения по ссылкам:';
$_['entry_remote_images_warning']  	   = 'Внимание: Вероятно займет очень много времени при большом количестве полей (>500).';
$_['entry_language']   = 'Язык:';
$_['entry_delimiter']  = 'Разделитель в файле CSV:';
$_['entry_escape']     = 'CSV Escape Character:';
$_['entry_qualifier']  = 'CSV Text Qualifier:';
$_['entry_data_feed']  = 'CSV Data Feed:';
$_['entry_field_mapping']= 'Field Mapping:';
$_['entry_import_type']= 'Способ импорта:';
$_['entry_price_multiplier']= 'Наценка:';
$_['entry_image_remove']= 'Удаляемый префикс картинки:';
$_['entry_image_prepend']= 'Перфикс картинки:';
$_['entry_image_append']= 'Суффикс картинки:';
$_['entry_split_category']= 'Разделитель категорий:';
$_['entry_top_categories']= 'Добавить категории в меню:';

// Field Names
$_['text_field_oc_title']	 = 'Поля в OpenCart';
$_['text_field_csv_title']	 = 'Колонка в файле CSV';
$_['text_field_name']     = 'Имя';
$_['text_field_price']     = 'Цена';
$_['text_field_special_price']     = 'Спец. цена';
$_['text_field_model']     = 'Модель';
$_['text_field_sku']     = 'Sku (Артикул)';
$_['text_field_upc']     = 'UPC (Штрих-код)';
$_['text_field_points']     = 'Баллы';
$_['text_field_reward']     = 'Подарки';
$_['text_field_manufacturer']     = 'Производитель';
$_['text_field_attribute']     = 'Атрибут';
$_['text_field_category']     = 'Категория';
$_['text_field_quantity']     = 'Количество';
$_['text_field_image']     = 'Изображение';
$_['text_field_additional_image']     = 'Дополнительное изображение';
$_['text_field_description']     = 'Описание';
$_['text_field_meta_desc']     = 'Ключевое описание (meta)';
$_['text_field_meta_keyw']     = 'Ключевые слова (meta)';
$_['text_field_weight']     = 'Вес';
$_['text_field_length']     = 'Длина';
$_['text_field_height']     = 'Высота';
$_['text_field_width']     = 'Ширина';
$_['text_field_location']     = 'Местоположение';
$_['text_field_keyword']     = 'Ключевое слово SEO';
$_['text_field_tags']     = 'Тэги продукта';
$_['text_field_layout']     = 'Layout (Расположение?)';


// Import
$_['button_import']	   = 'Импорт';
$_['button_save'] 	   = 'Сохранить';
$_['button_cancel']	   = 'Отмена';


// Error
$_['error_permission'] = 'Внимание: У Вас нет прав редактировать csv import!';
$_['error_empty']      = 'Внимание: Файл пуст или его нет вовсе, только сохраняю!';
$_['error_update_field_mapping'] = 'Warning: You have specified an Update based on %s, but %s is not mapped.';
?>