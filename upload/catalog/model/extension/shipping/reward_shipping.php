<?php
class ModelExtensionShippingRewardShipping extends Model {
	function getQuote($address) {
		$this->load->language('extension/shipping/reward_shipping');

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('reward_shipping_geo_zones') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
        if (!$this->config->get('reward_shipping_geo_zones')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }


		if ($status) {
			$store = $this->config->get('config_store_id');
			$allowed_stores = $this->config->get('reward_shipping_stores');
			if (empty($allowed_stores)) { $allowed_stores = array(); }
			if (!in_array($store,$allowed_stores)) {
				$status = false;
			}
		}


        if ($this->config->get('reward_shipping_total') > 0 && $this->config->get('reward_shipping_total') > $this->cart->getTotal()) {
            $status = false;
        }


        
        $customer_id = $this->session->data['customer_id'];

        $this->load->model('account/customer');
        $customer_info = $this->model_account_customer->getCustomer($customer_id);

        //clear temp if customer return during checkout proccess
        $this->removeTmpPoints();


        if ($status) {
            $customer_group = $customer_info['customer_group_id'];
            $allowed_customer_groups = $this->config->get('reward_shipping_customer_groups');
            $allowed_customer_groups = empty($allowed_customer_groups) ? array() : $allowed_customer_groups;
            if (!in_array($customer_group, $allowed_customer_groups)) {
                $status = false;
            }
        }


		$customer_points_total =  $this->model_account_customer->getRewardTotal($customer_id);
		$points_used = 0;
        $points_used = (isset($this->session->data['reward'])) ? $this->session->data['reward'] : $points_used;


        //not enought points
		if (($points_used + (int)$this->config->get('reward_shipping_cost')) > (int)$customer_points_total && (int)$this->config->get('reward_shipping_show_always') == 0) {
			$status = false;
		}

        $disable_radio = false;
        if (( $points_used + (int)$this->config->get('reward_shipping_cost')) > (int)$customer_points_total && (int)$this->config->get('reward_shipping_show_always') == 1 ) {
            $disable_radio = true;
        }

		if (($points_used + (int)$this->config->get('reward_shipping_cost')) > (int)$customer_points_total) {
			$text_description = $this->language->get('text_reward_shipping_unavailable');
		} else {
			$text_description = $this->language->get('text_reward_shipping_available');
		}
		
		$method_data = array();
	
		if ($status) {
			$quote_data = array();
			
			$quote_data['reward_shipping'] = array(
				'code'         => 'reward_shipping.reward_shipping',
				'title'        => $text_description,
				'cost'         => 0.00,
				'tax_class_id' => 0,
				'text'         => (int)$this->config->get('reward_shipping_cost') . ' ' . $this->config->get('reward_shipping_unit'),
                'disable_radio'=> $disable_radio
			);

			$method_data = array(
				'code'       => 'reward_shipping',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('reward_shipping_sort_order'),
				'error'      => false
			);
		}
	
		return $method_data;
	}

    //use also controller cart
    public function removeTmpPoints(){
        $this->db->query("DELETE FROM `" . DB_PREFIX . "customer_reward` WHERE order_id = '0' AND customer_id = '".$this->session->data['customer_id']."' AND note = 'REWARD_SHIPPING_TMP'");
    }


}
?>