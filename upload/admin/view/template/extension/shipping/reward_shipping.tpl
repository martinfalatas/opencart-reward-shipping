<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-reward-shipping" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-reward-shipping" class="form-horizontal">


            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-total"><span data-toggle='tooltip' title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
                <div class="col-sm-10">
                    <input type="text" name="reward_shipping_total" value="<?php echo $reward_shipping_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
                    <?php if ($error_total) { ?>
                    <div class="text-danger"><?php echo $error_total; ?></div>
                    <?php } ?>
                </div>
              </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-cost"><span data-toggle='tooltip' title="<?php echo $help_cost; ?>"><?php echo $entry_cost; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="reward_shipping_cost" value="<?php echo $reward_shipping_cost; ?>" placeholder="<?php echo $entry_cost; ?>" id="input-cost" class="form-control" />
                    <?php if ($error_cost) { ?>
                    <div class="text-danger"><?php echo $error_cost; ?></div>
                    <?php } ?>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-show-always"><span data-toggle='tooltip' title="<?php echo $help_show_unavailable; ?>"><?php echo $entry_show_unavailable; ?></span></label>
                <div class="col-sm-10">
                    <select name="reward_shipping_show_always" id="input-show-always" class="form-control">
                        <?php if ($reward_shipping_show_always) { ?>
                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                        <option value="0"><?php echo $text_no; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_yes; ?></option>
                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-show-notification"><span data-toggle='tooltip' title="<?php echo $help_show_notification; ?>"><?php echo $entry_show_notification; ?></span></label>
                <div class="col-sm-10">
                    <select name="reward_shipping_user_notification" id="input-show-notification" class="form-control">
                        <?php if ($reward_shipping_user_notification) { ?>
                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                        <option value="0"><?php echo $text_no; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_yes; ?></option>
                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-unit"><span data-toggle='tooltip' title="<?php echo $help_unit; ?>"><?php echo $entry_unit; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="reward_shipping_unit" value="<?php echo $reward_shipping_unit; ?>" placeholder="<?php echo $entry_unit; ?>" id="input-unit" class="form-control" />
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
                    <select name="reward_shipping_geo_zones" id="input-geo-zone" class="form-control">
                        <option value="0"><?php echo $text_all_zones; ?></option>
                        <?php foreach ($geo_zones as $geo_zone) { ?>
                        <?php if ($geo_zone['geo_zone_id'] == $reward_shipping_geo_zones) { ?>
                        <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle='tooltip' title="<?php echo $help_store; ?>"><?php echo $entry_store; ?></span></label>
                <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                        <div class="checkbox">
                            <label>
                                <?php if (in_array(0, $reward_shipping_stores)) { ?>
                                <input type="checkbox" name="reward_shipping_stores[]" value="0" checked="checked" />
                                <?php echo $text_default; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="reward_shipping_stores[]" value="0" />
                                <?php echo $text_default; ?>
                                <?php } ?>
                            </label>
                        </div>
                        <?php foreach ($stores as $store) { ?>
                        <div class="checkbox">
                            <label>
                                <?php if (in_array($store['store_id'], $reward_shipping_stores)) { ?>
                                <input type="checkbox" name="reward_shipping_stores[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                                <?php echo $store['name']; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="reward_shipping_stores[]" value="<?php echo $store['store_id']; ?>" />
                                <?php echo $store['name']; ?>
                                <?php } ?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle='tooltip' title="<?php echo $help_customer_group; ?>"><?php echo $entry_customer_group; ?></span></label>
                <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">

                        <?php foreach ($customer_groups as $customer_group) { ?>
                        <div class="checkbox">
                            <label>
                                <?php if (in_array($customer_group['customer_group_id'], $reward_shipping_customer_groups)) { ?>
                                <input type="checkbox" name="reward_shipping_customer_groups[]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                                <?php echo $customer_group['name']; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="reward_shipping_customer_groups[]" value="<?php echo $customer_group['customer_group_id']; ?>" />
                                <?php echo $customer_group['name']; ?>
                                <?php } ?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle='tooltip' title="<?php echo $help_cancelled_statuses; ?>"><?php echo $entry_cancelled_statuses; ?></span></label>
                <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">

                        <?php foreach ($order_statuses as $order_status) { ?>
                        <div class="checkbox">
                            <label>
                                <?php if (in_array($order_status['order_status_id'], $reward_shipping_cancelled_statuses)) { ?>
                                <input type="checkbox" name="reward_shipping_cancelled_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
                                <?php echo $order_status['name']; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="reward_shipping_cancelled_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" />
                                <?php echo $order_status['name']; ?>
                                <?php } ?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="reward_shipping_sort_order" value="<?php echo $reward_shipping_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                    <?php if ($error_sort_order) { ?>
                    <div class="text-danger"><?php echo $error_sort_order; ?></div>
                    <?php } ?>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                    <select name="reward_shipping_status" id="input-status" class="form-control">
                        <?php if ($reward_shipping_status) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>


        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 