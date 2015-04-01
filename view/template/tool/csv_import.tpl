<?php 
#####################################################################################
#  Module CSV IMPORT PRO for Opencart 1.5.x From HostJars opencart.hostjars.com 	#
#####################################################################################
?>
<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<script type="text/javascript">
	function updateText() {
		var action = document.settings_form.csv_import_type.value;
		$("#add_text, #reset_text, #update_text").hide();
		if (action == 'update') {
			$("#update_text").show().css("display", "inline");
		} else if (action == 'add') {
			$("#add_text").show().css("display", "inline");
		} else {
			$("#reset_text").show().css("display", "inline");
		}
	}
	function addCat(currentCat, el) {
		newcat = '<tr id="cat'+(currentCat+1)+'"><td style="width:200px;"><?php echo $text_field_category; ?>&nbsp;<a style="float:right;" onclick="return addCat('+(currentCat+1)+', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a></td>';
		newcat += '<td><input type="text" name="csv_import_field_cat['+(currentCat+1)+'][]">';
		newcat += '&nbsp;<a onclick="return addSub(\'cat['+(currentCat+1)+']\', this);" class="button"><span>More&nbsp;&rarr;&nbsp;</span></a></td></tr>';
		$("#cat"+currentCat).after(newcat);
		$(el).hide();
		return false;
	}
	function addSub(name, el) {
		sub = '&nbsp;&rarr;&nbsp;<input type="text" name="csv_import_field_'+name+'[]" />&nbsp;';
		$(el).before(sub);
		return false;
	}
	function addVert(name, el) {
		newEl = '<tr id="'+name+'x">' + $("#"+name).html() + '</tr>';
		if (newEl.indexOf("value") != -1) {
			newEl = newEl.replace(/value="[^"]*"/, '');
		}
		newEl = newEl.replace("', this", "x', this");
		$(el).hide();
		$("#"+name).after(newEl);
		return false;
	}
	
	$(document).ready(function() {
		updateText();
	});
</script>

<div class="box">
  <div class="heading">
    <h1><img src='view/image/feed.png' /><?php echo $heading_title; ?></h1>
  </div>
  <div class="content">
  	<div id="tabs" class="htabs"><a href="#tab_config"><?php echo $tab_config; ?></a><a href="#tab_map"><?php echo $tab_map; ?></a><a href="#tab_adjust"><?php echo $tab_adjust; ?></a><a href="#tab_import"><?php echo $tab_import; ?></a></div>
      
	 
	  
	  <form action="<?php echo $action; ?>" method="post" name="settings_form" enctype="multipart/form-data" id="csv_import">
	    <div id="tab_config">
        <table class="form">
        <tr class="instructions">
        	<td colspan="3">Эти настройки будут относиться к каждому новому продукту. Обновленные продукты сохранят свои текущие настройки.</td>
        </tr>
      	<!-- delimiter -->
		<tr>
			<td><?php echo $entry_delimiter; ?></td>
			<td colspan="2">
				<select name="csv_import_delimiter">
				<option value=";" <?php if ($csv_import_delimiter == ';') { echo 'selected="true"'; } ?>>;</option>
					
					<option value="," <?php if ($csv_import_delimiter == ',') { echo 'selected="true"'; } ?>>,</option>
					<option value="\t" <?php if ($csv_import_delimiter == '\t') { echo 'selected="true"'; } ?>>Tab</option>
					<option value="|" <?php if ($csv_import_delimiter == '|') { echo 'selected="true"'; } ?>>|</option>
					<option value="^" <?php if ($csv_import_delimiter == '^') { echo 'selected="true"'; } ?>>^</option>
				</select>
			</td>
		</tr>
		<!-- stock status (stock_status_id) -->
		<!--<tr>
			<td><?php echo $entry_stock_status; ?></td>
			<td colspan="2">
				<select name="csv_import_stock_status_id">
					<?php foreach ($stock_status_selections as $status) { ?>
					<option value="<?php echo $status['stock_status_id']; ?>" <?php if ($csv_import_stock_status_id == $status['stock_status_id']) { echo "selected='true'"; } ?>><?php echo $status['name']; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		-->
		<input type="hidden" name="csv_import_stock_status_id" value="7">
		<!-- subtract stock default setting -->
		<tr>
			<td><?php echo $entry_subtract; ?></td>
			<td colspan="2">
				<select name="csv_import_subtract">
					<option value="1" <?php if ($csv_import_subtract == 1) { echo "selected='true'"; } ?>>Да</option>
					<!--<option value="0" <?php if ($csv_import_subtract == 0) { echo "selected='true'"; } ?>>Нет</option>-->
				</select>
			</td>
		</tr>
		<!-- product status default setting -->
		<!-- <tr>
			<td><?php echo $entry_product_status; ?></td>
			<td colspan="2">
				<select name="csv_import_product_status">
					<option value="1" <?php if ($csv_import_product_status == 1) { echo "selected='true'"; } ?>>Включено</option>
					<option value="0" <?php if ($csv_import_product_status == 0) { echo "selected='true'"; } ?>>Выключено</option>
				</select>
			</td>
		</tr> -->
		<!-- language -->
		<?php if (count($language_selections) > 1) { ?>
			<tr>
				<td><?php echo $entry_language; ?></td>
				<td colspan="2">
					<select name="csv_import_language">
						<?php foreach ($language_selections as $lang) { ?>
						<option value="<?php echo $lang['language_id']; ?>" <?php if ($csv_import_language === $lang['language_id']) { echo 'selected="true"'; }?>><?php echo $lang['name']; ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
		<?php }	else { foreach ($language_selections as $lang) { ?>
				<input type="hidden" name="csv_import_language" value="<?php echo $lang['language_id']; ?>">
		<?php }} ?>
		<!--
		<?php if ($weight_class_selections) { ?>-->
		<!-- store -->
		<!--<tr>
			<td><?php echo $entry_weight_class; ?></td>
			<td colspan="2">
				<select name="csv_import_weight_class">
					<?php foreach ($weight_class_selections as $weight) { ?>
					<option value="<?php echo $weight['weight_class_id']; ?>" <?php if ($csv_import_weight_class == $weight['weight_class_id']) { echo 'selected="true"'; }?>><?php echo $weight['title']; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php } ?>
		<?php if ($length_class_selections) { ?>
		-->
		<!-- store -->
		<!--
		<tr>
			<td><?php echo $entry_length_class; ?></td>
			<td colspan="2">
				<select name="csv_import_length_class">
					<?php foreach ($length_class_selections as $length) { ?>
					<option value="<?php echo $length['length_class_id']; ?>" <?php if ($csv_import_length_class == $length['length_class_id']) { echo 'selected="true"'; }?>><?php echo $length['title']; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php } ?>
		
		<?php if ($tax_class_selections) { ?>
		-->
		<!-- store -->
		<!--
		<tr>
			<td><?php echo $entry_tax_class; ?></td>
			<td colspan="2">
				<select name="csv_import_tax_class">
					<?php foreach ($tax_class_selections as $tax) { ?>
					<option value="<?php echo $tax['tax_class_id']; ?>" <?php if ($csv_import_tax_class == $tax['tax_class_id']) { echo 'selected="true"'; }?>><?php echo $tax['title']; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php } ?>
		-->
		<!-- store -->
		<tr>
			<td><?php echo $entry_store; ?></td>
			<td colspan="2">
				<input type="checkbox" name="csv_import_store[]" value="0" checked="true" /><label>По умолчанию</label>
				<?php foreach ($store_selections as $store) { ?>
				<input type="checkbox" name="csv_import_store[]" value="<?php echo $store['store_id']; ?>"><label><?php echo $store['name']; ?></label>
				<?php } ?>
			</td>
		</tr>
		
		<!-- top categories -->
		<tr>
			<td><?php echo $entry_top_categories; ?></td>
			<td colspan="2">
				<select name="csv_import_top_categories">
					<!--<option value="0" <?php if (!$csv_import_top_categories) echo "selected='true'"; ?>>Нет</option>-->
					<option value="1" <?php if ($csv_import_top_categories) echo "selected='true'"; ?>>Да</option>
				</select>
			</td>
		</tr>
		
		<!-- download images -->
		<tr>
			<td><?php echo $entry_remote_images; ?><span class="help"><?php echo $entry_remote_images_warning; ?></span></td>
			<td colspan="2">
				<select name="csv_import_remote_images">
					<option value="0" <?php if (!$csv_import_remote_images) echo "selected='true'"; ?>>Нет</option>
					<option value="1" <?php if ($csv_import_remote_images) echo "selected='true'"; ?>>Да</option>
				</select>
			</td>
		</tr>

		</table>
    </div>
	<div id="tab_map">
		<table class="form">
        <tr class="instructions">
        	<td colspan="3">Колонка "Поля в OpenCart" содержит названия полей в самом OpenCart. В колонке "Заголовок в файле CSV" Вы должны ввести соответствующее имя колонки из файла CSV. Вы можете оставить поля, незаполненными, если не хотите импортировать их.
         Здесь нет обяхательных полей, но чем больше полей вы заполните, тем правильнее будет проведен импорт.</td>
        </tr>
      	<!-- mapping fields to names -->
		<tr>
			<td colspan="3"><table>
				<tr><td style="width:200px;"><h2><?php echo $text_field_oc_title; ?></h2></td><td><h2><?php echo $text_field_csv_title; ?></h2></td>
				<tr><td style="width:200px;"><?php echo $text_field_name; ?></td><td><input type="text" name="csv_import_field_name" value="name"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_price; ?></td><td><input type="text" name="csv_import_field_price" value="price"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_special_price; ?></td><td><input type="text" name="csv_import_field_special_price" value="special"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_model;?></td><td><input type="text" name="csv_import_field_model" value="model"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_sku; ?></td><td><input type="text" name="csv_import_field_sku" value="articul"></td></tr>
				<!--<tr><td style="width:200px;"><?php echo $text_field_upc; ?></td><td><input type="text" name="csv_import_field_upc" value="<?php echo $csv_import_field_upc; ?>"></td></tr>-->
				<tr><td style="width:200px;">Марка</td><td><input type="text" name="csv_import_field_manu" value="marka"></td></tr>
				<?php 
				
				//CATEGORIES
				//if (count($csv_import_field_cat) == 0 || $csv_import_field_cat[0][0] == '') {
				//	echo '<tr id="cat0"><td style="width:200px;">';
				//	echo $text_field_category;
				//	echo '&nbsp;<a style="float:right;" onclick="return addCat(0, this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
				//	echo '</td><td>';
				//	echo '<input type="text" name="csv_import_field_cat[0][]">';
				//	echo '&nbsp;<a onclick="return addSub(\'cat[0]\', this);" class="button"><span>More&nbsp;&rarr;&nbsp;</span></a>';
				//	echo '</td></tr>';
				//} else {
				$catqnty = 4;
					for ($i=0; $i<$catqnty; $i++) {
						//if ($csv_import_field_cat[$i][0] != '') {
							echo '<tr id="cat' . ($i+1)  . '"><td style="width:200px;">';
							echo $text_field_category . ($i+1);
							echo '</td><td>';
							
							
							echo '<input type="text" name="csv_import_field_cat' . ($i+1) . '" value="category' . ($i+1) . '">';
								
							echo '</td></tr>';
						//}
					}
				//}
				
					?>
				<tr><td style="width:200px;"><?php echo $text_field_image; ?></td><td><input type="text" name="csv_import_field_image" value="foto1"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_quantity; ?></td><td><input type="text" name="csv_import_field_quantity" value="ostatok"></td></tr>
			<!--	<tr><td style="width:200px;"><?php echo $text_field_weight; ?></td><td><input type="text" name="csv_import_field_weight" value="<?php echo $csv_import_field_weight; ?>"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_length; ?></td><td><input type="text" name="csv_import_field_length" value="<?php echo $csv_import_field_length; ?>"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_height; ?></td><td><input type="text" name="csv_import_field_height" value="<?php echo $csv_import_field_height; ?>"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_width; ?></td><td><input type="text" name="csv_import_field_width" value="<?php echo $csv_import_field_width; ?>"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_location; ?></td><td><input type="text" name="csv_import_field_location" value="<?php echo $csv_import_field_location; ?>"></td></tr>-->
				<tr><td style="width:200px;"><?php echo $text_field_description; ?></td><td><input type="text" name="csv_import_field_desc" value="text"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_keyword; ?></td><td><input type="text" name="csv_import_field_keyword" value="keyword"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_meta_desc; ?></td><td><input type="text" name="csv_import_field_meta_desc" value="description"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_meta_keyw; ?></td><td><input type="text" name="csv_import_field_meta_keyw" value="keyword"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_tags; ?></td><td><input type="text" name="csv_import_field_tags" value="tags"></td></tr>
				<!--<tr><td style="width:200px;"><?php echo $text_field_points; ?></td><td><input type="text" name="csv_import_field_points" value="<?php echo $csv_import_field_points; ?>"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_reward; ?></td><td><input type="text" name="csv_import_field_reward" value="<?php echo $csv_import_field_reward; ?>"></td></tr>
				<tr><td style="width:200px;"><?php echo $text_field_layout; ?></td><td><input type="text" name="csv_import_field_layout" value="<?php echo $csv_import_field_layout; ?>"></td></tr>-->
				
				
<tr><td>Видимость:</td><td><input type="text" name="csv_import_field_status" value="visibility"></td></tr>
<tr><td>Минимальное количество:</td><td><input type="text" name="csv_import_field_minqnty" value="minimum"></td></tr>
<tr><td>VK like:</td><td><input type="text" name="csv_import_field_vklike" value="vklike"></td></tr>
<tr><td>VK share:</td><td><input type="text" name="csv_import_field_vkshare" value="vkshare"></td></tr>
<tr><td>Facebook like:</td><td><input type="text" name="csv_import_field_facebook" value="fblike"></td></tr>
<tr><td>Google Plus like:</td><td><input type="text" name="csv_import_field_google" value="google"></td></tr>
<tr><td>Мой Мир like:</td><td><input type="text" name="csv_import_field_mymir" value="mymir"></td></tr>
<tr><td>Одноклассники like:</td><td><input type="text" name="csv_import_field_ok" value="oklike"></td></tr>
<tr><td>Twitter like:</td><td><input type="text" name="csv_import_field_twitter" value="twitter"></td></tr>
<tr><td>Доставка:</td><td><input type="text" name="csv_import_field_deliver" value="delivery"></td></tr>
<tr><td>Видео:</td><td><input type="text" name="csv_import_field_video" value="video"></td></tr>

<?php 
				
				//фиксированные аттрибуты
					//echo count($attributes);
					
					for ($i=0; $i<count($attributes); $i++) {
						if ($attributes[$i]['name'] != '') {
							echo '<tr id="attribute' . $attributes[$i]['attribute_id'] . '"><td style="width:200px;">';
							echo $attributes[$i]['name'] . ':';
							if ($i == count($attributes) - 1) {
							//	echo '&nbsp;<a style="float:right;" onclick="return addVert(\'attribute' . $i . '\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
							}
							echo '</td><td>';
							echo '<input type="text" name="csv_import_field_attribute' . $attributes[$i]['attribute_id'] . '" value="' . $attributes[$i]['name'] . '">';
							echo '</td></tr>';
						}
					}
					//if (count($csv_import_field_attribute) == 0 || $csv_import_field_attribute[0] == '') {
					//	echo '<tr id="attribute"><td style="width:200px;">';
					//	echo $text_field_attribute;
					//	echo '&nbsp;<a style="float:right;" onclick="return addVert(\'attribute\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
					//	echo '</td><td>';
					//	echo '<input type="text" name="csv_import_field_attribute[]">';
					//	echo '</td></tr>';
					//}
	
					//удаленный блок картиноа
				//	for ($i=0; $i<6; $i++) {
					//	if ($csv_import_field_additional_image[$i] != '') {
					//		echo '<tr id="additional_image' . $i . '"><td style="width:200px;">';
					//		echo $text_field_additional_image . ($i+1);
							//if ($i == 6) {
							//	echo '&nbsp;<a style="float:right;" onclick="return addVert(\'additional_image' . $i . '\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
							//}
					//		echo '</td><td>';
					//		echo '<input type="text" name="csv_import_field_additional_image' . ($i+1) . '" value="' . ($i + 25) . '">';
					//		echo '</td></tr>';
						//}
					//}
					//if (count($csv_import_field_additional_image) == 0 || $csv_import_field_additional_image[0] == '') {
					//	echo '<tr id="additional_image"><td style="width:200px;">';
					//	echo $text_field_additional_image;
					//	echo '&nbsp;<a style="float:right;" onclick="return addVert(\'additional_image\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
					//	echo '</td><td>';
					//	echo '<input type="text" name="csv_import_field_additional_image[]">';
					//	echo '</td></tr>';
					//}
					
				//новые атрибуты
					for ($i=0; $i<count($csv_import_field_attribute); $i++) {
						if ($csv_import_field_attribute[$i] != '') {
							echo '<tr id="attribute' . $i . '"><td style="width:200px;">';
							echo "Дополнительный атрибут:";
							if ($i == count($csv_import_field_attribute) - 1) {
								echo '&nbsp;<a style="float:right;" onclick="return addVert(\'attribute' . $i . '\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
							}
							echo '</td><td>';
							echo '<input type="text" name="csv_import_field_attribute[]" value="' . $csv_import_field_attribute[$i] . '">';
							echo '</td></tr>';
						}
					}
					if (count($csv_import_field_attribute) == 0 || $csv_import_field_attribute[0] == '') {
						echo '<tr id="attribute"><td style="width:200px;">';
						echo "Дополнительный атрибут:";
						echo '&nbsp;<a style="float:right;" onclick="return addVert(\'attribute\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
						echo '</td><td>';
						echo '<input type="text" name="csv_import_field_attribute[]">';
						echo '</td></tr>';
					}
					
					//доп картинки
					for ($i=0; $i<count($csv_import_field_additional_image); $i++) {
						if ($csv_import_field_additional_image[$i] != '') {
							echo '<tr id="additional_image' . $i . '"><td style="width:200px;">';
							echo $text_field_additional_image;
							if ($i == count($csv_import_field_additional_image) - 1) {
								echo '&nbsp;<a style="float:right;" onclick="return addVert(\'additional_image' . $i . '\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
							}
							echo '</td><td>';
							echo '<input type="text" name="csv_import_field_additional_image[]" value="' . $csv_import_field_additional_image[$i] . '">';
							echo '</td></tr>';
						}
					}
					if (count($csv_import_field_additional_image) == 0 || $csv_import_field_additional_image[0] == '') {
						echo '<tr id="additional_image"><td style="width:200px;">';
						echo $text_field_additional_image;
						echo '&nbsp;<a style="float:right;" onclick="return addVert(\'additional_image\', this);" class="button"><span>More&nbsp;&darr;&nbsp;</span></a>';
						echo '</td><td>';
						echo '<input type="text" name="csv_import_field_additional_image[]">';
						echo '</td></tr>';
					}
					
	
					
					
				?>

			</table></td>
		</tr>
		</table>
	</div>
	<div id="tab_adjust">
		<table class="form">
		<tr class="instructions">
			<td colspan="3">Этот шаг позволяет Вам редактировать данные определенных колонок, поскольку файл CSV уже прочитан.</td>
		</tr>
		<tr>
			<td><?php echo $entry_split_category; ?><span class="help">Если категории и подкатегории находятся в одном и том же поле, Вы можете разбить их указав разделитель.</span></td>
            <td><input type="text" value="<?php echo $csv_import_split_category; ?>" name="csv_import_split_category" /></td>
        </tr>
		<tr>
			<td><?php echo $entry_price_multiplier; ?><span class="help">Например: Чтобы добавить 10% пишите 1.10, чтобы вычесть 10% пишите 0.90</span></td>
            <td><input type="text" value="<?php echo $csv_import_price_multiplier; ?>" name="csv_import_price_multiplier" /></td>
        </tr>
		<tr>
			<td><?php echo $entry_image_remove; ?><span class="help">Например: Если в Вашем CSV файле есть URL изображения с дополнительным текстом в начале (вида http://servername.com/...), Вы можете удалить его, вводя сюда текст, который хотите удалить.</span></td>
            <td><input type="text" value="<?php echo $csv_import_image_remove; ?>" name="csv_import_image_remove" /></td>
        </tr>
		<tr>
			<td><?php echo $entry_image_prepend; ?><span class="help">Например: Если в Вашем CSV файле есть поля с названием изображения, Вы можете ввести префикс data/, чтобы заставить его работать в OpenCart</span></td>
            <td><input type="text" value="<?php echo $csv_import_image_prepend; ?>" name="csv_import_image_prepend" /></td>
        </tr>
		<tr>
			<td><?php echo $entry_image_append; ?><span class="help">Например: Если названия Вашей картинки совпадают с полем SKU(Артикул), Вы можете добавить суффикс .jpg к полю SKU(Артикул) и использовать его в качестве изображений.</span></td>
            <td><input type="text" value="<?php echo $csv_import_image_append; ?>" name="csv_import_image_append" /></td>
        </tr>
		</table>
	</div>
	<div id="tab_import">
		<table class="form">
        <tr class="instructions">
        	<td colspan="3">Эта страница управляет импортом согласно Вашим настройкам. Во-первых, выберите вариант импорта - добавить, обновить или перезаписать. Так же вы можете исключить из импорта ненужные продукты, указав "Пропустить продукт в котором: &lt; КОЛОНКА&gt; содержит &lt; ЗНАЧЕНИЕ&gt;.
		Например, Вы захотите исключить все товары с нулевым остатком. В поле "КОЛОНКА" введите название столбца в вашем CSV файле, отвечающего за остатки , а в поле "ЗНАЧЕНИЕ" введите 0. Наконец, загрузите файл, или введите адрес ссылки на CSV файл и нажмите "импорт".</td>
        </tr>
		<!-- update/reset/add -->
		<tr>
			<td><?php echo $entry_import_type; ?></td>
			<td colspan="2">
				<select name="csv_import_type" onchange="updateText(this);">
					<option value="add"><?php echo $text_add; ?></option>	
					<option value="update"><?php echo $text_update; ?></option>	
					<option value="reset"><?php echo $text_reset; ?></option>
				</select>
				<span id="update_text">
				Основное поле для обновления: 
				<select name="csv_import_update_field">
					<option value="model"><?php echo $text_field_model; ?></option>	
					<option value="sku"><?php echo $text_field_sku; ?></option>	
					<option value="name"><?php echo $text_field_name; ?></option>
				</select>
				&nbsp;&nbsp;Обновить уже добавленные продукты с теми же значениями, добавить остальные.
				</span>
				<span id="add_text">&nbsp;&nbsp;Оставить текущие позиции, добавить все продукты как новые пункты</span>
				<span id="reset_text">&nbsp;&nbsp;Удалить все продукты из магазина, импортировать поля в пустой магазин</span>
		</tr>
		<!-- ignore where FIELD equals VALUE -->
		<tr>
			<td><?php echo $entry_ignore_fields; ?></td>
			<td colspan="2"><input type="text" name="csv_import_ignore_field" value="КОЛОНКА">&nbsp;содержит&nbsp;<input type="text" name="csv_import_ignore_value" value="ЗНАЧЕНИЕ"></td>
		</tr>
		<!-- File.. -->
		<tr>
            <td><?php echo $entry_import_file; ?></td>
            <td colspan="2"><input type="file" name="csv_import" /></td>
        </tr>
		<!-- ..or URL -->
		<tr>
            <td><?php echo $entry_import_url; ?></td>
			<td><input type="text" size="70" name="csv_import_feed_url" value="<?php echo $csv_import_feed_url ?>" />&nbsp;Распаковать архив <input type="checkbox" name="csv_import_unzip_feed" <?php if ($csv_import_unzip_feed) echo 'checked="1" '; ?>/></td>
            <td><a onclick="$('#csv_import').submit();" class="button"><span><?php echo $button_import; ?></span></a></td>
        </tr>
        </table>
       </div>
      </form>
  </div>
</div><script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script>
<?php echo $footer; ?>