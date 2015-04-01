<?php echo $header; ?>

<?php 

// Default values

if(empty($gazal_background_color)) $gazal_background_color ="eeeeee";

if(empty($gazal_title_font)) $gazal_title_font ="Archivo+Narrow";
if(empty($gazal_title_font_family)) $gazal_title_font_family ="Archivo Narrow";

if(empty($gazal_menu_font)) $gazal_menu_font ="Archivo+Narrow";
if(empty($gazal_menu_font_family)) $gazal_menu_font_family ="Archivo Narrow";
if(empty($gazal_menu_font_size)) $gazal_menu_font_size ="19";

if(empty($gazal_boxheading_font)) $gazal_boxheading_font ="Archivo+Narrow";
if(empty($gazal_boxheading_font_family)) $gazal_boxheading_font_family ="Archivo Narrow";
if(empty($gazal_boxheading_font_size)) $gazal_boxheading_font_size ="25";

if(empty($gazal_time_text)) $gazal_time_text ="";

if(empty($gazal_firstblock_title)) $gazal_firstblock_title ="";
if(empty($gazal_firstblock_desc)) $gazal_firstblock_desc ="";

if(empty($gazal_secondblock_title)) $gazal_secondblock_title ="";
if(empty($gazal_secondblock_desc)) $gazal_secondblock_desc ="";

if(empty($gazal_thirdblock_title)) $gazal_thirdblock_title ="";
if(empty($gazal_thirdblock_desc)) $gazal_thirdblock_desc ="";

if(empty($gazal_fourthblock_title)) $gazal_fourthblock_title ="";
if(empty($gazal_fourthblock_desc)) $gazal_fourthblock_desc ="";

if(empty($gazal_address)) $gazal_address ="";
if(empty($gazal_phone)) $gazal_phone ="";
if(empty($gazal_phone_second)) $gazal_phone_second ="";
if(empty($gazal_email)) $gazal_email ="";
if(empty($gazal_email_second)) $gazal_email_second ="";

if(empty($gazal_custom_widget_title)) $gazal_custom_widget_title ="";
if(empty($gazal_footer_info_text)) $gazal_footer_info_text ="";
if(empty($gazal_shipping_text)) $gazal_shipping_text ="";
if(empty($gazal_shipping_last_text)) $gazal_shipping_last_text ="";

if(empty($gazal_facebook_id)) $gazal_facebook_id ="";
if(empty($gazal_twitter_username)) $gazal_twitter_username ="";

if(empty($gazal_facebook_link)) $gazal_facebook_link ="";
if(empty($gazal_twitter_link)) $gazal_twitter_link ="";
if(empty($gazal_google_link)) $gazal_google_link ="";
if(empty($gazal_youtube_link)) $gazal_youtube_link ="";
if(empty($gazal_flickr_link)) $gazal_flickr_link ="";

if(empty($option_slideshow)) $option_slideshow ="grid_6";
?>

<style type="text/css">
	.customhelp { color: #666; font-size:0.9em; }
	.color { border:1px solid #AAA; }
	.pttrn {width:32px; display: inline-block; text-align: center;}
</style>



<div id="content">
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>

<div class="box">

	<div class="heading">
		<h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
		<div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
	</div>

	<div class="content wrapper">
	
    
    <div class="back_ptrn">

	<div class="option_wrap">
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        
    	<div class="heading">
        	<img src="../admin/view/image/logo-option.png" class="logo-option">
            <p>
            	If you have any question or problem, <span class="green" >feel free to open your ticket through our forum : </span><br/>
                <a target="_blank" href="http://support.venzastudio.com">Support Forum</a>
            </p>
            <select name="gazal_status" class="status_select">
				<?php if ($gazal_status) { ?>
				<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
				<option value="0"><?php echo $text_disabled; ?></option>

				<?php } else { ?>
				<option value="1"><?php echo $text_enabled; ?></option>
				<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
				<?php } ?>
			</select>
        </div><!--/heading-->
    
		<div class="clear"></div>
		
		<div id="settings_tabs" class="htabs-custom clearfix depts">
			<a href="#layout_settings" class="bod"><img src="../admin/view/image/bod.png" alt="" > Body</a>
            <a href="#container_settings" class="cont"><img src="../admin/view/image/cont.png" alt="" > Container</a>
            <a href="#colors_settings" class="colo"><img src="../admin/view/image/colors.png" alt="" > Colors</a>
            <a href="#fonts_settings" class="font"><img src="../admin/view/image/font.png" alt="" > Fonts</a>
            <a href="#buttons_settings" class="butt"><img src="../admin/view/image/buttons.png" alt="" > Buttons</a>
            <a href="#footer2_settings" class="foot"><img src="../admin/view/image/sett.png" alt="" > Custom Options</a>  
		</div>

		<div class="clear"></div>
		
   		<div class="data_right">
        
        <!--**************************************************************************************** Body ***************************-->
		<div id="layout_settings" class="divtab">

			<table class="form">

				<tr><td colspan="2"><h3><?php echo $entry_pattern_sub; ?></h3></td></tr>


 <!--****************************************************************
 ********************************************************************
 
 Body:
 
 *******************************************************************
  *******************************************************************
 -->


				<!--** Choose Pattern **--> 
				<tr>
					<td><?php echo $entry_pattern_overlay; ?></td>
					<td>
						<div>
							<?php for ($i = 1; $i <= 36; $i++) { ?>
								<div class="pttrn"><span class="customhelp"><?php echo $i; ?></span><img src="view/image/patterns/<?php echo $i; ?>.png" alt="pattern <?php echo $i; ?>"></div>
								<?php if(!($i%12)): ?>
									<br />
								<?php endif ?>
							<?php } ?>
						</div><br>
						<select name="gazal_pattern_overlay">
							<option value="none"selected="selected">none</option>
							<?php for ($i = 1; $i <= 36; $i++) { 
									($this->config->get('gazal_pattern_overlay')== $i) ? $currentpat = 'selected' : $currentpat = '';
								?>
								<option value="<?php echo $i; ?>" <?php echo $currentpat; ?>><?php echo $i; ?></option>';
								<?php } ?>
						</select>
						<span class="customhelp"><?php echo $entry_pattern_overlay_help; ?></span>
					</td>
				</tr>
				<!--** Upload Pattern **-->
				<tr>
					<td><?php echo $entry_custom_pattern; ?> </td>
					<td>
						<input type="hidden" name="gazal_custom_pattern" value="<?php echo $gazal_custom_pattern; ?>" id="gazal_custom_pattern" />
						<img src="<?php echo $gazal_pattern_preview; ?>" id="gazal_pattern_preview" />
						<br /><a onclick="image_upload('gazal_custom_pattern', 'gazal_pattern_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pattern_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_custom_pattern').attr('value', '');"><?php echo $text_clear; ?></a>
					</td>
				</tr>                             
                <!--** Upload Background Image **-->
				<tr>   
					<td>
						<?php echo $entry_custom_image; ?><br>
						<span class="customhelp"><?php echo $entry_custom_image_help; ?></span>
					</td>
					<td>
						<input type="hidden" name="gazal_custom_image" value="<?php echo $gazal_custom_image; ?>" id="gazal_custom_image" />
						<img src="<?php echo $gazal_image_preview; ?>" alt="" id="gazal_image_preview" />
						<br /><a onclick="image_upload('gazal_custom_image', 'gazal_image_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_image_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_custom_image').attr('value', '');"><?php echo $text_clear; ?></a>
					</td>
				</tr>
            	<!--** Main background color **-->
                    <tr>
                        <td><?php echo $entry_background_color; ?></td>
                        <td><input type="text" name="gazal_background_color" value="<?php echo $gazal_background_color; ?>" size="6" class="color {required:false,hash:true}"  /><span class="customhelp"><?php echo $entry_body_help; ?></span></td>
                    </tr> 
				</table>
				
			</div><!--/layout_settings-->

			
            
            <!--***************************************************************************************** container *******************-->
            <div id="container_settings" class="divtab">
    
                <table class="form">
                
                	  <tr><td colspan="2"><h3><?php echo $entry_pattern_sub_cont; ?></h3></td></tr>
                      <!--** Choose Pattern **-->                  
                      <tr>
                        <td><?php echo $entry_pattern_overlay; ?></td>
                        <td>
                            <div>
                                <?php for ($i = 1; $i <= 36; $i++) { ?>
                                    <div class="pttrn"><span class="customhelp"><?php echo $i; ?></span><img src="view/image/patterns/<?php echo $i; ?>.png" alt="pattern <?php echo $i; ?>"></div>
                                    <?php if(!($i%12)): ?>
                                        <br />
                                    <?php endif ?>
                                <?php } ?>
                            </div><br>
                            <select name="gazal_pattern_cont">
                                <option value="none"selected="selected">none</option>
                                <?php for ($i = 1; $i <= 36; $i++) { 
                                        ($this->config->get('gazal_pattern_cont')== $i) ? $currentpat = 'selected' : $currentpat = '';
                                    ?>
                                    <option value="<?php echo $i; ?>" <?php echo $currentpat; ?>><?php echo $i; ?></option>';
                                    <?php } ?>
                            </select>
                            <span class="customhelp"><?php echo $entry_pattern_overlay_help; ?></span>
                        </td>
                    </tr>             
                    <!--** Upload Pattern **-->
                    <tr>
                        <td><?php echo $entry_custom_pattern; ?> </td>
                        <td>
                            <input type="hidden" name="gazal_custom_pattern_cont" value="<?php echo $gazal_custom_pattern_cont; ?>" id="gazal_custom_pattern_cont" />
                            <img src="<?php echo $gazal_pattern_preview_cont; ?>" id="gazal_pattern_preview_cont" />
                            <br /><a onclick="image_upload('gazal_custom_pattern_cont', 'gazal_pattern_preview_cont');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pattern_preview_cont').attr('src', '<?php echo $no_image; ?>'); $('#gazal_custom_pattern_cont').attr('value', '');"><?php echo $text_clear; ?></a>
                        </td>
                    </tr>                 
                    <!--** Upload Background Image **-->
                    <tr>   
                        <td>
                            <?php echo $entry_custom_image; ?><br>
                            <span class="customhelp"><?php echo $entry_custom_image_help; ?></span>
                        </td>
                        <td>
                            <input type="hidden" name="gazal_custom_image_cont" value="<?php echo $gazal_custom_image_cont; ?>" id="gazal_custom_image_cont" />
                            <img src="<?php echo $gazal_image_preview_cont; ?>" alt="" id="gazal_image_preview_cont" />
                            <br /><a onclick="image_upload('gazal_custom_image_cont', 'gazal_image_preview_cont');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_image_preview_cont').attr('src', '<?php echo $no_image; ?>'); $('#gazal_custom_image_cont').attr('value', '');"><?php echo $text_clear; ?></a>
                        </td>
                    </tr>                     
                    <!--** Container background color **-->
                    <tr>
                        <td><?php echo $entry_gazal_background_color_cont; ?></td>
                        <td><input type="text" name="gazal_background_color_cont" value="<?php echo $gazal_background_color_cont; ?>" size="6" class="color {required:false,hash:true}"  /><span class="customhelp"><?php echo $entry_cont_help; ?></span></td>
                    </tr>         
                
                </table>
				
			</div>
        

            
<!--*******************************************************************************************
***********************************************************************************************


 Colors
 
 
 **********************************************************************************************
 *******************************************************************************************-->
 
<div id="colors_settings" class="divtab">
	
    <ul class="tabs-head tabs">
        <li><a href="#top"><?php echo $entry_header_tit; ?></a></li>      
        <li><a href="#blocks"><?php echo $entry_blocks; ?></a></li>
        <li><a href="#menuu"><?php echo $entry_menu_tit; ?></a></li>
        <li><a href="#cart"><?php echo $entry_cart_tit; ?></a></li>
        <li><a href="#search"><?php echo $entry_search_tit; ?></a></li>
        <li><a href="#category"><?php echo $entry_category_tit; ?></a></li>
        <li><a href="#box"><?php echo $entry_box_tit; ?></a></li>
        <li><a href="#product"><?php echo $entry_product_tit; ?></a></li>
        <li><a href="#general"><?php echo $entry_general_tit; ?></a></li>
        <li><a href="#footerr"><?php echo $entry_gazal_entry_footer; ?></a></li>
    </ul>
    
    <div class="tab_container">
    <!--///////////////////////////////////////////////////////////////////////////////// top-->
        <div id="top" class="tab_content">
        	<table class="form">
                <!--** First Theme color **-->
                <tr>
                    <td><?php echo $entry_thickbar_color; ?></td>
                    <td><input type="text" name="gazal_thickbar_color" value="<?php echo $gazal_thickbar_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Welcome text color **-->
                <tr>
                    <td><?php echo $entry_gazal_welcome_text_color; ?></td>
                    <td><input type="text" name="gazal_welcome_text_color" value="<?php echo $gazal_welcome_text_color; ?>" size="6" class="color {required:false,hash:true}"  /><span class="customhelp"><?php echo $entry_welcome_help; ?></span>
                    </td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// blocks-->
        <div id="blocks" class=" tab_content">
            <table class="form">
            	<!--** block title color **-->
                <tr>
                    <td><?php echo $entry_gazal_block_title_color; ?></td>
                    <td><input type="text" name="gazal_block_title_color" value="<?php echo $gazal_block_title_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** block desc color **-->
                <tr>
                    <td><?php echo $entry_gazal_block_desc_color; ?></td>
                    <td><input type="text" name="gazal_block_desc_color" value="<?php echo $gazal_block_desc_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// menu-->
        <div id="menuu" class=" tab_content">
            <table class="form">
            	<!--** Menu background color **-->
                <tr>
                    <td><?php echo $entry_gazal_menu_background; ?></td>
                    <td><input type="text" name="gazal_menu_background" value="<?php echo $gazal_menu_background; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>  
                <!--** Menu background border **-->
                <tr>
                    <td><?php echo $entry_gazal_menu_border; ?></td>
                    <td><input type="text" name="gazal_menu_border" value="<?php echo $gazal_menu_border; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>      
                <!--** Menu links background color on hover **-->
                <tr>
                    <td><?php echo $entry_gazal_menu_bg_links_hover; ?></td>
                    <td><input type="text" name="gazal_menu_bg_links_hover" value="<?php echo $gazal_menu_bg_links_hover; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                  
                <!--** Top menu links color **-->
                <tr>
                    <td><?php echo $entry_menu_color; ?></td>
                    <td><input type="text" name="gazal_menu_color" value="<?php echo $gazal_menu_color; ?>" size="6" class="color {required:false,hash:true}"  /><span class="customhelp"><?php echo $entry_menulinks_help; ?></span>
                    </td>
                </tr>
                <!--** Top menu links color :hover **-->
                <tr>
                    <td><?php echo $entry_gazal_menu_color_hover; ?></td>
                    <td><input type="text" name="gazal_menu_color_hover" value="<?php echo $gazal_menu_color_hover; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>             
                <!--** sub menu headings **-->
                <tr>
                    <td><?php echo $entry_gazal_sub_menu_heading; ?></td>
                    <td><input type="text" name="gazal_sub_menu_heading" value="<?php echo $gazal_sub_menu_heading; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** sub menu links **-->
                <tr>
                    <td><?php echo $entry_gazal_smenu_color; ?></td>
                    <td><input type="text" name="gazal_smenu_color" value="<?php echo $gazal_smenu_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** sub menu links on hover **-->
                <tr>
                    <td><?php echo $entry_gazal_smenuh_color; ?></td>
                    <td><input type="text" name="gazal_smenuh_color" value="<?php echo $gazal_smenuh_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// cart-->
        <div id="cart" class=" tab_content">
            <table class="form">
            	<!--** cart title **-->
                <tr>
                    <td><?php echo $entry_gazal_cart_title_color; ?></td>
                    <td><input type="text" name="gazal_cart_title_color" value="<?php echo $gazal_cart_title_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** cart desc **-->
                <tr>
                    <td><?php echo $entry_gazal_cart_desc_color; ?></td>
                    <td><input type="text" name="gazal_cart_desc_color" value="<?php echo $gazal_cart_desc_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// search-->
        <div id="search" class=" tab_content">
            <table class="form">
            	<!--** search bg **-->
                <tr>
                    <td><?php echo $entry_gazal_search_bg; ?></td>
                    <td><input type="text" name="gazal_search_bg" value="<?php echo $gazal_search_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                                 
                <!--** search border **-->
                <tr>
                    <td><?php echo $entry_gazal_search_border; ?></td>
                    <td><input type="text" name="gazal_search_border" value="<?php echo $gazal_search_border; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// category-->
        <div id="category" class=" tab_content">
            <table class="form">
            	<!--** category heading bg **--> 
                <tr>
                    <td><?php echo $entry_gazal_category_heading_bg; ?></td>
                    <td><input type="text" name="gazal_category_heading_bg" value="<?php echo $gazal_category_heading_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>        
                <!--** category heading border **--> 
                <tr>
                    <td><?php echo $entry_gazal_category_heading_border; ?></td>
                    <td><input type="text" name="gazal_category_heading_border" value="<?php echo $gazal_category_heading_border; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** category heading color **--> 
                <tr>
                    <td><?php echo $entry_gazal_category_heading_color; ?></td>
                    <td><input type="text" name="gazal_category_heading_color" value="<?php echo $gazal_category_heading_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                
                <!--** category links color **--> 
                <tr>
                    <td><?php echo $entry_gazal_category_link_color; ?></td>
                    <td><input type="text" name="gazal_category_link_color" value="<?php echo $gazal_category_link_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                
                <!--** category links color on hover **--> 
                <tr>
                    <td><?php echo $entry_gazal_category_link_color_hover; ?></td>
                    <td><input type="text" name="gazal_category_link_color_hover" value="<?php echo $gazal_category_link_color_hover; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                
                <!--** category internal title **--> 
                <tr>
                    <td><?php echo $entry_gazal_category_title; ?></td>
                    <td><input type="text" name="gazal_category_title" value="<?php echo $gazal_category_title; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// box-->
        <div id="box" class=" tab_content">
            <table class="form">
            	<!--** box heading bg **--> 
                <tr>
                    <td><?php echo $entry_gazal_heading_bg; ?></td>
                    <td><input type="text" name="gazal_heading_bg" value="<?php echo $gazal_heading_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>               
                <!--** box heading border **--> 
                <tr>
                    <td><?php echo $entry_gazal_heading_border; ?></td>
                    <td><input type="text" name="gazal_heading_border" value="<?php echo $gazal_heading_border; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>               
                <!--** box heading color **--> 
                <tr>
                    <td><?php echo $entry_gazal_heading_color; ?></td>
                    <td><input type="text" name="gazal_heading_color" value="<?php echo $gazal_heading_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                
                <!--** tabs heading bg **--> 
                <tr>
                    <td><?php echo $entry_gazal_heading_tabs_bg; ?></td>
                    <td><input type="text" name="gazal_heading_tabs_bg" value="<?php echo $gazal_heading_tabs_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr> 
                <!--** tabs heading border **--> 
                <tr>
                    <td><?php echo $entry_gazal_heading_tabs_border; ?></td>
                    <td><input type="text" name="gazal_heading_tabs_border" value="<?php echo $gazal_heading_tabs_border; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>  
                <!--** prodbcat title **--> 
                <tr>
                    <td><?php echo $entry_gazal_prodbcat_title; ?></td>
                    <td><input type="text" name="gazal_prodbcat_title" value="<?php echo $gazal_prodbcat_title; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** prodbcat viewall **--> 
                <tr>
                    <td><?php echo $entry_gazal_prodbcat_viewall; ?></td>
                    <td><input type="text" name="gazal_prodbcat_viewall" value="<?php echo $gazal_prodbcat_viewall; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** prodbcat tab bg **--> 
                <tr>
                    <td><?php echo $entry_gazal_prodbcat_tab_bg; ?></td>
                    <td><input type="text" name="gazal_prodbcat_tab_bg" value="<?php echo $gazal_prodbcat_tab_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** prodbcat tab bg select **--> 
                <tr>
                    <td><?php echo $entry_gazal_prodbcat_tab_bg_select; ?></td>
                    <td><input type="text" name="gazal_prodbcat_tab_bg_select" value="<?php echo $gazal_prodbcat_tab_bg_select; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** prodbcat tab link **--> 
                <tr>
                    <td><?php echo $entry_gazal_prodbcat_tab_link; ?></td>
                    <td><input type="text" name="gazal_prodbcat_tab_link" value="<?php echo $gazal_prodbcat_tab_link; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>    
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// product-->
        <div id="product" class=" tab_content">
            <table class="form">
            	<!--** product border **--> 
                <tr>
                    <td><?php echo $entry_gazal_product_border; ?></td>
                    <td><input type="text" name="gazal_product_border" value="<?php echo $gazal_product_border; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>  
            	<!--** sale bg **--> 
                <tr>
                    <td><?php echo $entry_gazal_sale_bg; ?></td>
                    <td><input type="text" name="gazal_sale_bg" value="<?php echo $gazal_sale_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>               
                <!--** price color **--> 
                <tr>
                    <td><?php echo $entry_gazal_price_color; ?></td>
                    <td><input type="text" name="gazal_price_color" value="<?php echo $gazal_price_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                
                <!--** old price color **--> 
                <tr>
                    <td><?php echo $entry_gazal_other_oldprice_color; ?></td>
                    <td><input type="text" name="gazal_other_oldprice_color" value="<?php echo $gazal_other_oldprice_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>                
                <!--** product name color **--> 
                <tr>
                    <td><?php echo $entry_gazal_product_name_color; ?></td>
                    <td><input type="text" name="gazal_product_name_color" value="<?php echo $gazal_product_name_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// general-->
        <div id="general" class=" tab_content">
            <table class="form">
            	<!--** Titles color **--> 
                <tr>
                    <td><?php echo $entry_title_color; ?></td>
                    <td><input type="text" name="gazal_title_color" value="<?php echo $gazal_title_color; ?>" size="6" class="color {required:false,hash:true}"  />
                        <span class="customhelp"><?php echo $entry_title_color_help; ?></span></td>
                </tr>               
                <!--** Body text color **-->
                <tr>
                    <td><?php echo $entry_body_color; ?></td>
                    <td><input type="text" name="gazal_bodytext_color" value="<?php echo $gazal_bodytext_color; ?>" size="6" class="color {required:false,hash:true}"  />
                        <span class="customhelp"><?php echo $entry_body_color_help; ?></span></td>
                </tr>
                <!--** Other links color **-->
                <tr>
                    <td><?php echo $entry_links_color; ?></td>
                    <td><input type="text" name="gazal_links_color" value="<?php echo $gazal_links_color; ?>" size="6" class="color {required:false,hash:true}"  /></td>
                </tr>
            </table>
        </div><!--/content-->
    <!--///////////////////////////////////////////////////////////////////////////////// footer-->
        <div id="footerr" class=" tab_content">
            <table class="form">
            	<!--** Footer bg **-->
                <tr>
                    <td><?php echo $entry_gazal_footer_bg; ?></td>
                    <td><input type="text" name="gazal_footer_bg" value="<?php echo $gazal_footer_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>  
                <!--** Footer bottom bg **-->
                <tr>
                    <td><?php echo $entry_gazal_footer_bottom_bg; ?></td>
                    <td><input type="text" name="gazal_footer_bottom_bg" value="<?php echo $gazal_footer_bottom_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>  
                <!--** Footer Headers color **-->
                <tr>
                    <td><?php echo $entry_gazal_footerheaders_color; ?></td>
                    <td><input type="text" name="gazal_footerheaders_color" value="<?php echo $gazal_footerheaders_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Footer Headers widgets color **-->
                <tr>
                    <td><?php echo $entry_gazal_footerheaderswid_color; ?></td>
                    <td><input type="text" name="gazal_footerheaderswid_color" value="<?php echo $gazal_footerheaderswid_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Footer Headers widgets bg **-->
                <tr>
                    <td><?php echo $entry_gazal_footerheaderswid_bg; ?></td>
                    <td><input type="text" name="gazal_footerheaderswid_bg" value="<?php echo $gazal_footerheaderswid_bg; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Footer Headers widgets border **-->
                <tr>
                    <td><?php echo $entry_gazal_footerheaderswid_border; ?></td>
                    <td><input type="text" name="gazal_footerheaderswid_border" value="<?php echo $gazal_footerheaderswid_border; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Footer first border color **-->
                <tr>
                    <td><?php echo $entry_gazal_first_border_color; ?></td>
                    <td><input type="text" name="gazal_first_border_color" value="<?php echo $gazal_first_border_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Footer second border color **-->
                <tr>
                    <td><?php echo $entry_gazal_second_border_color; ?></td>
                    <td><input type="text" name="gazal_second_border_color" value="<?php echo $gazal_second_border_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>   
                <!--** Footer info text color **-->
                <tr>
                    <td><?php echo $entry_gazal_footer_info_color; ?></td>
                    <td><input type="text" name="gazal_footer_info_color" value="<?php echo $gazal_footer_info_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Footer links color **-->
                <tr>
                    <td><?php echo $entry_gazal_footerlinks_color; ?></td>
                    <td><input type="text" name="gazal_footerlinks_color" value="<?php echo $gazal_footerlinks_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>
                <!--** Facebook Background color **-->
                <tr>
                    <td><?php echo $entry_facebook_bg_color; ?></td>
                    <td><input type="text" name="facebook_bg_color" value="<?php echo $facebook_bg_color; ?>" size="6" class="color {required:false,hash:true}"  />
                    </td>
                </tr>  
            </table>
        </div><!--/content-->
        
 	</div><!--tab_container-->

</div><!--/colors_settings-->
    
   
<!--*******************************************************************************************
***********************************************************************************************


 Fonts
 
 
 **********************************************************************************************
 *******************************************************************************************-->
 
            <div id="fonts_settings" class="divtab">

            <ul class="tabs-head tabs">
                <li><a href="#titlefont"><?php echo $entry_titles_sub; ?></a></li>
                <li><a href="#bodyfont"><?php echo $entry_body_sub; ?></a></li>
                <li><a href="#buttonfont"><?php echo $entry_buttons_sub; ?></a></li>
                <li><a href="#categoryfont"><?php echo $entry_category_sub; ?></a></li>
                <li><a href="#menufont"><?php echo $entry_menu_sub; ?></a></li>
                <li><a href="#productfont"><?php echo $entry_product_sub; ?></a></li>
                <li><a href="#pricefont"><?php echo $entry_price_sub; ?></a></li>
                <li><a href="#boxheadingfont"><?php echo $entry_boxheading_sub; ?></a></li>
            </ul>

			<div class="tab_container">
                <!--///////////////////////////////////////////////////////////////////////////////// title-->
                    <div id="titlefont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_title_font" value="<?php echo $gazal_title_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_title_font_family" value="<?php echo $gazal_title_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
                <!--///////////////////////////////////////////////////////////////////////////////// body-->
                    <div id="bodyfont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_body_font" value="<?php echo $gazal_body_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_body_font_family" value="<?php echo $gazal_body_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font size **-->
                            <tr>
                                <td><?php echo $entry_title_font_size; ?></td>
                                <td>
                                    <input type="text" name="gazal_body_font_size" value="<?php echo $gazal_body_font_size; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_size_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
                <!--///////////////////////////////////////////////////////////////////////////////// buttons-->
                    <div id="buttonfont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_button_font" value="<?php echo $gazal_button_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_button_font_family" value="<?php echo $gazal_button_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font size **-->
                            <tr>
                                <td><?php echo $entry_title_font_size; ?></td>
                                <td>
                                    <input type="text" name="gazal_button_font_size" value="<?php echo $gazal_button_font_size; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_size_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
               <!--///////////////////////////////////////////////////////////////////////////////// category-->
                    <div id="categoryfont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_category_font" value="<?php echo $gazal_category_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_category_font_family" value="<?php echo $gazal_category_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font size **-->
                            <tr>
                                <td><?php echo $entry_title_font_size; ?></td>
                                <td>
                                    <input type="text" name="gazal_category_font_size" value="<?php echo $gazal_category_font_size; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_size_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
               <!--///////////////////////////////////////////////////////////////////////////////// menu-->
                    <div id="menufont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_menu_font" value="<?php echo $gazal_menu_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_menu_font_family" value="<?php echo $gazal_menu_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font size **-->
                            <tr>
                                <td><?php echo $entry_title_font_size; ?></td>
                                <td>
                                    <input type="text" name="gazal_menu_font_size" value="<?php echo $gazal_menu_font_size; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_size_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
                <!--///////////////////////////////////////////////////////////////////////////////// product-->
                    <div id="productfont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_product_font" value="<?php echo $gazal_product_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_product_font_family" value="<?php echo $gazal_product_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font size **-->
                            <tr>
                                <td><?php echo $entry_title_font_size; ?></td>
                                <td>
                                    <input type="text" name="gazal_product_font_size" value="<?php echo $gazal_product_font_size; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_size_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
                <!--///////////////////////////////////////////////////////////////////////////////// price-->
                    <div id="pricefont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_price_font" value="<?php echo $gazal_price_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_price_font_family" value="<?php echo $gazal_price_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font size **-->
                            <tr>
                                <td><?php echo $entry_title_font_size; ?></td>
                                <td>
                                    <input type="text" name="gazal_price_font_size" value="<?php echo $gazal_price_font_size; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_size_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
               <!--///////////////////////////////////////////////////////////////////////////////// boxheading-->
                    <div id="boxheadingfont" class=" tab_content">
						<table class="form">
                            <!--** Title font on link **-->
                            <tr>
                                <td><?php echo $entry_title_font; ?></td>
                                <td>
                                    <input type="text" name="gazal_boxheading_font" value="<?php echo $gazal_boxheading_font; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font on css **-->
                            <tr>
                                <td><?php echo $entry_title_font_family; ?></td>
                                <td>
                                    <input type="text" name="gazal_boxheading_font_family" value="<?php echo $gazal_boxheading_font_family; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_family_help; ?></span>
                                </td>
                            </tr>
                            <!--** Title font size **-->
                            <tr>
                                <td><?php echo $entry_title_font_size; ?></td>
                                <td>
                                    <input type="text" name="gazal_boxheading_font_size" value="<?php echo $gazal_boxheading_font_size; ?>" size="6"  />
                                    <span class="customhelp"><?php echo $entry_title_font_size_help; ?></span>
                                </td>
                            </tr>
                        </table>
					</div>
            </div>

            </div><!--/fonts_settings-->
            
            
            
            
            
<!--*******************************************************************************************
***********************************************************************************************


 Buttons 
 
 
 **********************************************************************************************
 *******************************************************************************************-->
 
            <div id="buttons_settings" class="divtab">

                <table class="form">
                	<!--** Add to cart **-->
                    <tr>
                        <td><?php echo $entry_gazal_details_addtocart; ?></td>
                        <td><input type="text" name="gazal_details_addtocart" value="<?php echo $gazal_details_addtocart; ?>" size="6" class="color {required:false,hash:true}"  /></td>
                    </tr>
                    <!--** Product Details Add to cart : hover **-->
                    <tr>
                        <td><?php echo $entry_gazal_details_addtocart_hover; ?></td>
                        <td><input type="text" name="gazal_details_addtocart_hover" value="<?php echo $gazal_details_addtocart_hover; ?>" size="6" class="color {required:false,hash:true}"  /></td>
                    </tr>
                    <!--** Add to cart - color **-->
                    <tr>
                        <td><?php echo $entry_gazal_details_button_color; ?></td>
                        <td><input type="text" name="gazal_details_button_color" value="<?php echo $gazal_details_button_color; ?>" size="6" class="color {required:false,hash:true}"  />
                        </td>
                    </tr>
                    <!--** All other Add to cart **-->
                    <tr>
                        <td><?php echo $entry_gazal_all_addtocart; ?></td>
                        <td><input type="text" name="gazal_all_addtocart" value="<?php echo $gazal_all_addtocart; ?>" size="6" class="color {required:false,hash:true}"  /><span class="customhelp"><?php echo $entry_all_addtocart_button_help; ?></span></td>
                    </tr>          
                    <!--** All other Add to cart : hover **-->
                    <tr>
                        <td><?php echo $entry_gazal_all_addtocart_hover; ?></td>
                        <td><input type="text" name="gazal_all_addtocart_hover" value="<?php echo $gazal_all_addtocart_hover; ?>" size="6" class="color {required:false,hash:true}"  /><span class="customhelp"><?php echo $entry_all_addtocart_button_hover_help; ?></span></td>
                    </tr>                  
                    <!--** All other buttons color **-->
                    <tr>
                        <td><?php echo $entry_gazal_all_buttons_color; ?></td>
                        <td><input type="text" name="gazal_all_buttons_color" value="<?php echo $gazal_all_buttons_color; ?>" size="6" class="color {required:false,hash:true}"  /><span class="customhelp"><?php echo $entry_gazal_all_buttons_color_help; ?></span></td>
                    </tr>
                </table>
            
            </div><!--/buttons_settings-->
            
            
            
			
            
<!--*******************************************************************************************
***********************************************************************************************


  Custom Settings 
 
 
 **********************************************************************************************
 *******************************************************************************************-->
 
			<div id="footer2_settings" class="divtab">
			
            
            	<ul class="tabs-head tabs">
                	<li><a href="#timer"><?php echo $entry_gazal_timer; ?></a></li>
                    <li><a href="#firstblock"><?php echo $entry_gazal_firstblock; ?></a></li>
                    <li><a href="#secondblock"><?php echo $entry_gazal_secondblock; ?></a></li>
                    <li><a href="#thirdblock"><?php echo $entry_gazal_thirdblock; ?></a></li>
                    <li><a href="#fourthblock"><?php echo $entry_gazal_fourthblock; ?></a></li>
                    <li><a href="#contactWidget"><?php echo $entry_gazal_contact; ?></a></li>
                    <li><a href="#customWidget"><?php echo $entry_gazal_custom; ?></a></li>
                    <li><a href="#socialWidgets"><?php echo $entry_gazal_entry_widgets; ?></a></li>
                    <li><a href="#socialIcons"><?php echo $entry_gazal_entry_socialIcons; ?></a></li>
                    <li><a href="#payment"><?php echo $entry_gazal_payment_text; ?></a></li>
                    <li><a href="#others"><?php echo $entry_gazal_others; ?></a></li>
                    <li><a href="#customcss"><?php echo $entry_custom_css; ?></a></li>
                </ul>
            
            	<div class="tab_container">
                	<!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="timer" class="tab_content">
                    	<table class="form">
                    		<?php foreach ($languages as $language) { ?>
                        	<tr>   
                                <td><input type="text" name="gazal_time_text_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_time_text_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="firstblock" class="tab_content">
                        <table class="form">
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_firstblock_img" value="<?php echo $gazal_firstblock_img; ?>" id="gazal_firstblock_img" />
                                    <img src="<?php echo $gazal_firstblock_preview; ?>" alt="" id="gazal_firstblock_preview" />
                                    <br /><a onclick="image_upload('gazal_firstblock_img', 'gazal_firstblock_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_firstblock_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_firstblock_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                            </tr>
                            <?php foreach ($languages as $language) { ?>
                            <tr>
                                <td><?php echo $entry_gazal_firstblock_title; ?></td>
                                <td><input type="text" name="gazal_firstblock_title_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_firstblock_title_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_gazal_firstblock_desc; ?></td>
                                <td><input type="text" name="gazal_firstblock_desc_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_firstblock_desc_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="secondblock" class="tab_content">
                        <table class="form">
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_secondblock_img" value="<?php echo $gazal_secondblock_img; ?>" id="gazal_secondblock_img" />
                                    <img src="<?php echo $gazal_secondblock_preview; ?>" alt="" id="gazal_secondblock_preview" />
                                    <br /><a onclick="image_upload('gazal_secondblock_img', 'gazal_secondblock_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_secondblock_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_secondblock_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                            </tr>
                            
                            <?php foreach ($languages as $language) { ?>
                            <tr>
                                <td><?php echo $entry_gazal_secondblock_title; ?></td>
                                <td><input type="text" name="gazal_secondblock_title_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_secondblock_title_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_gazal_secondblock_desc; ?></td>
                                <td><input type="text" name="gazal_secondblock_desc_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_secondblock_desc_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="thirdblock" class="tab_content">
                        <table class="form">
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_thirdblock_img" value="<?php echo $gazal_thirdblock_img; ?>" id="gazal_thirdblock_img" />
                                    <img src="<?php echo $gazal_thirdblock_preview; ?>" alt="" id="gazal_thirdblock_preview" />
                                    <br /><a onclick="image_upload('gazal_thirdblock_img', 'gazal_thirdblock_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_thirdblock_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_thirdblock_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                            </tr>
                            
                            <?php foreach ($languages as $language) { ?>
                            <tr>
                                <td><?php echo $entry_gazal_thirdblock_title; ?></td>
                                <td><input type="text" name="gazal_thirdblock_title_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_thirdblock_title_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_gazal_thirdblock_desc; ?></td>
                                <td><input type="text" name="gazal_thirdblock_desc_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_thirdblock_desc_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="fourthblock" class="tab_content">
                        <table class="form">
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_fourthblock_img" value="<?php echo $gazal_fourthblock_img; ?>" id="gazal_fourthblock_img" />
                                    <img src="<?php echo $gazal_fourthblock_preview; ?>" alt="" id="gazal_fourthblock_preview" />
                                    <br /><a onclick="image_upload('gazal_fourthblock_img', 'gazal_fourthblock_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_fourthblock_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_fourthblock_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                            </tr>
                            
                            <?php foreach ($languages as $language) { ?>
                            <tr>
                                <td><?php echo $entry_gazal_fourthblock_title; ?></td>
                                <td><input type="text" name="gazal_fourthblock_title_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_fourthblock_title_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_gazal_fourthblock_desc; ?></td>
                                <td><input type="text" name="gazal_fourthblock_desc_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_fourthblock_desc_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="contactWidget" class="tab_content">
                        <table class="form">
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_contact_img" value="<?php echo $gazal_contact_img; ?>" id="gazal_contact_img" />
                                    <img src="<?php echo $gazal_contact_preview; ?>" alt="" id="gazal_contact_preview" />
                                    <br /><a onclick="image_upload('gazal_contact_img', 'gazal_contact_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_contact_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_contact_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                            </tr>
                            <?php foreach ($languages as $language) { ?>
                            <tr>
                                <td><?php echo $entry_gazal_address; ?></td>
                                <td><input type="text" name="gazal_address_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_address_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td><?php echo $entry_gazal_phone; ?></td>
                                <td><input type="text" name="gazal_phone" value="<?php echo $gazal_phone; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_gazal_phone_second; ?></td>
                                <td><input type="text" name="gazal_phone_second" value="<?php echo $gazal_phone_second; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_gazal_email; ?></td>
                                <td><input type="text" name="gazal_email" value="<?php echo $gazal_email; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_gazal_email_second; ?></td>
                                <td><input type="text" name="gazal_email_second" value="<?php echo $gazal_email_second; ?>" /></td>
                            </tr>
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="customWidget" class="tab_content">
                        <table class="form">
                        	<?php foreach ($languages as $language) { ?>
                        	<tr>   
                                <td><?php echo $entry_widget_title; ?></td>
                                <td><input type="text" name="gazal_custom_widget_title_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_custom_widget_title_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <tr>   
                                <td><?php echo $entry_gazal_footer_info_text; ?></td>
                                <td><textarea cols="50" rows="5" name="gazal_footer_info_text_<?php echo $language['language_id']; ?>"><?php echo ${'gazal_footer_info_text_' . $language['language_id']}; ?></textarea>
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_cus_img" value="<?php echo $gazal_cus_img; ?>" id="gazal_cus_img" />
                                    <img src="<?php echo $gazal_cus_preview; ?>" alt="" id="gazal_cus_preview" />
                                    <br /><a onclick="image_upload('gazal_cus_img', 'gazal_cus_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_cus_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_cus_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                            </tr>
                            <?php foreach ($languages as $language) { ?>
                            <tr>   
                                <td><?php echo $entry_gazal_shipping_text; ?></td>
                                <td><input type="text" name="gazal_shipping_text_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_shipping_text_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <tr>   
                                <td><?php echo $entry_gazal_shipping_last_text; ?></td>
                                <td><input type="text" name="gazal_shipping_last_text_<?php echo $language['language_id']; ?>" value="<?php echo ${'gazal_shipping_last_text_' . $language['language_id']}; ?>" />
                                	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="socialWidgets" class="tab_content">
                        <table class="form">
                        	<tr>
                                <td><?php echo $entry_facebook_id; ?></td>
                                <td><input type="text" name="gazal_facebook_id" value="<?php echo $gazal_facebook_id; ?>" /></td>
                            </tr>
                        </table>
                        <table class="form">
                        	<tr>
                            	<p style="font-size: 14px; font-weight: bold; color: #333; line-height: 19px;"><?php echo $entry_twitter_info; ?></p>
                            </tr>
                            <tr>
                                <td><?php echo $entry_twitter_username; ?></td>
                                <td><input type="text" name="gazal_twitter_username" value="<?php echo $gazal_twitter_username; ?>" /></td>
                            </tr> 
                            
                            <tr>
                                <td><?php echo $entry_twitter_consumer_key; ?></td>
                                <td><input type="text" name="consumer_keyy" value="<?php echo $consumer_keyy; ?>" /></td>
                            </tr> 
                            
                            <tr>
                                <td><?php echo $entry_twitter_consumer_secret; ?></td>
                                <td><input type="text" name="consumer_secrett" value="<?php echo $consumer_secrett; ?>" /></td>
                            </tr> 
                            
                            <tr>
                                <td><?php echo $entry_twitter_access_token; ?></td>
                                <td><input type="text" name="access_token" value="<?php echo $access_token; ?>" /></td>
                            </tr> 
                            
                            <tr>
                                <td><?php echo $entry_twitter_token_secret; ?></td>
                                <td><input type="text" name="token_secret" value="<?php echo $token_secret; ?>" /></td>
                            </tr> 
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="socialIcons" class="tab_content">
                        <table class="form">
                        	<tr>
                                <td><?php echo $entry_facebook_link; ?></td>
                                <td><input type="text" name="gazal_facebook_link" value="<?php echo $gazal_facebook_link; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_twitter_link; ?></td>
                                <td><input type="text" name="gazal_twitter_link" value="<?php echo $gazal_twitter_link; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_google_link; ?></td>
                                <td><input type="text" name="gazal_google_link" value="<?php echo $gazal_google_link; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_youtube_link; ?></td>
                                <td><input type="text" name="gazal_youtube_link" value="<?php echo $gazal_youtube_link; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_flickr_link; ?></td>
                                <td><input type="text" name="gazal_flickr_link" value="<?php echo $gazal_flickr_link; ?>" /></td>
                            </tr>
                            
                             <tr>
                                <td><?php echo $entry_vimeo_link; ?></td>
                                <td><input type="text" name="gazal_vimeo_link" value="<?php echo $gazal_vimeo_link; ?>" /></td>
                            </tr>
                            
                             <tr>
                                <td><?php echo $entry_linkedin_link; ?></td>
                                <td><input type="text" name="gazal_linkedin_link" value="<?php echo $gazal_linkedin_link; ?>" /></td>
                            </tr>
                            
                             <tr>
                                <td><?php echo $entry_digg_link; ?></td>
                                <td><input type="text" name="gazal_digg_link" value="<?php echo $gazal_digg_link; ?>" /></td>
                            </tr>
                            
                             <tr>
                                <td><?php echo $entry_dribbble_link; ?></td>
                                <td><input type="text" name="gazal_dribbble_link" value="<?php echo $gazal_dribbble_link; ?>" /></td>
                            </tr>
                            
                             <tr>
                                <td><?php echo $entry_pinterest_link; ?></td>
                                <td><input type="text" name="gazal_pinterest_link" value="<?php echo $gazal_pinterest_link; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_skype_link; ?></td>
                                <td><input type="text" name="gazal_skype_link" value="<?php echo $gazal_skype_link; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><?php echo $entry_rss_link; ?></td>
                                <td><input type="text" name="gazal_rss_link" value="<?php echo $gazal_rss_link; ?>" /></td>
                            </tr>
                        </table>
                    </div>
                    <!--/////////////////////////////////////////////////////////////////////////////////-->
                    <div id="payment" class="tab_content">
                    	<table class="form">
                        
                        	<!--============================================== pay 1 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay1_img" value="<?php echo $gazal_pay1_img; ?>" id="gazal_pay1_img" />
                                    <img src="<?php echo $gazal_pay1_preview; ?>" alt="" id="gazal_pay1_preview" />
                                    <br /><a onclick="image_upload('gazal_pay1_img', 'gazal_pay1_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay1_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay1_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay1_link" value="<?php echo $gazal_pay1_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 2 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay2_img" value="<?php echo $gazal_pay2_img; ?>" id="gazal_pay2_img" />
                                    <img src="<?php echo $gazal_pay2_preview; ?>" alt="" id="gazal_pay2_preview" />
                                    <br /><a onclick="image_upload('gazal_pay2_img', 'gazal_pay2_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay2_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay2_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay2_link" value="<?php echo $gazal_pay2_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 3 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay3_img" value="<?php echo $gazal_pay3_img; ?>" id="gazal_pay3_img" />
                                    <img src="<?php echo $gazal_pay3_preview; ?>" alt="" id="gazal_pay3_preview" />
                                    <br /><a onclick="image_upload('gazal_pay3_img', 'gazal_pay3_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay3_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay3_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay3_link" value="<?php echo $gazal_pay3_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 4 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay4_img" value="<?php echo $gazal_pay4_img; ?>" id="gazal_pay4_img" />
                                    <img src="<?php echo $gazal_pay4_preview; ?>" alt="" id="gazal_pay4_preview" />
                                    <br /><a onclick="image_upload('gazal_pay4_img', 'gazal_pay4_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay4_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay4_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay4_link" value="<?php echo $gazal_pay4_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 5 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay5_img" value="<?php echo $gazal_pay5_img; ?>" id="gazal_pay5_img" />
                                    <img src="<?php echo $gazal_pay5_preview; ?>" alt="" id="gazal_pay5_preview" />
                                    <br /><a onclick="image_upload('gazal_pay5_img', 'gazal_pay5_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay5_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay5_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay5_link" value="<?php echo $gazal_pay5_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 6 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay6_img" value="<?php echo $gazal_pay6_img; ?>" id="gazal_pay6_img" />
                                    <img src="<?php echo $gazal_pay6_preview; ?>" alt="" id="gazal_pay6_preview" />
                                    <br /><a onclick="image_upload('gazal_pay6_img', 'gazal_pay6_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay6_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay6_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay6_link" value="<?php echo $gazal_pay6_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 7 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay7_img" value="<?php echo $gazal_pay7_img; ?>" id="gazal_pay7_img" />
                                    <img src="<?php echo $gazal_pay7_preview; ?>" alt="" id="gazal_pay7_preview" />
                                    <br /><a onclick="image_upload('gazal_pay7_img', 'gazal_pay7_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay7_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay7_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay7_link" value="<?php echo $gazal_pay7_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 8 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay8_img" value="<?php echo $gazal_pay8_img; ?>" id="gazal_pay8_img" />
                                    <img src="<?php echo $gazal_pay8_preview; ?>" alt="" id="gazal_pay8_preview" />
                                    <br /><a onclick="image_upload('gazal_pay8_img', 'gazal_pay8_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay8_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay8_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay8_link" value="<?php echo $gazal_pay8_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 9 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay9_img" value="<?php echo $gazal_pay9_img; ?>" id="gazal_pay9_img" />
                                    <img src="<?php echo $gazal_pay9_preview; ?>" alt="" id="gazal_pay9_preview" />
                                    <br /><a onclick="image_upload('gazal_pay9_img', 'gazal_pay9_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay9_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay9_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay9_link" value="<?php echo $gazal_pay9_link; ?>" /></td>
                            </tr>
                            
                            <!--============================================== pay 10 -->
                        	
                        	<tr>   
                                <td>
                                    <?php echo $entry_custom_image; ?><br>
                                </td>
                                <td>
                                    <input type="hidden" name="gazal_pay10_img" value="<?php echo $gazal_pay10_img; ?>" id="gazal_pay10_img" />
                                    <img src="<?php echo $gazal_pay10_preview; ?>" alt="" id="gazal_pay10_preview" />
                                    <br /><a onclick="image_upload('gazal_pay10_img', 'gazal_pay10_preview');"><?php echo $text_select; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#gazal_pay10_preview').attr('src', '<?php echo $no_image; ?>'); $('#gazal_pay10_img').attr('value', '');"><?php echo $text_clear; ?></a>
                                </td>
                                <td><?php echo $entry_gazal_pay_link; ?></td>
                                <td><input type="text" name="gazal_pay10_link" value="<?php echo $gazal_pay10_link; ?>" /></td>
                            </tr>
                        </table> 
                        
                        
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="others" class="tab_content">
                        <table class="form">
                        	<tr>
                                <td><?php echo $entry_option_slideshow; ?></td>
                                <td><input type="text" name="option_slideshow" value="<?php echo $option_slideshow; ?>" /></td>
                                <td><span class="customhelp"><?php echo $entry_slideshow_help; ?></span></td>
                                <td><span class="customhelp"><?php echo $entry_slideshow_values_help; ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <!--///////////////////////////////////////////////////////////////////////////////// -->
                    <div id="customcss" class="tab_content">
                        <table class="form">
                        	<tr>
                            <td>
                            <textarea name="custom_css" cols="100" rows="50" style="border-radius: 5px 5px 5px 5px; border-color: #fff; padding: 20px;font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;"><?php echo $custom_css; ?></textarea>
                            </td>
                            </tr>
                        </table>
                    </div>
                </div><!--/tab_container-->

			</div><!--/footer_settings-->
	   </div><!--/data_right-->
	</form>
		
	</div>
    </div>
</div><!--back_ptrn-->
</div>

<?php echo $footer; ?>

<script>
// Tabs
//---------------------------------------------
/* <![CDATA[ */
$(document).ready(function(){
	$(".tab_content").hide();
$("ul.tabs").each(function() {
    $(this).find('li:first').addClass("active");
    $(this).next('.tab_container').find('.tab_content:first').show();
});

$("ul.tabs li a").click(function() {
    var cTab = $(this).closest('li');
    cTab.siblings('li').removeClass("active");
    cTab.addClass("active");
    cTab.closest('ul.tabs').nextAll('.tab_container:first').find('.tab_content').hide(); 

    var activeTab = $(this).attr("href"); //Find the href attribute value to identify the active tab + content
    $(activeTab).fadeIn(); //Fade in the active ID content
    return false;
});
});
/* ]]> */
</script>

<script type="text/javascript">

	$('#settings_tabs a').tabs(); 
	$('#footer_settings_tabs a').tabs();

</script>

<script type="text/javascript" src="view/javascript/jscolor/jscolor.js"></script> 

<script type="text/javascript"><!--

$(document).ready(function() {

	$('	#gazal_background_color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
	 });

//--></script>

<script type="text/javascript"><!--
function image_upload(field, preview) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 

<script>

</script>