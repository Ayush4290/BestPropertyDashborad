<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Home_Loan extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('session');
			$this->load->helper(array('form','url','headerdata_helper'));
			$this->load->library('form_validation'); 
		}
		

		public function index() { 
		   
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$data['main_content'] = 'new_home_loan';
			$this->load->view('includes/front/template', $data);
		}
		
		
		public function loanCalculator() {
        $loan_amount = $this->input->post('loan_amount');
        $interest_rate = $this->input->post('interest_rate');
        $loan_tenure = $this->input->post('loan_tenure');

        if ($loan_amount && $interest_rate && $loan_tenure) {
            $monthly_interest = ($interest_rate / 100) / 12;
            $num_payments = $loan_tenure * 12;
            
            // EMI Calculation Formula
            $emi = ($loan_amount * $monthly_interest * pow(1 + $monthly_interest, $num_payments)) /
                   (pow(1 + $monthly_interest, $num_payments) - 1);

            // Total Amount Payable (EMI * Total Months)
            $total_amount = $emi * $num_payments;

            // Total Interest Paid
            $total_interest = $total_amount - $loan_amount;

            echo json_encode([
                'emi' => number_format($emi, 2),
                'total_amount' => number_format($total_amount, 2),
                'total_interest' => number_format($total_interest, 2)
            ]);
        } 
        else {
            echo json_encode(['error' => 'Please enter all fields correctly.']);
        }
    
        }
	

	}