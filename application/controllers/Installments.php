<?php
class Installments extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Installment_model');
    }

    public function remaining_installments() {
        $all_installments = $this->Installment_model->get_all_installments();
        $current_date = new DateTime();
        
        $remaining_installments = array_filter($all_installments, function($installment) use ($current_date) {
            return new DateTime($installment->payment_date) > $current_date;
        });

        echo json_encode(array("status" => TRUE, "remaining_installments" => count($remaining_installments)));
    }
}
