<?php

class client_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //CREATE
    public function createClient($data) {
        try {
            if ($this->db->insert("client", $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ
    function getClients() {
        try {
            $this->db->order_by('idClient', 'desc');
            return $this->db->get('client')->result_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    
    //READ BY ID
    function getClientByID($idClient) {
        try {
            return $this->db->get_where('client', array('idClient' => $idClient))->row_array();
        } catch (Exception $e) {
            echo 'Error message at client_model.getClientByID: ' . $e->getMessage();
        }
    }
    
    function getClientByIDResult($idClient) {
        try {
            return $this->db->get_where('client', array('idClient' => $idClient))->result_array();
        } catch (Exception $e) {
            echo 'Error message at client_model.getClientByID: ' . $e->getMessage();
        }
    }
    //READ BY ID
    function getClientsByPortfolio($idPortfolio) {
        try {
            return $this->db->get_where('client', array('idPortfolio' => $idPortfolio))->result_array();
        } catch (Exception $e) {
            echo 'Error message at client_model.getClientByID: ' . $e->getMessage();
        }
    }

    //Read by id, name, last name, second last name or email
    function SearchClient($idClient, $name, $fLastName, $sLastName, $email) {
        try {

            $this->db->order_by('idClient', 'asc');
            $this->db->where("idClient", $idClient)
                    ->or_where("name", $name)
                    ->or_where("fLastName", $fLastName)
                    ->or_where("sLastName", $sLastName)
                    ->or_where("email", $email);
            return $this->db->get('client')->result_array();


            return $query;
        } catch (Exception $e) {
            echo 'Error message at client_model.SearchClient(): ' . $e->getMessage();
        }
    }

    function checkIfExists($email) {
        try {
            $this->db->select('*');
            $this->db->from('client');
            $this->db->where('email', $email);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //PENDING MORE SEARCH METHODS
    //UPDATE
    public function updateClient($idClient, $params) {
        try {
            $this->db->where('idClient', $idClient);
            return $this->db->update('client', $params);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //DELETE
    public function deleteClient($idClient) {
        try {
            if ($this->db->delete("client", "idClient = " . $idClient)) {
                return true;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}

?> 