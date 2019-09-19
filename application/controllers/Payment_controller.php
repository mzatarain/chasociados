<?php

class Payment_controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('../controllers/Agreement_controller');
        $this->load->model('penaltyfeepayment_model');
        $this->load->model('collectioncostpayment_model');
    }

    function nextDuePayment() {
        try {
            $data['payment'] = $this->payment_model->getNextDuePayments();

            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('payment/list', $data);
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function pastDuePayment() {
        try {
            $data['payment'] = $this->payment_model->pastDuePayments();

            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('payment/list', $data);
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function past28DuePayment() {
        try {
            $data['payment'] = $this->payment_model->getPastDue28DaysPayments();

            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('payment/list', $data);
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    public function pay($idPayment) {
        try {
            // check if the client exists before trying to edit it
            $data['payment'] = $this->payment_model->getPaymentByID($idPayment);
            $date = strtotime(date("Y-m-d"));
            $today = date("Y-m-d", $date);
            $idAgreement = $data['payment']['idAgreement'];
            $idEmployee = $this->session->userdata('idEmployee');
            if (isset($data['payment']['idPayment'])) {
                $params = array(
                    'alreadyPaid' => 1,
                    'paymentDate' => $today,
                    'idEmployee' => $idEmployee
                );

                $agreementParams = array(
                    'lastPaymentDate' => $today,
                );

                $this->payment_model->updatePayment($idPayment, $params);
                $this->agreement_model->updateAgreement($idAgreement, $agreementParams);
                $data['agreement'] = $this->agreement_model->getAgreementByID($idAgreement);
                $data['payment'] = $this->payment_model->getPaymentsByidAgreement($idAgreement);
                $idClient = $data['agreement']['idClient'];
                $data['client'] = $this->client_model->getClientByID($idClient);
                $data['date'] = date("Y/m/d");
                //$data['employee'] = $this->employee_model->getEmployeeByID($idEmployee);
                if ($this->session->userdata('logged')){                    
                    $this->load->view('home/header');
                    $this->load->view('home/cobranza');
                    $this->load->view('agreement/details', $data);
                    $this->load->view('home/footer');
                } else {
                    $this->load->view('home/header');
                    $this->load->view('home/login');
                    $this->load->view('home/footer');
                }
            } else {
                show_error('The payment you are trying to edit does not exist.');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    
    function collectionCost($idPayment){
        try {
            // check if the payment exists before trying to edit it
            $data['payment'] = $this->payment_model->getPaymentByID($idPayment);
            $data['collectioncostpayment'] = $this->collectioncostpayment_model->getPaymentsByidAgreement($data['payment']['idAgreement']);
            $data['penaltyfeepayment'] = $this->penaltyfeepayment_model->getPaymentsByidAgreement($data['payment']['idAgreement']);
                    
            $date = strtotime(date("Y-m-d"));
            $today = date("Y-m-d", $date);
            $idAgreement = $data['payment']['idAgreement'];
            $idEmployee = $this->session->userdata('idEmployee');
            if (isset($data['payment']['idPayment'])) {
                $params = array(
                    'collectionCost' => 200,
                    'collectionCostDate' => $today,
                );

                $this->payment_model->updatePayment($idPayment, $params);
                $data['agreement'] = $this->agreement_model->getAgreementByID($idAgreement);
                $data['payment'] = $this->payment_model->getPaymentsByidAgreement($idAgreement);
                $idClient = $data['agreement']['idClient'];
                $data['client'] = $this->client_model->getClientByID($idClient);
                $data['date'] = date("Y/m/d");
                //$data['employee'] = $this->employee_model->getEmployeeByID($idEmployee);
                if ($this->session->userdata('logged')){                    
                    $this->load->view('home/header');
                    $this->load->view('home/cobranza');
                    $this->load->view('agreement/details', $data);
                    $this->load->view('home/footer');
                } else {
                    $this->load->view('home/header');
                    $this->load->view('home/login');
                    $this->load->view('home/footer');
                }
            } else {
                show_error('The payment you are trying to edit does not exist.');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}
