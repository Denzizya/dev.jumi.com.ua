<?php

class ControllerExtensionModulePricecontrol extends Controller {

    private $version = '1.0';
    private $error = array();
    private $token_var;
    private $extension_var;
    private $prefix;

    public function __construct($registry) {
        parent::__construct($registry);
        $this->token_var = (version_compare(VERSION, '3.0', '>=')) ? 'user_token' : 'token';
        $this->extension_var = (version_compare(VERSION, '3.0', '>=')) ? 'marketplace' : 'extension';
        $this->prefix = (version_compare(VERSION, '3.0', '>=')) ? 'module_' : '';
    }

    public function install() {

    }

    public function uninstall() {

    }

    public function index() {
        $data = $this->load->language('extension/module/pricecontrol');

        $heading_title = preg_replace('/^.*?\|\s?/ius', '', $this->language->get('heading_title'));
        $data['heading_title'] = $heading_title;
        $this->document->setTitle($heading_title);

        if (isset($this->request->get['store_id'])) {
            $store_id = $this->request->get['store_id'];
        } else {
            $store_id = 0;
        }

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting($this->prefix . 'pricecontrol', $this->request->post, $store_id);

            $this->session->data['success'] = $this->language->get('text_success');

            if (isset($this->request->post['apply'])) {
                $this->response->redirect($this->url->link('extension/module/pricecontrol', $this->token_var . '=' . $this->session->data[$this->token_var] . '&store_id=' . $store_id, true));
            } else {
                $this->response->redirect($this->url->link($this->extension_var . '/extension', $this->token_var . '=' . $this->session->data[$this->token_var] . '&type=module', true));
            }
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['store_id'] = $store_id;
        $this->load->model('setting/store');
        $stores = $this->model_setting_store->getStores();
        $data['multistore'] = array();
        $data['multistore'][] = array(
            'store_id' => 0,
            'name' => $this->language->get('text_default'),
            'href' => $this->url->link('extension/module/pricecontrol', $this->token_var . '=' . $this->session->data[$this->token_var] . '&store_id=0', true),
        );
        
        if ($stores) {
            foreach ($stores as $store) {
                $data['multistore'][] = array(
                    'store_id' => $store['store_id'],
                    'name' => $store['name'],
                    'href' => $this->url->link('extension/module/pricecontrol', $this->token_var . '=' . $this->session->data[$this->token_var] . '&store_id=' . $store['store_id'], true),
                );
            }
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', $this->token_var . '=' . $this->session->data[$this->token_var], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link($this->extension_var . '/extension', $this->token_var . '=' . $this->session->data[$this->token_var] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $heading_title,
            'href' => $this->url->link('extension/module/pricecontrol', $this->token_var . '=' . $this->session->data[$this->token_var] . '&store_id=' . $store_id, true)
        );

        $this->load->model('extension/module/pricecontrol');

        $data['prefix'] = $this->prefix;
        $data['token_var'] = $this->token_var;
        $data[$this->token_var] = $this->session->data[$this->token_var];
        $data['action'] = $this->url->link('extension/module/pricecontrol', $this->token_var . '=' . $this->session->data[$this->token_var] . '&store_id=' . $store_id, true);
        $data['cancel'] = $this->url->link($this->extension_var . '/extension', $this->token_var . '=' . $this->session->data[$this->token_var] . '&type=module', true);
        $data['text_info'] = sprintf($this->language->get('text_info'), $this->version);

        $setting = $this->model_setting_setting->getSetting($this->prefix . 'pricecontrol', $store_id);
        if (isset($this->request->post[$this->prefix . 'pricecontrol_status'])) {
            $data[$this->prefix . 'pricecontrol_status'] = $this->request->post[$this->prefix . 'pricecontrol_status'];
        } else {
            $data[$this->prefix . 'pricecontrol_status'] = isset($setting[$this->prefix . 'pricecontrol_status']) ? $setting[$this->prefix . 'pricecontrol_status'] : '';
        }
        if (isset($this->request->post[$this->prefix . 'pricecontrol_sort_order'])) {
            $data[$this->prefix . 'pricecontrol_sort_order'] = $this->request->post[$this->prefix . 'pricecontrol_sort_order'];
        } else {
            $data[$this->prefix . 'pricecontrol_sort_order'] = isset($setting[$this->prefix . 'pricecontrol_sort_order']) ? $setting[$this->prefix . 'pricecontrol_sort_order'] : '';
        }
        if (isset($this->request->post[$this->prefix . 'pricecontrol_priority'])) {
            $data[$this->prefix . 'pricecontrol_priority'] = $this->request->post[$this->prefix . 'pricecontrol_priority'];
        } else {
            $data[$this->prefix . 'pricecontrol_priority'] = isset($setting[$this->prefix . 'pricecontrol_priority']) ? $setting[$this->prefix . 'pricecontrol_priority'] : '';
        }

        $this->load->model('catalog/category');
        $data[$this->prefix . 'category_data'] = array();
        foreach($this->model_catalog_category->getCategories() as $key){
            $data[$this->prefix . 'category_data'][] = $key;
        }

        //$this->load->model('catalog/product');
        //print_r($this->model_catalog_product->getProduct(30));

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/pricecontrol', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/pricecontrol')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }


        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }
}
