<script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/loginza2.css" />
<? /* ==================== Крупные значки таблицей ======================= */ ?>
<? if( $loginza2_format == 'table' ) { ?>
	<div class="simplecheckout-block-heading simple_loginza_table_content">	
		#loginza_label#
		<div align=center class="simple_loginza_table_links">
		<iframe src="http://loginza.ru/api/widget?overlay=loginza<? 
		if( $loginza2_default ) 
		echo '&provider='.$loginza2_default;  
		?>&token_url=<? 
		echo urlencode('http://'.$_SERVER['HTTP_HOST'].'/index.php?route=account/loginza2'); 
		?>&providers_set=<? echo $providers; ?>&lang=#lang#" 
		style="width:359px;height:180px;" scrolling="no" frameborder="no"></iframe>
		</div>
	</div>
<? } ?>
<? /* ====================  / END Крупные значки таблицей ======================= */ ?>

<? /* ==================== Кнопка Логинзы ============== */ ?>
<? if( $loginza2_format == 'button' ) { ?>
	<div class="simplecheckout-block-heading simple_loginza_button_content">
			#loginza_label#	
			<div  class="simple_loginza_button_links">
				<a class="<?php echo $classname; ?>" href="http://loginza.ru/api/widget?token_url=<? echo urlencode('http://'.$_SERVER['HTTP_HOST'].'/index.php?route=account/loginza2'); 
				?><? if( $loginza2_default ) 
				echo '&provider='.$loginza2_default;
				?>&providers_set=<? echo $providers; ?>&lang=#lang#">
				<img src="http://loginza.ru/img/sign_in_button_gray.gif" 
				alt="#loginza_label#" />
				</a>
			</div>
	</div>	  
<? } ?>
<? /* ====================  / END Кнопка Логинзы ============== */ ?>		  

<? /* ==================== Маленькие иконки ============== */ ?>
		  
		  <? if( $loginza2_format == 'icons' ) { 
		  ?>
		  <div class="simplecheckout-block-heading simple_loginza_icons_content">
			#loginza_label#
		  
		  
		  <div class="simple_loginza_icons_links">
		  <? foreach( $res_socnets as $row ) { ?>
		  <a  class="<?php echo $classname; ?>"  href="https://loginza.ru/api/widget?token_url=<? 
			echo urlencode('http://'.$_SERVER['HTTP_HOST'].'/index.php?route=account/loginza2'); 
			?>&provider=<? echo $row['name']; ?>&lang=#lang#"
			><img src="/image/loginza/icons/<? echo $row['name']; ?>.png" alt="<? echo $row['label']; ?>"
			></a>&nbsp;
			
		  <? } ?>
		  </div>
</div>		  
		<? } ?>
<? /* ==================== / END Маленькие иконки ============== */ ?>