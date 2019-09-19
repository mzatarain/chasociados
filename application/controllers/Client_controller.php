<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('client_model');
        $this->load->model('portfolio_model');
    }

    function ClientList() {
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

    function ClientsListByPortfolio($idPortfolio) {
        try {
            $data['client'] = $this->client_model->getClientsByPortfolio($idPortfolio);
            $data['portfolioNumber'] = $this->portfolio_model->getPortfolioByID($idPortfolio);

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

    function ClientSearchForm() {
        try {
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('client/searchForm');
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

    function ClientCreate() {
        try {
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('client/create');
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

    function ClientCreateFromPortfolio($idPortfolio) {
        try {
            $data['portfolio'] = $this->portfolio_model->getPortfolioByID($idPortfolio);
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('client/create', $data);
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

    function ClientUpdate($idClient) {
        try {
            $data['client'] = $this->client_model->getClientByID($idClient);
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('client/update', $data);
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

    function ClientDetails($idClient) {
        try {
            $data['client'] = $this->client_model->getClientByID($idClient);
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('client/details', $data);
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

    function ClientSearch() {
        try {
            $idClient = $this->input->post('idClient');
            $name = $this->input->post('name');
            $fLastName = $this->input->post('fLastName');
            $sLastName = $this->input->post('sLastName');
            $email = $this->input->post('email');

            $data['client'] = $this->client_model->SearchClient($idClient, $name, $fLastName, $sLastName, $email);

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

    //Function to create a client account
    public function createClient() {
        try {
            $email = $this->input->post('email');
            $data = array(
                'number' => $this->input->post('number'),
                'hasACar' => $this->input->post('hasACar'),
                'hasAHouse' => $this->input->post('hasAHouse'),
                'workAntiquity' => $this->input->post('workAntiquity'),
                'workphone' => $this->input->post('workphone'),
                'workSchedule' => $this->input->post('workSchedule'),
                'idPortfolio' => $this->input->post('idPortfolio'),
                'name' => $this->input->post('name'),
                'fLastName' => $this->input->post('fLastName'),
                'sLastName' => $this->input->post('sLastName'),
                'homePhone' => $this->input->post('homePhone'),
                'cellPhone' => $this->input->post('cellPhone'),
                'address' => $this->input->post('address'),
                'neighborhood' => $this->input->post('neighborhood'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'debt' => $this->input->post('debt'),
                'email' => $this->input->post('email'),
                'notes' => $this->input->post('notes'),
                'workplace' => $this->input->post('workplace'),
                'jobPosition' => $this->input->post('jobPosition'),
                'salary' => $this->input->post('salary'),
            );

            if ($this->client_model->checkIfExists($email)) {
                echo '<script language="javascript">alert("';
                echo 'That account already exists in our database. Please try again with a different email.';
                echo '");</script>';
                $this->ClientList();
            } else {
                if ($this->client_model->createClient($data)) {
                    $this->ClientList();
                }
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    // Editing a client
    function update($idClient) {
        try {
            // check if the client exists before trying to edit it
            $data['client'] = $this->client_model->getClientByID($idClient);

            if (isset($data['client']['idClient'])) {
                if (isset($_POST) && count($_POST) > 0) {
                    $params = array(
                        'hasACar' => $this->input->post('hasACar'),
                        'hasAHouse' => $this->input->post('hasAHouse'),
                        'workAntiquity' => $this->input->post('workAntiquity'),
                        'workphone' => $this->input->post('workphone'),
                        'workSchedule' => $this->input->post('workSchedule'),
                        'idPortfolio' => $this->input->post('idPortfolio'),
                        'name' => $this->input->post('name'),
                        'fLastName' => $this->input->post('fLastName'),
                        'sLastName' => $this->input->post('sLastName'),
                        'homePhone' => $this->input->post('homePhone'),
                        'cellPhone' => $this->input->post('cellPhone'),
                        'address' => $this->input->post('address'),
                        'email' => $this->input->post('email'),
                        'notes' => $this->input->post('notes'),
                        'workplace' => $this->input->post('workplace'),
                        'jobPosition' => $this->input->post('jobPosition'),
                        'salary' => $this->input->post('salary'),
                    );

                    $this->client_model->updateClient($idClient, $params);
                    $this->ClientList();
                } else {

                    $this->ClientList();
                }
            } else {
                show_error('The client you are trying to edit does not exist.');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //Deleting client
    function delete($idClient) {
        try {
            $client = $this->client_model->getClientByID($idClient);
            // check if the client exists before trying to delete it
            if (isset($client['idClient'])) {
                $this->client_model->deleteClient($idClient);
                $this->ClientList();
            } else {
                show_error('The client you are trying to delete does not exist.');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
}