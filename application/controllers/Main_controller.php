<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function map() {
        $data['client'] = $this->client_model->getClients();
        if ($this->session->userdata('logged')) {
            $this->load->view('map/map',$data);
        } else {
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }

    function mapByClient($idClient) {
        $data['client'] = $this->client_model->getClientByIDResult($idClient);
        if ($this->session->userdata('logged')) {
            $this->load->view('map/map',$data);
        } else {
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }
    
    function mapTest() {
        if ($this->session->userdata('logged')) {
            
            $this->load->view('map/test');
            
        } else {
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }

}

?>