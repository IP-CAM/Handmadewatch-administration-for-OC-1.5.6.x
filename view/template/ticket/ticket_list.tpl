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
  <div class="box" id="ticket-module">
    <div class="heading">
      <h1><img src="view/image/ticket.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
      	<a onclick="location = '<?php echo $all; ?>'" class="btn btn-primary" style="color: white;"><?php echo $button_all; ?></a>
      	<a onclick="location = '<?php echo $yours; ?>'" class="btn btn-primary" style="color: white;"><?php echo $button_yours; ?> <strong style="color: red;">(<?php echo $total_yours; ?>)</strong></a>
      	<a onclick="location = '<?php echo $new; ?>'" class="btn btn-primary" style="color: white;"><?php echo $button_new; ?> <strong style="color: red;">(<?php echo $total_new; ?>)</strong></a>
      	<a onclick="$('form').attr('action', '<?php echo $archived; ?>'); $('form').submit();" class="btn btn-primary" style="color: white;"><?php echo $button_archived; ?></a>
      	<a onclick="$('form').attr('action', '<?php echo $resolved; ?>'); $('form').submit();" class="btn btn-primary" style="color: white;"><?php echo $button_resolved; ?></a>
      	<a onclick="$('form').attr('action', '<?php echo $resolving; ?>'); $('form').submit();" class="btn btn-primary" style="color: white;"><?php echo $button_resolving; ?></a>
        <a onclick="$('form').attr('action', '<?php echo $delete; ?>'); $('form').submit();" class="btn btn-primary" style="color: white;"><?php echo $button_delete; ?></a>
      </div>
    </div>
    <div class="content">
      <form method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td width="1">ID#</td>
              <td class="left"><?php if ($sort == 'subject') { ?>
                <a href="<?php echo $sort_subject; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_subject; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_subject; ?>"><?php echo $column_subject; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'department') { ?>
                <a href="<?php echo $sort_department; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_department; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_department; ?>"><?php echo $column_department; ?></a>
                <?php } ?></td>
              <td class="left"><?php echo $column_assign; ?></td>
              <td class="left"><?php if ($sort == 'status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'date_added') { ?>
                <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'last_update') { ?>
                <a href="<?php echo $sort_last_update; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_last_update; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_last_update; ?>"><?php echo $column_last_update; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($tickets) { ?>
            <?php foreach ($tickets as $ticket) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($ticket['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $ticket['ticket_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $ticket['ticket_id']; ?>" />
                <?php } ?></td>
              <td class="center"><?php echo $ticket['ticket_id']; ?></td>
              <td class="left"><?php echo $ticket['subject']; ?></td>
              <td class="left"><?php echo $ticket['department']; ?></td>
              <td class="left"><?php echo $ticket['user']; ?></td>
              <?php
              $class = ''; 
              	switch ($ticket['status']){
              		case 'Resolved':
              			$class = 'label-important';
              			break;
              			
              		case 'New':
              			$class = 'label-success';
              			break;
              			
              		default:
              			$class = 'label-info';
              			break;
              	}
              ?>
              <td class="center"><span style="color: white;" class="label <?php echo $class; ?>"><?php echo $ticket['status']; ?></span></td>
              <td class="left"><?php echo $ticket['date_added']; ?></td>
              <td class="left"><?php echo $ticket['last_update']; ?></td>
              <td class="right"><?php foreach ($ticket['action'] as $key => $action) { ?>
                [ <a <?php if ($key == 2){ ?>onclick="return confirm('You sure continue?'); "<?php } ?> href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 