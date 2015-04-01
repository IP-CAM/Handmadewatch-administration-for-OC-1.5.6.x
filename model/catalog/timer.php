<?php
class ModelCatalogTimer extends Model {

	public function getProductsByStatus() {
	
		$query = $this->db->query("SELECT p.product_id, p.price, pd.name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = 1 AND p.quantity > 0 ORDER BY pd.name ASC");
	  
		return $query->rows;
	} 

	public function getAllProductsSpecials() {
		$query = $this->db->query("SELECT p.price as 'old_price', pd.name, ps.* FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product_description pd ON (pd.product_id = ps.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (p.product_id = ps.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ps.price");
		
		return $query->rows;
	}


	public function getAllProductsSpecialsId() {
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_special WHERE price > 0 ORDER BY price");
		
		return $query->rows;
	}

	
	public function AddNewProductSpecial($product_id, $price, $data = 0) {
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . $this->db->escape($data['customer_group_id']) . "', priority = '" . (int)$data['priority'] . "', price = '" . (float) $this->db->escape($price) . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', timer = '" . $this->db->escape($data['timer']) . "'"); 
		
		if($query){
			return true;
		} else {
			return false;
		}
	}
	
	public function DeleteAllProductsSpecials() {
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "product_special"); 
	
		if($query){
			return true;
		} else {
			return false;
		}
	}
}
?>
