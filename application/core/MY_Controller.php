<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('agreement_model');
        $this->load->model('client_model');
        $this->load->model('employee_model');
        $this->load->model('payment_model');
        $this->load->model('portfolio_model');
        $this->load->library('pagination');
    }

//function to show index page
    function index() {
        try {
            if ($this->session->userdata('logged')) {
                $this->cobranza();
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function cobranza() {
        try {
            $data['client'] = $this->client_model->getClients();
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('client/list', $data);
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

    function juridico() {
        try {
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/juridico');
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

}

?>