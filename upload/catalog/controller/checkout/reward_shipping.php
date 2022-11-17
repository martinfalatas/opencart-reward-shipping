<?php
class ControllerCheckoutRewardShipping extends Controller {

    public function add(){
        $this->load->language('extension/shipping/reward_shipping');

            $check_query = $this->db->query("SELECT * FROM "
                . DB_PREFIX . "customer_reward "
                . "WHERE   customer_id = '" . $this->session->data['customer_id']
                . "' AND   order_id    = '0"
                . "' AND   note = 'REWARD_SHIPPING_TEMP'");
            if (!$check_query->num_rows) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "customer_reward "
                    . " SET customer_id = '" . $this->session->data['customer_id']
                    . "',   order_id    = '0"
                    . "',   description = '" . $this->db->escape($this->language->get('text_reward_shipping_temp'))
                    . "',   points      = '-" . $this->config->get('reward_shipping_cost')
                    . "',   note = 'REWARD_SHIPPING_TMP"
                    . "', date_added = NOW()"
                );
            }

        $json = array();

        if($this->config->get('reward_shipping_user_notification')){
            $json['success'] = $this->language->get('text_reward_shipping_points_removed');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

	}

    public function delete(){
        $this->load->language('extension/shipping/reward_shipping');
        $this->db->query("DELETE FROM `" . DB_PREFIX . "customer_reward` WHERE order_id = '0' AND customer_id = '".$this->session->data['customer_id']."' AND note = 'REWARD_SHIPPING_TMP'");

        $json = array();

        if($this->config->get('reward_shipping_user_notification')){
            $json['success'] = $this->language->get('text_reward_shipping_points_returned');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
