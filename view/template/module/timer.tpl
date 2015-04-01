<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php
    if($errors == true) { 
      foreach ($errors as $error) {
  ?>
    <div class="warning"><?php echo $error; ?></div>
  <?php 
      }
    } 
  ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/timer.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table  class="form">
          <tr>
            <td><?php echo $text_quantity; ?><br><?php echo $text_max_products . $max_products; ?></td>
            <td>
              <input type="text" name="timer[products]" value="<?php if(isset($timer['products'])){echo $timer['products'];} ?>" size="1" />
            </td>
          </tr>
          <tr>
            <td><?php echo $text_timer; ?></td>
            <td>
              <input type="checkbox" name="timer[timer]" value=1 <?php if(isset($timer['timer'])){echo "checked";} ?>>
            </td>
          </tr>
          <tr>
            <td><?php echo $text_total_discount; ?></td>
            <td>
              <input type="text" name="timer[total-discount]" value="<?php if(isset($timer['total-discount'])){echo $timer['total-discount'];} ?>" size="5" />
            </td>
          </tr>
          <tr>
            <td><?php echo $text_date_start; ?></td>
            <td>
              <input type="text" name="timer[date_start]" value="<?php if(isset($timer['date_start'])){echo $timer['date_start'];} ?>" class="date" size="7" />
            </td>
          </tr>
          <tr>
            <td><?php echo $text_date_end; ?></td>
            <td>
              <input type="text" name="timer[date_end]" value="<?php if(isset($timer['date_end'])){echo $timer['date_end'];} ?>" class="date" size="7" />
            </td>
          </tr>
          <tr>
            <td><?php echo $text_customer_group; ?></td>
            <td>
              <select name="timer[customer_group_id]">
                <?php foreach ($customer_groups as $customer_group) { ?>
                <option value="<?php echo $customer_group['customer_group_id']; ?>" <?php if(isset($timer['customer_group_id']) && $customer_group['customer_group_id'] == $timer['customer_group_id']){echo "selected";} ?>><?php echo $customer_group['name']; ?></option>
                <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td><?php echo $text_delete_all; ?></td>
            <td>
              <input type="checkbox" name="timer[delete]" value="1" <?php if(isset($timer['delete'])){echo "checked";} ?>>
            </td>
          </tr>
          <?php if(isset($success_products)){ ?>
          <tr>
            <td><center><?php echo $success_result; ?><center></td>
          </tr>        
          <tr >

          </tr>        
          <?php } ?>
        </table>
        <br>
        <?php
          if($allproducts == 0 OR !isset($allproducts) OR count($allproducts) == 0){
            echo "<center><h2>{$text_no_spec_products}</h2></center>";
          } else {
        ?>
        <h2><center><?=$text_all_spec_prods;?></center></h2>
        <table width="90%" style="margin:0px auto;">
          <tr style="text-align: center;">
            <td><?=$text_sp_id;?></td>
            <td><?=$text_sp_name_prod;?></td>
            <td><?=$text_sp_old_prices;?></td>
            <td><?=$text_sp_new_price;?></td>
            <td><?=$text_sp_date_start;?></td>
            <td><?=$text_sp_date_end;?></td>
            <td><?=$text_sp_timer;?></td>
            <td><?=$text_sp_cust_group;?></td>
          </tr>
          <?php
            foreach ($allproducts as $product) {
              echo "<tr style=\"text-align: center;\">";
              echo "<td>" . $product['product_id'] . "</td>";
              echo "<td style=\"text-align: left;\">" . $product['name'] . "</td>";
              echo "<td>" . $product['old_price'] . "</td>";
              echo "<td>" . $product['price'] . "</td>";
              echo "<td>" . $product['date_start'] . "</td>";
              echo "<td>" . $product['date_end'] . "</td>";
              echo "<td>" . $product['timer'] . "</td>";
              echo "<td>" . $product['customer_group_id'] . "</td>";
              echo "</tr>";
            }
          ?>      
        </table>
        <?php } ?>
        <br>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 

<?php echo $footer; ?>