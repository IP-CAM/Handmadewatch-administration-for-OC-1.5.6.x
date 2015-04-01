<?php echo $header; ?>
<style type="text/css">#ticket-module img{margin-top: 0;}</style>
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
      <h1><img src="view/image/ticket.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_subject; ?></td>
            <td><span><?php echo $subject; ?></span></td>
          </tr>
          <tr>
            <td><?php echo $entry_name; ?></td>
            <td><span><?php echo $customer_name; ?></span></td>
          </tr>
          <tr>
            <td><?php echo $entry_email; ?></td>
            <td><span><?php echo $customer_email; ?></span></td>
          </tr>
          <tr>
            <td><?php echo $entry_department; ?></td>
            <td><?php echo $department; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><span><?php echo $status; ?></span></td>
          </tr>
          <?php if($order_status){ ?>
          <tr>
            <td><?php echo $entry_order; ?></td>
            <td><span>#<?php echo $order; ?></span></td>
          </tr>
          <?php } ?>
          <?php echo $formdata; ?>
        </table>
    </div>
  </div>
  <?php if ( $is_user == true ){ ?>
    <div id="ticket-module">
    <div class="heading">
      <h1><img src="view/image/mail.png" alt="" /> <?php echo $heading_chat; ?></h1>
    </div>
    	<?php foreach ($messages as $data){ ?>
		<div class="row-fluid">
			<?php if ($data['is_user'] == false){ ?>
			<div class="span1 offset1"><?php if (isset($data['file']) && !empty($data['file'])){ ?><a href="<?php echo HTTP_IMAGE . $data['file']; ?>">Download File</a><?php } ?></div>
          <div class="span9">
			     <div class="alert alert-error" style="word-wrap: break-word;">
		         <?php echo $data['content']; ?>
	         </div>
          <div style="color: silver; font-size: 12px;margin-left:0;" class="span4 offset2"><?php echo date('d-F-Y (h:i A)', strtotime($data['created'])); ?></div>
          </div>
	        <div class="span1" >
	        	<img src="<?php echo HTTP_IMAGE; ?>support.jpg" />
	        	<div class="caption"><span class="badge badge-info" style="color: white;"><?php echo $text_admin; ?></span></div>
	        </div>
			
		    <?php }else{ ?>
		    <div class="span1" >
	        	<img src="<?php echo HTTP_IMAGE; ?>customer.jpg" />
	        	<div class="caption"><span class="badge badge-info" style="color: white;"><?php echo $text_you; ?></span></div>
	        </div>
			<div class="alert alert-success span9" style="word-wrap: break-word;">
		        <?php echo $data['content']; ?>
	        </div>
	        <div class="span2"><?php if (isset($data['file']) && !empty($data['file'])){ ?><a href="<?php echo HTTP_IMAGE . $data['file']; ?>">Download File</a><?php } ?></div>
	        <div style="color: silver; font-size: 12px;float: right;" class="span4 offset7"><?php echo date('d-F-Y (h:i A)', strtotime($data['created'])); ?></div>
			<?php } ?>
		</div>
		<div style="height: 30px;"></div>
		<?php } ?>
        
    	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" id="form">
    	  	<div class="row-fluid">
	    	  	<div class="span1 offset1">Attach File: </div>
		        <div class="span8 fileupload fileupload-new" data-provides="fileupload">
				  <div class="input-append">
				    <div class="uneditable-input span3">
					    <i class="icon-file fileupload-exists"></i> 
					    <span class="fileupload-preview"></span>
				    </div>
				    <span class="btn btn-file">
				    	<span class="fileupload-new">Select file</span>
				    	<span class="fileupload-exists">Change</span>
				    	<input class="attach-file" type="file" name="file" />
				    </span>
				    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
				  </div>
		        </div>
		        <?php if ($error_attach) { ?>
	              <div class="span10 offset2"><span class="error"><?php echo $error_attach; ?></span></div>
	              <?php } ?>
	        </div>
	        <div class="row-fluid">
	    		<div class="span1 offset1"><span class="required">*</span><?php echo $entry_message; ?>: </div>
	            <div class="span8"><textarea rows="3" name="message" style="width: 90%; "><?php echo $message; ?></textarea></div>
	            <?php if ($error_message) { ?>
	              <div class="span10 offset2"><span class="error"><?php echo $error_message; ?></span></div>
	              <?php } ?>
            </div>
    	</form>
    	<div class="span4 offset4" style="position: absolute; z-index: 1000;">
	      <a class="btn btn-success" onclick="$('form').submit();"><span><?php echo $button_send; ?></span></a>
	      <a class="btn btn-danger" style="color: white;" href="<?php echo $cancel; ?>"><span><?php echo $button_cancel?></span></a>
	    </div>
	    <div style="height: 30px;"></div>
    </div>
  <?php } ?>
</div>
<?php echo $footer; ?> 