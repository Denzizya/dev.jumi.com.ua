<?php

class ModelCatalogCategoryPrefixes extends Model {

    public function editPrefixes($data) {
        
        foreach ($data as $category_id => $category) {

            foreach ($category as $language_id => $value) {
                // if prefix value !empty
                $this->db->query("DELETE FROM `" . DB_PREFIX . "category_prefixes` WHERE category_id = '" . (int)$category_id . "' AND language_id = '" . (int)$language_id . "'");
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "category_prefixes SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', prefix_value = '" . $value . "'");
            }
        }

        return;
    }

    public function getPrefixes() {
        $prefixes_data = [];

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_prefixes`");

        foreach ($query->rows as $result) {
            $prefixes_data[$result['category_id']][$result['language_id']] = $result['prefix_value'];
        }
        
        return $prefixes_data;

    }

}

?>