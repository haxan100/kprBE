<?php
class Payments extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Payment_model');
        $this->load->model('Installment_model');
    }
    
    public function get_payments_by_year_month($year, $month) {
        $data = $this->Payment_model->get_payments_by_year_month($year, $month);
        echo json_encode($data);
    }
    
    
    public function add() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $payment_date = $this->input->post('payment_date');
        $amount = $this->input->post('amount');

        // Cari installment berdasarkan tahun dan bulan
        $installment = $this->Installment_model->get_installment($year, $month);

        if ($installment) {
            // Tambahkan pembayaran
            $data = array(
                'installment_id' => $installment->id,
                'payment_date' => $payment_date,
                'amount' => $amount
            );
            $this->Payment_model->add_payment($data);

            // Perbarui status paid pada installment
            $this->Installment_model->update_paid_status($installment->id, 1);

            echo json_encode(array("status" => TRUE));
        } else {
            echo json_encode(array("status" => FALSE, "message" => "Installment not found for the given year and month."));
        }
    }
    
    public function check_payment_status() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $status = $this->Payment_model->check_payment_status($year, $month);
        echo json_encode(array("status" => $status));
    }
    public function current_month_status() {
        $current_date = new DateTime();
        $year = $current_date->format('Y');
        $month = $current_date->format('m');
    
        $status = $this->Payment_model->check_payment_status($year, $month);
        echo json_encode(array("status" => $status));
    }
    public function checklist_payment() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $installment = $this->Installment_model->get_installment($year, $month);
    
        if ($installment) {
            $data = array(
                'installment_id' => $installment->id,
                'payment_date' => $this->input->post('payment_date'),
                'amount' => $this->input->post('amount')
            );
            $this->Payment_model->add_payment($data);
            echo json_encode(array("status" => TRUE, "message" => "Payment added and checklist updated."));
        } else {
            echo json_encode(array("status" => FALSE, "message" => "Installment not found for the given year and month."));
        }
    }
    
    
}
