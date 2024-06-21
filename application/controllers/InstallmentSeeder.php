<?php

class InstallmentSeeder extends CI_Controller {
    public function seed() {
        $this->load->database();
        
        $start_date = '2024-06-27';
        $date = new DateTime($start_date);
        $payments = [
            1 => 3407568.00,
            2 => 3407568.00,
            3 => 3407568.00,
            4 => 4075062.00,
            5 => 4770207.00,
            6 => 5483272.00,
            7 => 5848540.00,
            8 => 5848540.00,
            9 => 5848540.00,
            10 => 5848540.00,
            11 => 5848540.00,
            12 => 5848540.00,
            13 => 5848540.00,
            14 => 5848540.00,
            15 => 5848540.00,
            16 => 5848540.00,
            17 => 5848540.00,
            18 => 5848540.00,
            19 => 5848540.00,
            20 => 5848540.00,
        ];

        foreach ($payments as $year => $monthly_payment) {
            for ($i = 1; $i <= 12; $i++) {
                $data = [
                    'payment_date' => $date->format('Y-m-d'),
                    'monthly_payment' => $monthly_payment
                ];
                $this->db->insert('installments', $data);
                $date->modify('+1 month');
            }
        }
        
        echo "Seeding complete";
    }
}
