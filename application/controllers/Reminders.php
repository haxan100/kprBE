<?php
class Reminders extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Installment_model');
        $this->load->model('Payment_model');
    }

    public function send_reminders() {
        $current_date = new DateTime();
        $current_year = $current_date->format('Y');
        $current_month = $current_date->format('m');
        
        $start_date = new DateTime("$current_year-$current_month-20");
        $end_date = new DateTime("$current_year-$current_month-25");

        if ($current_date >= $start_date && $current_date <= $end_date) {
            $status = $this->Payment_model->check_payment_status($current_year, $current_month);
            if (!$status) {
                // Logika untuk mengirim reminder, misalnya email atau notifikasi push
                echo json_encode(array("status" => TRUE, "message" => "Reminder sent for payment due on 27th."));
            } else {
                echo json_encode(array("status" => FALSE, "message" => "Payment already made for this month."));
            }
        } else {
            echo json_encode(array("status" => FALSE, "message" => "Not within reminder period."));
        }
    }
}
