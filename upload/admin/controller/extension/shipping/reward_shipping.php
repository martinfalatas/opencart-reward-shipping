<?php
class ControllerExtensionShippingRewardShipping extends Controller {
	private $error = array();

    private function fillAndSet($tag, $default = 0){
        if (isset($this->request->post[$tag])) {
            $data = $this->request->post[$tag];
        } elseif ($this->config->has($tag)) {
            $data = $this->config->get($tag);
        } else {
            $data = $default;
        }
        return $data;
    }


	public function index() {
		$this->load->language('extension/shipping/reward_shipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('reward_shipping', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}

		$data['heading_title']              = $this->language->get('heading_title');

		$data['text_enabled']               = $this->language->get('text_enabled');
		$data['text_disabled']              = $this->language->get('text_disabled');
		$data['text_all_zones']             = $this->language->get('text_all_zones');

		$data['entry_total']                = $this->language->get('entry_total');
		$data['help_total']                 = $this->language->get('help_total');

		$data['entry_cost']                 = $this->language->get('entry_cost');
		$data['help_cost']                  = $this->language->get('help_cost');

		$data['entry_unit']                 = $this->language->get('entry_unit');
		$data['help_unit']                  = $this->language->get('help_unit');

		$data['entry_show_unavailable']     = $this->language->get('entry_show_unavailable');
		$data['help_show_unavailable']      = $this->language->get('help_show_unavailable');

		$data['entry_show_notification']     = $this->language->get('entry_show_notification');
		$data['help_show_notification']      = $this->language->get('help_show_notification');

        $data['entry_geo_zone']             = $this->language->get('entry_geo_zone');
        $data['help_geo_zone']              = $this->language->get('help_geo_zone');

        $data['entry_store']                = $this->language->get('entry_store');
        $data['help_store']                 = $this->language->get('help_store');

        $data['entry_customer_group']       = $this->language->get('entry_customer_group');
        $data['help_customer_group']        = $this->language->get('help_customer_group');

        $data['entry_status']               = $this->language->get('entry_status');
        $data['entry_sort_order']           = $this->language->get('entry_sort_order');

        $data['entry_cancelled_statuses']   = $this->language->get('entry_cancelled_statuses');
        $data['help_cancelled_statuses']    = $this->language->get('help_cancelled_statuses');


        $data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_edit'] = $this->language->get('text_edit');


		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

        if (isset($this->error['warning_total'])) {
			$data['error_total'] = $this->error['warning_total'];
		} else {
			$data['error_total'] = '';
		}
        if (isset($this->error['warning_cost'])) {
			$data['error_cost'] = $this->error['warning_cost'];
		} else {
			$data['error_cost'] = '';
		}
        if (isset($this->error['warning_sort_order'])) {
            $data['error_sort_order'] = $this->error['warning_sort_order'];
        } else {
            $data['error_sort_order'] = '';
        }


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_shipping'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true)
        );

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/shipping/reward_shipping', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/shipping/reward_shipping', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true);


        $data['reward_shipping_total']              = $this->fillAndSet('reward_shipping_total');
        $data['reward_shipping_cost']               = $this->fillAndSet('reward_shipping_cost');
        $data['reward_shipping_unit']               = $this->fillAndSet('reward_shipping_unit', '');
        $data['reward_shipping_show_always']        = $this->fillAndSet('reward_shipping_show_always');
        $data['reward_shipping_user_notification']  = $this->fillAndSet('reward_shipping_user_notification');
        $data['reward_shipping_geo_zones']          = $this->fillAndSet('reward_shipping_geo_zones', array());
        $data['reward_shipping_stores']             = $this->fillAndSet('reward_shipping_stores', array());
        $data['reward_shipping_customer_groups']    = $this->fillAndSet('reward_shipping_customer_groups', array());
        $data['reward_shipping_sort_order']         = $this->fillAndSet('reward_shipping_sort_order');
        $data['reward_shipping_status']             = $this->fillAndSet('reward_shipping_status');
        $data['reward_shipping_cancelled_statuses'] = $this->fillAndSet('reward_shipping_cancelled_statuses', array());


        $this->load->model('customer/customer_group');
        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

        $this->load->model('localisation/geo_zone');
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->load->model('setting/store');
        $data['stores'] = $this->model_setting_store->getStores();

        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();


		$data['header']         = $this->load->controller('common/header');
		$data['column_left']    = $this->load->controller('common/column_left');
		$data['footer']         = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/shipping/reward_shipping', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/reward_shipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        //validate comma
        if( strstr($this->request->post['reward_shipping_total'], ",")) {
            $this->request->post['reward_shipping_total'] = str_replace(",", ".", $this->request->post['reward_shipping_total']) ;
        }
        if( strstr($this->request->post['reward_shipping_cost'], ",")) {
            $this->request->post['reward_shipping_cost'] = str_replace(",", ".", $this->request->post['reward_shipping_cost']) ;
        }

        //is digit
        if ( ( utf8_strlen($this->request->post['reward_shipping_total']) > 0) && !is_numeric($this->request->post['reward_shipping_total']) )  {
            $this->error['warning_total'] = $this->language->get('error_digit');
        }
        if ( ( utf8_strlen($this->request->post['reward_shipping_cost']) > 0) && !is_numeric($this->request->post['reward_shipping_cost']) )  {
            $this->error['warning_cost'] = $this->language->get('error_digit');
        }
        if ( ( utf8_strlen($this->request->post['reward_shipping_sort_order']) > 0) && !is_numeric($this->request->post['reward_shipping_sort_order']) )  {
            $this->error['warning_sort_order'] = $this->language->get('error_digit');
        }

        //default if empty
        if ( utf8_strlen($this->request->post['reward_shipping_total']) == 0 )  {
            $this->request->post['reward_shipping_total'] = 0;
        }
        if ( utf8_strlen($this->request->post['reward_shipping_cost']) == 0  )  {
            $this->request->post['reward_shipping_cost'] = 0;
        }

		return !$this->error;
	}


}