<?php
class ModelTicketDepartment extends Model {
	public function addDepartment($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "department SET department_name = '" . $this->db->escape($data['name']) . "'");
	}
	
	public function editdepartment($department_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "department SET department_name = '" . $this->db->escape($data['name']) . "' WHERE department_id = '" . (int)$department_id . "'");
	}
	
	public function deleteDepartment($department_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "department WHERE department_id = '" . (int)$department_id . "'");
	}

	public function addPermission($user_id, $type, $page) {
		$user_query = $this->db->query("SELECT DISTINCT department_id FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
		
		if ($user_query->num_rows) {
			$department_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "department WHERE department_id = '" . (int)$user_query->row['department_id'] . "'");
		
			if ($department_query->num_rows) {
				$data = unserialize($department_query->row['permission']);
		
				$data[$type][] = $page;
		
				$this->db->query("UPDATE " . DB_PREFIX . "department SET permission = '" . serialize($data) . "' WHERE department_id = '" . (int)$user_query->row['department_id'] . "'");
			}
		}
	}
	
	public function getDepartment($department_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "department WHERE department_id = '" . (int)$department_id . "'");
	}
	
	public function getDepartments($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "department";
		
		$sql .= " ORDER BY department_name";	
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getTotalDepartments() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "department");
		
		return $query->row['total'];
	}	
}
?>