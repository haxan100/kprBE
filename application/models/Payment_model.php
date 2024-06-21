<?php
class Payment_model extends CI_Model {
    public function get_payments_by_year_month($year, $month) {
        $this->db->select('payments.*, installments.payment_date');
        $this->db->from('payments');
        $this->db->join('installments', 'payments.installment_id = installments.id');
        $this->db->where('YEAR(installments.payment_date)', $year);
        $this->db->where('MONTH(installments.payment_date)', $month);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function add_payment($data) {
        return $this->db->insert('payments', $data);
    }
    
    public function check_payment_status($year, $month) {
        $this->db->select('payments.*, installments.payment_date');
        $this->db->from('payments');
        $this->db->join('installments', 'payments.installment_id = installments.id');
        $this->db->where('YEAR(installments.payment_date)', $year);
        $this->db->where('MONTH(installments.payment_date)', $month);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
}
