<?php
class ModelTicketTicket extends Model {
	public function editTicket($ticket_id, $data = array()) {
		$this->db->query("UPDATE `" . DB_PREFIX . "ticket` SET ticket_user_id = '" . (int)$data['user_id'] . "' WHERE ticket_id = '" . (int)$ticket_id . "'");
	}
	
	public function lastUpdate($ticket_id, $user_name) {
		$this->db->query("UPDATE `" . DB_PREFIX . "ticket` SET ticket_last_update = '" . (string)$user_name . "' WHERE ticket_id = '" . (int)$ticket_id . "'");
	}
	
	public function delete($ticket_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "ticket WHERE ticket_id = '" . (int)$ticket_id . "'");
	}
	
	public function changeStatus($ticket_id, $status) {
		$this->db->query("UPDATE `" . DB_PREFIX . "ticket` SET ticket_status = '" . (string)$status . "' WHERE ticket_id = '" . (int)$ticket_id . "'");
	}
	
	public function getTicket($ticket_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "ticket`, `" . DB_PREFIX . "department` WHERE ticket_department_id = department_id AND ticket_id = '" . (int)$ticket_id . "'");
	
		return $query->row;
	}
	
	public function getConfig() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "ticket_config` WHERE config_id = 1");
	
		return $query->row;
	}

	public function editConfig($data = array()) {
		$this->db->query("UPDATE `" . DB_PREFIX . "ticket_config` SET order_status = '" . (int)$data['order_status'] . "', order_required = '" . (int)$data['order_required'] . "' WHERE config_id = 1");
	}

	public function getTickets($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "ticket`, `" . DB_PREFIX . "department` WHERE ticket_department_id = department_id";
		
		if ( isset($data['filter_status']) && !empty($data['filter_status']) ){
			$sql .= " AND ticket_status = '" . (string)$data['filter_status'] . "'";
		}
			
		$sort_data = array(
			'ticket_subject',
			'ticket_status',
			'ticket_created',
			'ticket_department_id'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY ticket_created";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
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

	public function getTotalTickets( $status = null, $user = false ) {
      	if ( $status == null && $user == false ){
			$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "ticket`");
      	}elseif ($status != null && $user == false){
      		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "ticket` WHERE ticket_status = '" . (string)$status . "'");
      	}elseif ($status != null && $user != false){
      		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "ticket` WHERE ticket_status = '" . (string)$status . "' AND ticket_user_id = " . (int)$this->user->getId());
      	}else{
      		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "ticket` WHERE ticket_user_id = " . (int)$this->user->getId());
      	}
		
		return $query->row['total'];
	}

	public function getTotalTicketsByDepartmentId($department_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "ticket` WHERE ticket_department_id = '" . (int)$department_id . "'");
		
		return $query->row['total'];
	}
}
?>