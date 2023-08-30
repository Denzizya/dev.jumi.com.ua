<?php

class ControllerCatalogCategoryPrefixes extends Controller {
    function index() {
        $this->load->model('catalog/category');
        $this->load->model('catalog/category_prefixes');
        $this->load->model('localisation/language');
        $this->load->language('catalog/category_prefixes');

        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			//var_dump($this->request->post['category']);
			$this->model_catalog_category_prefixes->editPrefixes($this->request->post['category']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			//$this->response->redirect($this->url->link('catalog/category_prefixes', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$data['language_id'] = $this->config->get('config_language_id');


		// prefixes
		$prefixes_data = $this->model_catalog_category_prefixes->getPrefixes();
		//var_dump($prefixes_data);
		// prefixes data


        $categories_data = $this->getCategories();

		foreach ($categories_data as $category_id => $value) {

			$child_data = $this->getCategories($category_id);
			$child = [];
			foreach ($child_data as $category_id => $value) {

				$child_second_data = $this->getCategories($category_id);
				$child_second = [];

				$prefixes = isset($prefixes_data[$category_id]) ? $prefixes_data[$category_id] : false;

				foreach ($child_second_data as $category_id => $value) {

					$prefixes = isset($prefixes_data[$category_id]) ? $prefixes_data[$category_id] : false;
					
					$child_second[$category_id] = [
						'category_id' => $category_id,
						'name' => $value,
						'prefixes'	=> $prefixes,
					];
				}
				
				$child[$category_id] = [
					'category_id' => $category_id,
					'name' => $value,
					'child_second'	=> $child_second,
					'prefixes'	=> $prefixes,
				];
			}

			$prefixes = isset($prefixes_data[$category_id]) ? $prefixes_data[$category_id] : false;

			$data['categories'][$category_id] = [
				'category_id'	=> $category_id,
				'name'	=> $value,
				'child'      => $child,
				'prefixes'	=> $prefixes,
			];
		}

		//var_dump($data['categories']);

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$this->document->addStyle('view/stylesheet/category-prefixes.css', 'header');
 
        $this->response->setOutput($this->load->view('catalog/category_prefixes', $data));
    }

	public function getCategories($parent_id = 0) {
		$categories_data = [];

		$query = $this->db->query("SELECT c.category_id, cd.name, cd.language_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

		//$result[$result['category_id']][$result['language_id']]
		foreach ($query->rows as $result) {
			$categories_data[$result['category_id']][$result['language_id']] = $result['name'];
		}

		return $categories_data;
	}

}

?>