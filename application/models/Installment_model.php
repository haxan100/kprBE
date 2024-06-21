<?php
class Installment_model extends CI_Model {
    public function get_installment($year, $month) {
        $this->db->where('YEAR(payment_date)', $year);
        $this->db->where('MONTH(payment_date)', $month);
        $query = $this->db->get('installments');
        return $query->row();
    }
    
    public function get_all_installments() {
        $query = $this->db->get('installments');
        return $query->result();
    }
    public function update_paid_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('installments', array('paid' => $status));
    }
}
