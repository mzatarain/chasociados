<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agreement_controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('agreement_model');
        $this->load->model('client_model');
        $this->load->model('employee_model');
        $this->load->model('portfolio_model');
        $this->load->model('payment_model');
        $this->load->model('penaltyfeepayment_model');
        $this->load->model('collectioncostpayment_model');
    }

    function AgreementCreate($idClient, $debt) {
        try {
            if ($this->session->userdata('logged')) {
                $data['agreement'] = $this->agreement_model->getAgreementByClient($idClient);
                if (isset($data['agreement']['idAgreement'])) {
                    $data['payment'] = $this->payment_model->getPaymentsByidAgreement($data['agreement']['idAgreement']);
                    $data['collectioncostpayment'] = $this->collectioncostpayment_model->getPaymentsByidAgreement($data['agreement']['idAgreement']);
                    $data['penaltyfeepayment'] = $this->penaltyfeepayment_model->getPaymentsByidAgreement($data['agreement']['idAgreement']);
                    $idClient = $data['agreement']['idClient'];
                    $data['client'] = $this->client_model->getClientByID($idClient);
                    $data['date'] = date("Y/m/d");
                    $this->load->view('home/header');
                    $this->load->view('home/cobranza');
                    $this->load->view('agreement/details', $data);
                    $this->load->view('home/footer');
                } else {
                    $data = array('idClient' => $idClient, 'debt' => $debt);
                    $this->load->view('home/header');
                    $this->load->view('home/cobranza');
                    $this->load->view('agreement/create', $data);
                    $this->load->view('home/footer');
                }
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //EN PROGRESO, Todavia no está lista
    function AgreementDetails($idAgreement) {
        try {
            $data['agreement'] = $this->agreement_model->getAgreementByID($idAgreement);
            $data['payment'] = $this->payment_model->getPaymentsByidAgreement($idAgreement);
            $idClient = $data['agreement']['idClient'];
            $data['client'] = $this->client_model->getClientByID($idClient);
            $data['date'] = date("Y/m/d");


            if ($this->session->userdata('logged')) {

                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('agreement/details', $data);
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

    function AgreementUpdate($idClient) {
        try {
            $data['client'] = $this->client_model->getClientByID($idClient);
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('agreement/update', $data);
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

    //Function to create a client account
    public function createAgreement() {
        try {
            $totalAmountToPay = $this->input->post('totalAmountToPay');
            $amountToPayByPeriod = $this->input->post('amountToPayByPeriod');
            $recurrenceOfPayment = $this->input->post('recurrenceOfPayment');
            $paymentStartDate = $this->input->post('paymentStartDate');
            $paymentDueDate = $paymentStartDate;
            $data = array(
                'idClient' => $this->input->post('idClient'),
                'initialDebt' => $this->input->post('initialDebt'),
                'totalAmountToPay' => $this->input->post('totalAmountToPay'),
                'amountToPayByPeriod' => $this->input->post('amountToPayByPeriod'),
                'recurrenceOfPayment' => $this->input->post('recurrenceOfPayment'),
                'paymentStartDate' => $this->input->post('paymentStartDate'),
                'reAgreement' => $this->input->post('reAgreement'),
            );

            if ($this->agreement_model->createAgreement($data)) {
                $idAgreement = $this->agreement_model->getLastAgreement();
                $amountOfPayments = $totalAmountToPay / $amountToPayByPeriod;
                $res = $totalAmountToPay % $amountToPayByPeriod;

                $resLimit = intval($amountOfPayments);

                for ($x = 0; $x < $amountOfPayments; $x++) {

                    if ($x === $resLimit and $res > 0) {
                        $amountToPayByPeriod = $res;
                    }

                    if ($x > 0 && $recurrenceOfPayment == 'Semanal') {
                        $paymentDueDate = date('Y-m-d', strtotime($paymentDueDate . ' + 7 days'));
                    } else if ($x > 0 && $recurrenceOfPayment == 'Catorcenal') {
                        $paymentDueDate = date('Y-m-d', strtotime($paymentDueDate . ' + 14 days'));
                    } else if ($x > 0 && $recurrenceOfPayment == 'Mensual') {
                        $paymentDueDate = date('Y-m-d', strtotime($paymentDueDate . ' + 1 month'));
                    }

                    $number = $x + 1;
                    $paymentName = 'Pago ' . $number;

                    $dataPayment = array(
                        'paymentName' => $paymentName,
                        'amountToPay' => $amountToPayByPeriod,
                        'paymentDueDate' => $paymentDueDate,
                        'alreadyPaid' => 0,
                        'idAgreement' => $idAgreement,
                    );


                    $this->payment_model->createPayment($dataPayment);
                }
                $this->AgreementDetails($idAgreement);
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}
